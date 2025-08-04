<?php
if ($request[0] == 'api-att') {

    $end_date = date('Y-m-d'); // আজকের তারিখ
    $start_date = date('Y-m-d', strtotime($end_date . ' -2 days')); // আজ থেকে ২ দিন আগে

    $period = new DatePeriod(
        new DateTime($start_date),
        new DateInterval('P1D'),
        (new DateTime($end_date))->modify('+1 day') // শেষ তারিখও ইনক্লুড করতে
    );

    $employees = $db->select("
        SELECT 
            e.id AS employee_id,
            e.zkteco_user_id AS zk_employee_id,
            e.name AS employee_name,
            g.name AS group_name,
            l.device_serials,
            l.office_name AS location_name,
            s.id as shift_id,
            s.name AS shift_name,
            s.start_time,
            s.end_time,
            s.overtime_start,
            s.description
        FROM employees e
        INNER JOIN `groups` g ON e.group_id = g.id
        INNER JOIN locations l ON e.location_id = l.id
        INNER JOIN shift_assign sa ON sa.employee_id = e.id
        INNER JOIN shifts s ON sa.shift_id = s.id
        ORDER BY e.id, s.start_time
    ");


    foreach ($period as $day) {
        $today = $day->format('Y-m-d');

        foreach ($employees as $emp) {
            $zk_employee_id = $emp['zk_employee_id'];
            $employee_id = $emp['employee_id'];
            $device_serials = explode(",", $emp['device_serials']);
            $shift_name = $emp['shift_name'];
            $shift_id = $emp['shift_id'];
            $shift_start = $emp['start_time'];
            $shift_end = $emp['end_time'];

            // Holiday, leave, RO check
            $attendance_type_check = $db->select("
                SELECT type FROM attendance
                WHERE employee_id = '{$employee_id}'
                AND attendance_date = '{$today}'
                AND shift_id = '{$shift_id}'
                LIMIT 1
            ");

            if ($attendance_type_check) {
                $type = strtolower($attendance_type_check[0]['type']);
                if (in_array($type, ['holiday', 'leave', 'ro'])) {
                    continue; // Skip this day for attendance
                }
            }

            $shift_start_dt = new DateTime("$today $shift_start");
            $shift_end_dt = new DateTime("$today $shift_end");
            if (strtotime($shift_end) < strtotime($shift_start)) {
                // shift শেষ তারিখ একদিন পর হতে পারে, যেমন রাত ১০ থেকে সকাল ৬
                $shift_end_dt->modify('+1 day');
            }

            // shift এর ১ ঘন্টা আগ থেকে শুরু, ১ ঘন্টা পরে শেষ পর্যন্ত
            $start_buffer = clone $shift_start_dt;
            $end_buffer = clone $shift_end_dt;
            $start_buffer->modify('-1 hour');
            $end_buffer->modify('+1 hour');

            $start_time_str = $start_buffer->format('Y-m-d H:i:s');
            $end_time_str = $end_buffer->format('Y-m-d H:i:s');

            $serials_in = "'" . implode("','", array_map('trim', $device_serials)) . "'";

            $attlogs = $db->select("
                SELECT datetime, col10 as device_serial FROM attlog
                WHERE user_id = '{$zk_employee_id}'
                AND col10 IN ($serials_in)
                AND datetime BETWEEN '{$start_time_str}' AND '{$end_time_str}'
                ORDER BY datetime ASC
            ");

            if (!$attlogs || count($attlogs) === 0) continue;

            $filtered_logs = [];
            $last_dt = null;

            // ৫ মিনিটের বেশি গ্যাপ ছাড়া একাধিক লগ ফিল্টার করা
            foreach ($attlogs as $row) {
                $curr_dt = new DateTime($row['datetime']);
                if (!$last_dt || ($curr_dt->getTimestamp() - $last_dt->getTimestamp()) > 300) {
                    $filtered_logs[] = [
                        'datetime' => $curr_dt,
                        'device_serial' => $row['device_serial']
                    ];
                    $last_dt = $curr_dt;
                }
            }

            if (count($filtered_logs) >= 1) {
                $in_time_dt = $filtered_logs[0]['datetime'];
                $in_time = $in_time_dt->format('Y-m-d H:i:s');
                $device_serial = $filtered_logs[0]['device_serial'];

                // in_time থেকে কমপক্ষে ৫ মিনিট পর হতে হবে out_time
                $min_out_time_dt = clone $in_time_dt;
                $min_out_time_dt->modify('+5 minutes');

                // আউটটাইম শিফট শুরু হওয়ার ৫ মিনিট পরে থেকে valid
                $min_valid_out_time = clone $shift_start_dt;
                $min_valid_out_time->modify('+5 minutes');

                // out_time হিসেবে ইনটাইম +৫ মিনিট পরে এবং শিফট শুরু হওয়ার ৫ মিনিট পরে লগ গুলো থেকে সর্বশেষ টাইম নিবে
                $valid_out_times = [];
                foreach ($filtered_logs as $log) {
                    if ($log['datetime'] >= $min_out_time_dt && $log['datetime'] >= $min_valid_out_time) {
                        $valid_out_times[] = $log['datetime'];
                    }
                }

                if (count($valid_out_times) > 0) {
                    $out_time_dt = end($valid_out_times);
                    $out_time = $out_time_dt->format('Y-m-d H:i:s');
                    $duration = round(($out_time_dt->getTimestamp() - $in_time_dt->getTimestamp()) / 3600, 2);
                } else {
                    $out_time = null;
                    $duration = 0;
                }

                // আগেই attendance আছে কিনা চেক
                $check = $db->select("
                    SELECT id FROM attendance
                    WHERE employee_id = '{$employee_id}'
                    AND attendance_date = '{$today}'
                    AND shift_id = '{$shift_id}'
                    LIMIT 1
                ");

                if (!$check) {
                    // নতুন এন্ট্রি ইনসার্ট করো
                    $insert_sql = "
                        INSERT INTO attendance (
                            employee_id, shift_id, attendance_date, in_time, out_time, duration_hours, device_serial, type
                        ) VALUES (
                            '{$employee_id}', '{$shift_id}', '{$today}', '{$in_time}', '" . ($out_time ?? '-') . "', {$duration}, '{$device_serial}', 'present'
                        )
                    ";
                    $db->query($insert_sql);
                } else {
                    // যদি আউট টাইম পাওয়া যায়, তাহলে আপডেট করো (যেখানে আউট টাইম না থাকে)
                    if ($out_time) {
                        $check_id = $check[0]['id'];
                        $update_sql = "
                            UPDATE attendance
                            SET out_time = '{$out_time}', duration_hours = {$duration}
                            WHERE id = '{$check_id}'
                            AND (out_time = '-' OR out_time IS NULL)
                        ";
                        $db->query($update_sql);
                    }
                }
            }
        }
    }

    echo json_encode([
        "status" => "success",
        "message" => "Attendance processed with updated rules"
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
?>
