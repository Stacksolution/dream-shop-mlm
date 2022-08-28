@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Product</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Create Product</li>
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
                        <h4 class="card-title">Create Product</h4>
                     </div>
                     <div class="col-md-4 text-right">
                        <div class="card-footer bg-transparent" style="margin-top: -17px;">
                           <div class="text-center">
                              <a href="{{route('product.index')}}" class="btn btn-outline-primary btn-sm align-middle me-2" title="New Team" style="float: right;"> 
                              <i class="fas fa-plus"></i>All Products
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <form action="{{ route('product.update',[$product->id]) }}" method="POST" class="needs-validation" novalidate>
                     @csrf
                     {{ method_field('PUT') }}
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Name</label>
                              <div class="input-group" id="contact_name">
                                 <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter name" name="name" value="{{ old('name',$product->product_name) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('name')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>HSN<small>(Code)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('hsn') ? 'is-invalid' : '' }}" placeholder="Enter Hsn code" name="hsn" value="{{ old('hsn',$product->product_hsn) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('hsn')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Product<small>(amount)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" placeholder="Enter amount" name="amount" value="{{ old('amount',$product->product_price) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('amount')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Capping<small>(amount)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('capping') ? 'is-invalid' : '' }}" placeholder="Enter capping amount" name="capping" value="{{ old('capping',$product->product_capping) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('capping')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Direct<small>(income)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('direct_income') ? 'is-invalid' : '' }}" placeholder="Enter direct income" name="direct_income" value="{{ old('direct_income',$product->product_direct_income) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('direct_income')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Generation<small>(income)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('generation_income') ? 'is-invalid' : '' }}" placeholder="Enter generation income" name="generation_income" value="{{ old('generation_income',$product->product_generation_income) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('generation_income')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Point<small>(value)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('point_value') ? 'is-invalid' : '' }}" placeholder="Enter point value" name="point_value" value="{{ old('point_value',$product->product_point_value) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('point_value')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-4">
                              <label>Rewards<small>(point)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('rewards_point') ? 'is-invalid' : '' }}" placeholder="Enter rewards point" name="rewards_point" value="{{ old('rewards_point',$product->product_rewards) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('rewards_point')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="mb-4">
                              <label>Royalty<small>(income)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('royalty_income') ? 'is-invalid' : '' }}" placeholder="Enter royalty income" name="royalty_income" value="{{ old('royalty_income',$product->product_royalty) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('royalty_income')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="mb-4">
                              <label>Core Team<small>(income)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('core_team_income') ? 'is-invalid' : '' }}" placeholder="Enter core team income" name="core_team_income" value="{{ old('core_team_income',$product->product_core_team) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('core_team_income')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="mb-4">
                              <label>Bonanza<small>(Point)</small></label>
                              <div class="input-group">
                                 <input type="text" class="form-control {{ $errors->has('bonanza_point') ? 'is-invalid' : '' }}" placeholder="Enter bonanza point" name="bonanza_point" value="{{ old('bonanza_point',$product->product_bonanza_point) }}">
                                 <span class="input-group-text"><i class="bx bx-user"></i></span>
                              </div>
                              @error('bonanza_point')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="mt-2">
                        <button class="btn btn-primary" type="submit">Save</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection