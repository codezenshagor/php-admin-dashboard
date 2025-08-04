<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Attendance OUT</title>
</head>
<body style="margin: 0; padding: 0; background: #fbeff2; font-family: Arial, sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" style="padding: 30px 0;">
        <table width="600" cellpadding="0" cellspacing="0" style="background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

          <tr>
            <td style="background: #dc3545; color: white; padding: 20px; text-align: center;">
              <h2 style="margin: 0;">🔴 Attendance OUT</h2>
              <p style="margin: 5px 0;">প্রস্থান নোটিফিকেশন</p>
            </td>
          </tr>

          <tr>
            <td style="padding: 25px; color: #333;">
              <p style="font-size: 16px;">Hello <strong>{{name}}</strong>,</p>
              <p style="font-size: 16px;">You have successfully <strong>checked out</strong> from the system.</p>
              <p style="font-size: 16px;">আপনি সফলভাবে আজকের প্রস্থান সম্পন্ন করেছেন।</p>

              <div style="background: #fff0f0; padding: 15px; border-left: 5px solid #dc3545; margin: 20px 0;">
                <p style="margin: 0;">
                  🔚 Status: <strong>OUT / প্রস্থান</strong><br>
                  📅 Date: <strong>{{date}}</strong><br>
                  🕒 Time: <strong>{{time}}</strong><br>
                  ⏳ Duration: <strong>{{duration}}</strong>
                </p>

              </div>

              <p style="font-size: 14px; color: #666;">Have a nice day! <br> সুন্দর দিন কাটুক!</p>
            </td>
          </tr>

          <tr>
            <td align="center" style="background: #f1f1f1; padding: 15px; font-size: 12px; color: #777;">
              © <?= date('Y') ?> shriah group
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
