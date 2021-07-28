<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>{{$page['props']['metaInfo']['title']}} - Mixon</title>
    <link rel="icon" href="/favicon.ico" type="image/svg+xml">
    <link href="{{ mix('css/app.css','dist') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap|Material+Icons" rel="stylesheet">
</head>
<body>
@inertia
@routes('account')
<script src="{{ mix('js/manifest.js','dist') }}" defer></script>
<script src="{{ mix('js/vendor.js','dist') }}" defer></script>
<script src="{{ mix('js/app.js','dist') }}" defer></script>
</body>
</html>
