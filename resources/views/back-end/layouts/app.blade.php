<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8" />
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="app-url" content="{{ getBaseURL() }}">
   <meta name="file-base-url" content="{{ getFileBaseURL() }}">
   <title>{{ config('app.name', 'Stack') }}</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
   <link rel="shortcut icon" href="{{ static_asset('back-end/images/favicon.ico')}}">
   <link href="{{ static_asset('back-end/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
   <link href="{{ static_asset('back-end/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
   <link href="{{ static_asset('back-end/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
   <link href="{{ static_asset('uploader/css/uploader.min.css')}}" rel="stylesheet" type="text/css"></link>
   <script>
      var AIZ = AIZ || {};
       AIZ.local = {
           nothing_selected: '{!! __('Nothing selected') !!}',
           nothing_found: '{!! __('Nothing found') !!}',
           choose_file: '{{ __('Choose file') }}',
           file_selected: '{{ __('File selected') }}',
           files_selected: '{{ __('Files selected') }}',
           add_more_files: '{{ __('Add more files') }}',
           adding_more_files: '{{ __('Adding more files') }}',
           drop_files_here_paste_or: '{{ __('Drop files here, paste or') }}',
           browse: '{{ __('Browse') }}',
           upload_complete: '{{ __('Upload complete') }}',
           upload_paused: '{{ __('Upload paused') }}',
           resume_upload: '{{ __('Resume upload') }}',
           pause_upload: '{{ __('Pause upload') }}',
           retry_upload: '{{ __('Retry upload') }}',
           cancel_upload: '{{ __('Cancel upload') }}',
           uploading: '{{ __('Uploading') }}',
           processing: '{{ __('Processing') }}',
           complete: '{{ __('Complete') }}',
           file: '{{ __('File') }}',
           files: '{{ __('Files') }}',
       }
   </script>   
   <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=62cedc8c987470001990b4cb&product=inline-share-buttons' async='async'></script>
   @yield('header')
</head>
<body data-sidebar="dark" data-layout-scrollable="true">
   <div id="layout-wrapper">
      @include('back-end.include.header-file')
      @include('back-end.include.left-sidebar')
      <div class="main-content">
      @yield('content')
      @include('back-end.include.footer-file')
      </div>
   </div>
   <div class="rightbar-overlay"></div>
   <script src="{{ static_asset('back-end/libs/jquery/jquery.min.js')}}"></script>
   <script src="{{ static_asset('back-end/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
   <script src="{{ static_asset('back-end/libs/metismenu/metisMenu.min.js')}}"></script>
   <script src="{{ static_asset('back-end/libs/simplebar/simplebar.min.js')}}"></script>
   <script src="{{ static_asset('back-end/libs/node-waves/waves.min.js')}}"></script>
    @yield('script')
   <script src="{{ static_asset('back-end/js/app.js')}}"></script>
   <script src="{{ static_asset('uploader/js/aiz-core.js')}}"></script>
   <script src="{{ static_asset('uploader/js/uppy.js')}}"></script>
</body>
</html>
@if($message = Session::get('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1005">
   <div id="liveToast" class="toast fade hide text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
           <div class="toast-body">
               {{$message}}
           </div>
           <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
       </div>
   </div>
</div>
<script type="text/javascript">
  var toastLiveExample = document.getElementById('liveToast')
  var toast = new bootstrap.Toast(toastLiveExample)
  toast.show()
</script>
@endif
@if($message = Session::get('error'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1005">
   <div id="liveToast" class="toast fade hide text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
           <div class="toast-body">
               {{$message}}
           </div>
           <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
       </div>
   </div>
</div>
<script type="text/javascript">
  var toastLiveExample = document.getElementById('liveToast')
  var toast = new bootstrap.Toast(toastLiveExample)
  toast.show()
</script>
@endif
