@yield('css')
<style>
.dataTables_wrapper .dataTables_processing {
    position: fixed !important;
    top: 80% !important;
    background:#F8F8FB;
}
.pac-container {
    z-index: 10000 !important;
}
</style>
<!-- Bootstrap Css -->
<link href="{{ URL::asset('/assets/admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('/assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('/assets/admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
{{-- <link
      href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet"
/> --}}
