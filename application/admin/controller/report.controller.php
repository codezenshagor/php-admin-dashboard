<?php
 if($request[0]=='admin' AND $request[1]=='attendance-rport'AND TOTAL==2){
        require_once("views/admin/report/attendance-list.php");
        die();
 }


if ($request[0] == 'admin' && $request[1] == 'send-email' && TOTAL == 2) {

    $att_list = $db->select("
        SELECT 
            a.*, e.id AS employee_id, e.user_id AS employee_ids, e.name AS employee_name, e.email, e.mobile,
            g.name AS group_name,
            l.office_name, l.branch_name, l.address,
            s.name AS shift_name
        FROM attendance a
        INNER JOIN employees e ON a.employee_id = e.id
        INNER JOIN `groups` g ON e.group_id = g.id
        INNER JOIN locations l ON e.location_id = l.id
        INNER JOIN shifts s ON a.shift_id = s.id
        WHERE e.email IS NOT NULL 
            AND e.email != ''
            AND (a.in_email = 0 OR a.out_email = 0)
        ORDER BY a.attendance_date DESC
    ");

    foreach ($att_list as $att) {
        $email = $att['email'];
        $employeeName = $att['employee_name'];
        $attendanceId = $att['id'];
        $sendIn = false;
        $sendOut = false;

        // Send IN email
        if (!empty($att['in_time']) && $att['in_email'] == 0) {
            $sendIn = true;

            // IN email template
            $inTemplate = file_get_contents('views/admin/email-template/in.php');
              $inDateTime = new DateTime($att['in_time']);
              $formattedDate = $inDateTime->format('d F Y'); // 25 July 2025
              $formattedTime = $inDateTime->format('h:i A'); // 05:50 AM

              
              $inBody = str_replace(
              ['{{name}}', '{{date}}', '{{time}}'],
              [$employeeName, $formattedDate, $formattedTime],
              $inTemplate
              );
            echo sendMail($email, $employeeName, 'IN Time Recorded', $inBody);
            echo "Sending IN email to $email for attendance ID $attendanceId\n";

            $db->query("UPDATE attendance SET in_email = 1 WHERE id = {$attendanceId}");
        }

        // Send OUT email
        if (!empty($att['out_time']) && $att['out_time'] != '0000-00-00 00:00:00' && $att['out_time'] != '-' && $att['out_email'] == 0) {
            $sendOut = true;

            // OUT email template
            $outTemplate = file_get_contents('views/admin/email-template/out.php');
             $inDateTime = new DateTime($att['out_time']);
             $total_hours = floatval($att['duration_hours']);
              $hours = floor($total_hours); 
              $minutes = round(($total_hours - $hours) * 60); 
              $t_dur = $hours .' Hours '.$minutes .' Minutes ';
              $formattedDate = $inDateTime->format('d F Y'); // 25 July 2025
              $formattedTime = $inDateTime->format('h:i A'); // 05:50 AM

              $outBody = str_replace(
              ['{{name}}', '{{date}}', '{{time}}', '{{duration}}'],
              [$employeeName, $formattedDate, $formattedTime,$t_dur],
               $outTemplate
              );
            echo sendMail($email, $employeeName, 'OUT Time Recorded', $outBody);
            echo "Sending OUT email to $email for attendance ID $attendanceId\n";

            $db->query("UPDATE attendance SET out_email = 1 WHERE id = {$attendanceId}");
        }

        if (!$sendIn && !$sendOut) {
            echo "No email needed for attendance ID $attendanceId\n";
        }
    }

    die();
}
