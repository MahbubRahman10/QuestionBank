
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up Confirmation</title>

    <style type="text/css">
    .titleimage {
        position: relative;
        font-size: 30px;
        margin-top: 0;
        font-family: 'Lobster', helvetica, arial;
        text-align: center;
        font-weight: bold;
    }
    .titleimage a {
        text-decoration: none;
        color: #4c4c4c;
        position: absolute;     
        -webkit-mask-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,1)), color-stop(50%, rgba(0,0,0,.5)), to(rgba(0,0,0,1)));
    }
    .titleimage:after {
        content : "Question Bank";
        color: #d1d1d1;
        text-shadow: 0 1px 0 white;
    }
    </style>

</head>
<body>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

    
    <div style="background:#f9f9f9;padding: 30px 0px;">
        <div style="margin:0px auto;max-width:640px; background: white; padding: 20px 20px;">
            <h2 class="titleimage"><a href="">Question Bank</a></h2>
            <br>
            <p style="font-weight:500;font-size:20px;color:#4f545c;letter-spacing:0.27px">Hello {{ $user->name }},</p>
            <p style="color: #737f8d;font-size: 16px;line-height: 24px;text-align: left;">Thanks for registering for an account on Qbank! Before we get started, we just need to confirm that this is you. Click below to verify your email address:</p> 
            <p style="text-align: center; margin-top:40px;margin-bottom: 40px;">
                <a href='{{ url("register/verify/{$user->email_token}") }}' style="text-decoration:none;line-height:100%;background:#7289da;color:white;font-family:Ubuntu,Helvetica,Arial,sans-serif;font-size:15px;font-weight:normal;text-transform:none;margin:0px; padding: 10px 10px; border-radius: 2px;font-weight: bold;">Verify Email</a>
            </p> 
            <div style="border-bottom:1px solid #dcddde;"></div>            <!-- <p>Thank you!</p> <br>
            <p><strong>Regards,</strong></p>
            <p>Team Qbank</p> -->

            <p style="margin-top: 40px;color:#4f545c;font-size: 15px;text-align:center;" >Need help? <a href="http://localhost:8000/contact-us" style="font-family:Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;color:#7289da" target="_blank" >Contact our support team</a> or Follow us on Twitter <a href="https://twitter.com" style="font-family:Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;color:#7289da" target="_blank" >@qbank</a>.
            </p>
            <p style="text-align:center;color:#4f545c;font-size: 15px;">Copyright ©Qbank, All rights reserved.</p>
        </div>
    </div>
</body>
</html>