<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ Vite::asset('resources/src/assets/img/logo/favicon.ico') }}"/>
    <title>{{ config('app.name') }}</title>

    @routes
  </head>
  <body>
    <div id="app">
    </div>

    @vite('resources/src/main.ts')
  </body>
</html>
