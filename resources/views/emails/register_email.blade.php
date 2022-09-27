<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Webtalks | Email Verification</title>

  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 16px;
    }
    .container {
      background-color: #F8EFEA;
      width: 50%;
      margin: 50px auto;
      padding: 50px 10px;
      border-radius: 15px;
    }

    .logo {
      text-align: center;
      text-transform: uppercase;
    }

    .title {
      font-weight: 500;
      text-align: center;
      margin-top: 50px;
      font-size: 3rem;
    }

    p {
      font-size: 1.5rem;
      text-align: center;
    }

    .button {
      padding: 10px 20px;
      background-color: #CE8460;
      color: #ffff;
      text-decoration: none;
      border-radius: 15px;
      text-transform: uppercase;
      font-weight: bold;
    }

    .button:hover {
      background-color: #ffff;
      color: #333333;
      border: 1px solid #CE8460;
    }

    @media (max-width: 540px) {
      .container {
        width: 90%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="logo">Web<span style="color: red">talks<span></h2>
    <h1 class="title">Thanks for signing up, {{$emailData['user']}}!</h1>
    <p>You have successfully registered your account on Webtalks. Please verify your email address by clicking on the button below.<br><span style="color: green;"><b>Thank you!</b></span></p>
    <div style="text-align: center; margin-top: 50px">
    <a href="{{ route('verify_email', urlencode($emailData['verification_code'])) }}" class="button">Verify Email Now</a>
  </div>
  </div>
</body>
</html>