<!DOCTYPE html>
<html>
<head>
    <title>Daily Task Notification</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f9f9f9;">

<table align="center" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f9f9f9; padding: 20px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">

                <!-- Title -->
                <tr>
                    <td align="center" style="padding: 20px 0;">
                        <h1 style="color: #333333; font-size: 24px; margin: 0;">Pending Tasks</h1>
                    </td>
                </tr>

                <!-- Task List -->
                <tr>
                    <td style="padding: 0 20px;">
                        <ul style="list-style-type: none; padding: 0; margin: 0;">
                            @foreach ($tasks as $task)
                                <li style="background-color: #f1f1f1; padding: 15px; margin-bottom: 10px; border-radius: 5px;">
                                    <div style="font-weight: bold; color: #333333; font-size: 16px;">{{ $task['title'] }}</div>
                                    <div style="color: #777777; font-size: 14px; margin-top: 5px;">{{ $task['description'] }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
