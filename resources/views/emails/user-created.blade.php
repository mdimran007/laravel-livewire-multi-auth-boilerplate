<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Our {{ getSettingData('app_name')!=null?getSettingData('app_name'):'' }} System</title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>

    <p>Welcome to Our {{ getSettingData('app_name')!=null?getSettingData('app_name'):'' }} System</p>

    <p>Your account has been created successfully.</p>

    <p><strong>Login Details:</strong></p>
    <p>Email: {{ $user->email }}</p>
    <p>Password: {{ $plainPassword }}</p>

    <p>Please login and change your password immediately after first login.</p>

    <br>
    <p>Regards,<br>{{ getSettingData('app_name')!=null?getSettingData('app_name'):'BUBT System' }}</p>
</body>
</html>
