<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <img src="media/content/cardMail.png" width="100%"  height="950px" style="position: absolute;">
    <p style="font-size: 30px; margin-top: 12%; margin-left: 8%; margin-bottom: 0px; z-index: 100; color: white;  padding: 0px;">
        NOMBRE<br>
        <span style="font-size: 28px; margin-top: 0px; z-index: 100; color: rgb(245, 245, 245); padding: 0px;">{{$name}}</span>
        <br><br>VALOR<br>
        <span style="font-size: 28px; margin-top: 0px; z-index: 100; color: rgb(245, 245, 245); padding: 0px;">{{$price}}</span>
    </p>
    <img style="width: 40%; margin-left: 30%; margin-top: 80px; z-index: 100;" src="data:image/png;base64,{{$img}}">
</body>
</html>