<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta -->
    <title>
      {{
        Str::title(Str::remove('page', Str::replace('.', ' ', Route::currentRouteName())))
      }}
    </title>

    <!-- vendor css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('backend/login/css/ionicons.min.css') }}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('backend/login/css/bracket.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/login/css/bracket.dark.css') }}">
  </head>

  <body style="background-color: #1D253C !important;">