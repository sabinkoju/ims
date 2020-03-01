<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body style="font-family: 'Poppins', sans-serif;">

<div class="email-wrapper-container" style="width: 50%; margin: 40px auto; padding: 20px 50px; background: #f5f5f5;">
    <!-- LOGO -->

    <div class="main-content-wrap" style="background: #fff; padding: 30px 40px; margin-bottom: 30px;">

        <div class="logo-wrap" style="height: 100px; width: 100%; margin-bottom: 15px;">
            <a href="#"><img src="http://localhost:8888/nepaltoursandtravels/public/frontAssets/images/logo.png" alt="LOGO" style="height: 100%; width:100%; object-fit:contain;"></a>
        </div>

        <h2 style="font-size: 1.6rem; font-weight: 400; color:#333;">Hello {{ $name }},</h2>
        <p style="color: #777; line-height: 1.9;"> Your Password Details has been just updated for {{ $email }} </p>
        <p style="color: #777; line-height: 1.9;"> New Password : {{ $updated_password }} </p>


        <p style="color: #777; line-height: 1.9; margin-bottom: 20px;">If you didn't update to System, Please delete this email.</p>
        <p style="color: #777; line-height: 1.9; margin-bottom: 0;">Cheers,</p>
        <a href="#">
            <h2 style="display:inline-block; font-size: 1.8rem; font-weight: 600; color: #220c9e; margin: 0; padding: 0;">IMS Software</h2>
        </a>
    </div>

</div>

</body>
</html>