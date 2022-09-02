<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Webtalks</title>

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 16px;
    }
    .container {
      background-color: #F8EFEA;
      width: 50%;
      margin: 50px auto;
      padding: 50px 15px;
      border-radius: 15px;
    }

    .logo {
      text-align: center;
      text-transform: uppercase;
    }

    .message-body {
      margin-top: 20px;
      background-color: rgb(152, 128, 128);
      color: #fff;
      padding: 20px;
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
    <p style="margin-top: 30px; padding: 10px">
      Dear {{$emailData['message']->name}}, this email has been delivered to you by <strong>Webtalks</strong> regarding your query. Below is the answer given by Webtalks.
    </p>
    <div class="message-body">
      {{$emailData['reply']}}
    <div>
  </div>
</body>
</html>