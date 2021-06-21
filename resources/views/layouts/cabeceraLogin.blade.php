<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
  <meta name="csrf-token" content="8vi32X9gBh6BDQRgbrEYEf2K3AmwYXMsiziA6VmJ">
  <title>SGE</title>
  <!-- Font Awesome -->
  <link href="{{asset('/res/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('/res/recurso/app.css') }}">
  <link rel="stylesheet" href="{{asset('/res/recurso/animate.min.css') }}">
  <link rel="stylesheet" href="{{asset('/res/build/css/estiloSGE.css') }}">
</head>
<body>
  <main class="py-4">
    @yield('content')
  </main>
  <script src="{{asset('/res/recurso/app.js.descarga') }}"></script>
  <div id="notify" class="notifxi-alert"></div>
</body>
</html>
