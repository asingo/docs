<!doctype html>
<html lang="en">
<head>
    @vite('resources/css/app.css')
</head>
<body style="background: url({{URL::asset('/img/cover-fix-01.jpg')}}); background-repeat:no-repeat; background-image-resize:6;">

<h1 style="color: white; padding-top: 90%; font-size: 42px; padding-left: 58px">Dokumentasi Website</h1>
<h1 style="color: white; font-size: 42px; padding-left: 58px; font-weight: 400;">{{auth()->user()->company}}</h1>
<h4 style="color: #9a1f34; font-size: 24px; padding-top:13%; padding-left: 110px">{{date('d F Y')}}</h4>
</body>
</html>
