<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMS</title>

    <link rel="icon" type="image/png" href="favicon.png" sizes="16x16"/>
    <link type="text/css" rel="stylesheet" href="vendor/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="vendor/css/bootstrap-theme.min.css"/>
</head>
<body>
{{ $slot }}
</body>
</html>

