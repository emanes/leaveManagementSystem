<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Approved</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #333; margin: 0; padding: 0;">

<h1 style="margin-top: 0;">Leave Request Approved</h1>

<p>Dear <strong>{{ $mailData['employee_name'] }}</strong>,</p>

<p>Your leave request has been approved. Here are the details:</p>

<table cellpadding="5" cellspacing="0" border="0" style="border-collapse: collapse; width: 80%; margin: 0 auto;">
    <tr>
        <td style="border: 1px solid #ccc;">Leave Type</td>
        <td style="border: 1px solid #ccc;">{{ $mailData['leave_type'] }}</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ccc;">From</td>
        <td style="border: 1px solid #ccc;">{{ $mailData['leave_from'] }}</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ccc;">To</td>
        <td style="border: 1px solid #ccc;">{{ $mailData['leave_to'] }}</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ccc;">Reason</td>
        <td style="border: 1px solid #ccc;">{{ $mailData['reason'] }}</td>
    </tr>
</table>

<p>Thank you.</p>

<p>Regards,</p>
<p>Leave Tracker</p>

</body>
</html>
