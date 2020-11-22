
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
        *{
            font-family: tahoma,Arial, 'Helvetica Neue', Helvetica, sans-serif;
            direction: rtl;
            line-height: 1.4;
            color: #74787E;
            -webkit-text-size-adjust: none;
            max-width: 100%;

        }
        .col-md-6{
            width: 60%;
            margin: auto;
        }
        @media only screen and (max-width: 600px) {
            .col-md-6{
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div style="background: #F2F2F2; padding: 20px; text-align: center">
        <a href="https://irpay.in" class="email-masthead_name">
            <img src="https://irpay.in/panel/app-assets/images/logo.png" style="width: 100px;">
        </a>
    </div>

    <div class="col-md-6">
        <div style="text-align: right;">
            <h1 style="text-align: center;font-size: 17px;margin-top: 10px">صرافی آنلاین آی آر پی</h1>
            <hr width="10%">
            <p>اطلاعیه آی آر پی برای شما:</p>
            <p style="line-height: 0;text-align: left">{{$date}}</p>
            <h3>{{$title}}</h3>
            <p>{{$body}}</p>
        </div>


        <div style="background: #F2F2F2; padding: 30px;text-align: center!important;">
            <p style="direction: ltr">&copy; 2019 irPay. All rights reserved.</p>
            <p>
                <br>info@irPay.in
            </p>
        </div>
    </div>
</body>
</html>