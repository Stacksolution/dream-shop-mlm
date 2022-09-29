@if($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Alert !</strong> {{$message}}
</div>
@endif
@if($message = Session::get('success'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Alert !</strong> {{$message}}
</div>
@endif