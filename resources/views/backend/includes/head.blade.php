<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ asset($siteSettings->tab_icon) }}">

<title>{{ $siteSettings->name }} | Admin</title>

<!-- Vendors Style-->
<link rel="stylesheet" href="{{ asset('backend/theme/css/vendors_css.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
<!-- Style-->  
<link rel="stylesheet" href="{{ asset('backend/theme/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('backend/theme/css/skin_color.css') }}">
<style>
    .dataTables_length select{
        width: 50% !important;
    }
    
    .toast{
        box-shadow: none !important;
        font-size: 11.5pt !important;
        opacity: 0.9 !important;
    }
    .toast:hover{
        opacity: 1 !important;
    }
    
</style>