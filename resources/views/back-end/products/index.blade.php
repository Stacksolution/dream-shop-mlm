@extends('back-end.layouts.app')
@section('header')
<link href="{{ static_asset('back-end/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ static_asset('back-end/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
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
      <!-- end page title -->
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row mb-4">
                     <div class="col-md-8">
                        <h4 class="card-title">Products Records</h4>
                     </div>
                     <div class="col-md-4 text-right">
                        <div class="card-footer bg-transparent" style="margin-top: -17px;">
                           <div class="text-center">
                              <a href="{{route('product.create')}}" class="btn btn-outline-primary btn-sm align-middle me-2" title="New Team" style="float: right;"> 
                              <i class="fas fa-plus"></i> New Product
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12" style="overflow-x:auto;">
                     <table class="table table-bordered dt-responsive w-100">
                        <thead>
                           <tr>
                              <th>Sr</th>
                              <th>Thumbnail</th>
                              <th>Name</th>
                              <th>Price</th>
                              <th>Capping</th>
                              <th>Direct</th>
                              <th>Generation</th>
                              <th>Point</th>
                              <th>Rewards</th>
                              <th>Bonanza</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($products as $key => $data)
                           <tr>
                              <td>{{ $key + $products->firstItem() }}</td>
                              <td><img src="{{ image_path($data->product_icon) }}" class="img-thumbnail avatar-sm"></td>
                              <td>{{ $data->product_name }}</td>
                              <td>{{ $data->product_price }}</td>
                              <td>{{ $data->product_capping }}</td>
                              <td>{{ $data->product_direct_income }}</td>
                              <td>{{ $data->product_generation_income }}</td>
                              <td>{{ $data->product_point_value }}</td>
                              <td>{{ $data->product_rewards }}</td>
                              <td>{{ $data->product_bonanza_point }}</td>
                              <td class="text-center">
                                 <a href="{{route('product.edit',[$data->id])}}" class="btn btn-sm btn-outline-success"><i class="bx bx-edit"></i></a>
                                 <a href="javascript:;" class="btn btn-sm btn-outline-danger" onclick="if(confirm('Are you sure you want to delete this item?')) { event.preventDefault();document.getElementById('delete-form').submit();}" ><i class="bx bx-trash"></i></a>
                                 <form id="delete-form" action="{{route('product.destroy',[$data->id])}}" method="POST" class="d-none">
                                     @csrf
                                     {{method_field('DELETE')}}
                                 </form>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     {{ $products->links('pagination::bootstrap-5') }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection