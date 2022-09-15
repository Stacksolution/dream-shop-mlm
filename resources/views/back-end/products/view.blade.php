@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Products</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Products Records</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="product-detai-imgs">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="tab-content" id="v-pills-tabContent">
                                          <div>
                                              <img src="{{image_path($product->product_icon)}}" alt="" class="img-fluid mx-auto d-block">
                                          </div>
                                        </div>
                                        <div class="text-center">
                                            <a class="btn btn-outline-primary waves-effect waves-light mt-2 me-1" href="{{route('order.now',[$product->id,'wallets'])}}">
                                                <i class="bx bx-wallet me-2"></i> Pay By Wallet
                                            </a>
                                            <a href="{{route('order.now',[$product->id,'online'])}}" class="btn btn-outline-success waves-effect mt-2 waves-light">
                                             <i class="bx bx-shopping-bag me-2"></i>
                                             Pay Online
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-1">
                                <h4 class="mt-1 mb-1">{{$product->product_name}}</h4>
                                <p class="text-muted mb-2">( 152 Active Member )</p>
                                <h5 class="mb-4">Price : <b>Rs. {{$product->product_price}}</b></h5>
                                <div class="row mb-1">
                                    <div class="col-md-12 col-sm-12">
                                       <div class="table-responsive">
                                           <table class="table mb-0 table-bordered">
                                               <tbody>
                                                   <tr>
                                                       <th scope="row">Capping</th>
                                                       <td>Rs.{{$product->product_capping}}</td>
                                                   </tr>
                                                   <tr>
                                                       <th scope="row">Direct Income</th>
                                                       <td>Rs.{{$product->product_direct_income}}</td>
                                                   </tr>
                                                   <tr>
                                                       <th scope="row">Generation Income</th>
                                                       <td>{{$product->product_generation_income}}%</td>
                                                   </tr>
                                                   <tr>
                                                       <th scope="row">Point Value</th>
                                                       <td>Point {{$product->product_point_value}}</td>
                                                   </tr>
                                                   <tr>
                                                       <th scope="row">Rewards Value</th>
                                                       <td>Point {{$product->product_rewards}}</td>
                                                   </tr>
                                                   <tr>
                                                       <th scope="row">Royalty</th>
                                                       <td>Rs.{{$product->product_royalty}}</td>
                                                   </tr>
                                                    <tr>
                                                       <th scope="row">Core Team</th>
                                                       <td>Rs.{{$product->product_core_team}}</td>
                                                   </tr>
                                                    <tr>
                                                       <th scope="row">Bonanza</th>
                                                       <td>Point {{$product->product_bonanza_point}}</td>
                                                   </tr>
                                               </tbody>
                                           </table>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>
</div>
@endsection