<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <img src="media/content/headerpdf.png" width="100%"  style="display: block;">
    <img src="{{$banner}}" width="100%"  style="display: block;">
      @if (!empty($cupon))
        <div style="padding-left:-20px; text-align:center;">
            <p style="font-size:20px; margin:0px;">{{ $user }}</p>
            <p style="font-size:30px; margin:0px;">{{ $nombre }}</p>
            <img style="padding-top: 60px; margin:0px;" src="data:image/png;base64,{{ $img }}">
            <p style="font-size:25px;">Código de acceso.</p>
        </div>
        <img style="margin:0px;" src="media/general/plecagdl.png" width="100%"  style="display: block;">
        <img style="margin:0px;" src="resources/cupones/{{ $cupon }}.png" width="100%"  style="display: block;">
        <img style="margin:0px;" src="resources/footerpdf.png" width="100%"  style="display: block;">
    @else
        <div style="padding-top:60px; padding-left:-20px; text-align:center;">
            <p style="font-size:20px; margin:0px;">{{ $user }}</p>
            <p style="font-size:30px; margin:0px;">{{ $nombre }}</p>
            <img style="padding-top: 80px; margin:0px;" src="data:image/png;base64,{{ $img }}">
            <p style="font-size:25px;">Código de acceso.</p>
        </div>
        {{-- <img style="padding-top: 50px; margin:0px;" src="media/general/plecagdl.png" width="100%"  style="display: block;"> --}}
        <img style="padding-top: 50px; margin:0px;" src="media/content/footerpdf.png" width="100%"  style="display: block;">
    @endif
</body>
</html>