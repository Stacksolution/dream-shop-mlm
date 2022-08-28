@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Packages</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Packages</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               @foreach($products as $key => $data)
               <div class="col-xl-3 col-sm-6">
                  <a href="{{route('product.show',[$data->id])}}" class="text-dark">
                     <div class="card">
                        <div class="card-body">
                           <div class="product-img position-relative">
                              <div class="avatar-sm product-ribbon">
                                 <span class="avatar-title rounded-circle bg-primary">
                                 - 25 %
                                 </span>
                              </div>
                              <img src="https://www.underseaproductions.com/wp-content/uploads/2013/11/dummy-image-square-600x600.jpg" alt="" class="img-fluid mx-auto d-block">
                           </div>
                           <div class="mt-4 text-center">
                              <h5 class="mb-3 text-truncate"><a href="{{route('product.show',[$data->id])}}" class="text-dark">{{ $data->product_name }}</a></h5>
                              <h5 class="my-0"><span class="text-muted me-2"></span> <b>RS. {{ $data->product_price }}</b></h5>
                           </div>
                        </div>
                     </div>
                  </a>
               </div>
               @endforeach
            </div>
            <div class="row">
               <div class="col-lg-12">
                  {{ $products->links('pagination::bootstrap-5') }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection