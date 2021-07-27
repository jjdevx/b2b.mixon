<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" type="image/svg+xml" href="/dist/img/favicon.svg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>{{$page['props']['metaInfo']['title']}} - Mixon</title>
    <!-- Styles -->
    <link href="{{ mix('dist/css/app.css') }}" rel="stylesheet"/>
</head>
<body>
@inertia
@routes('account')
<script src="{{ mix('dist/js/manifest.js') }}" defer></script>
<script src="{{ mix('dist/js/vendor.js') }}" defer></script>
<script src="{{ mix('dist/js/app.js') }}" defer></script>
</body>
</html>
