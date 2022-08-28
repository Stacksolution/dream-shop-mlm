@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Binary Plan Team</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Team create</li>
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
                        <h4 class="card-title">Team create</h4>
                     </div>
                     <div class="col-md-4 text-right">
                        <div class="card-footer bg-transparent" style="margin-top: -17px;">
                           <div class="text-center">
                              <a href="{{route('binary.index')}}" class="btn btn-outline-primary btn-sm align-middle me-2" title="New Team" style="float: right;"> 
                              <i class="fas fa-plus"></i> Back
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  @if(empty($parents) || empty($member) || empty($sponsor))
                  <form action="{{ route('binary.create') }}" method="GET" class="needs-validation" novalidate>
                  @else
                  <form action="{{ route('binary.store') }}" method="post" class="needs-validation" novalidate>
                  @endif
                     @csrf
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mt-4 mb-4">
                              <label>Convert ID</label>
                              <div class="hstack gap-3">
                                 <input type="text" class="form-control me-auto {{ $errors->has('member_id') ? 'is-invalid' : '' }}" placeholder="Enter convert id" name="member_id" value="{{!empty($member) ? $member->user_referral : ''}}" @if(!empty($member)) {{"readonly"}} @endif onkeyup="this.value = this.value.toUpperCase();">
                                 @if(empty($member))
                                 <button type="submit" class="btn btn-secondary"><i class="bx bx-search-alt-2"></i></button>
                                 @else
                                 <a href="{{route('binary.create')}}" class="btn btn-outline-danger"><i class="bx bx-arrow-back"></i></a>
                                 @endif
                              </div>
                           </div>
                           @error('member_id')
                           <div class="text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                        @if(!empty($member))
                        <div class="col-md-6">
                           <div class="card bg-dark text-light mt-4">
                              <div class="card-body">
                                 <div class="text-center">
                                    <div class="row">
                                       <div class="col-sm-4">
                                          <div>
                                             <h5 class="font-size-15 text-light">Convert Name</h5>
                                             <p class="text-light mb-2 text-truncate">{{$member->name}}</p>
                                          </div>
                                       </div>
                                       <div class="col-sm-4">
                                          <div class="mt-4 mt-sm-0">
                                             <h5 class="font-size-15 text-light">Convert ID</h5>
                                             <p class="text-light mb-2">{{$member->user_referral}}</p>
                                          </div>
                                       </div>
                                       <div class="col-sm-4">
                                          <div class="mt-4 mt-sm-0">
                                             <h5 class="font-size-15 text-light">Convert Status</h5>
                                             @php 
                                                $member_status = \App\Models\Binary::where('binary_user_id',$member->id)->where('binary_status',1)->count();
                                             @endphp
                                             @if($member_status > 1)
                                             <p class="text-light mb-2">Active</p>
                                             @else
                                             <p class="text-light mb-2">InActive</p>
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endif
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mt-4 mb-4">
                              <label>Sponsor ID</label>
                              <div class="hstack gap-3">
                                 <input class="me-auto form-control {{ $errors->has('sponsor_id') ? 'is-invalid' : '' }}" placeholder="Enter sponsor id" name="sponsor_id" value="{{!empty($sponsor) ? $sponsor->user_referral : ''}}" @if(!empty($sponsor)) {{"readonly"}} @endif onkeyup="this.value = this.value.toUpperCase();">
                                 @if(empty($sponsor))
                                 <button type="submit" class="btn btn-secondary"><i class="bx bx-search-alt-2"></i></button>
                                 @else
                                 <a href="{{route('binary.create')}}" class="btn btn-outline-danger"><i class="bx bx-arrow-back"></i></a>
                                 @endif
                              </div>
                           </div>
                           @error('sponsor_id')
                           <div class="text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                        @if(!empty($sponsor))
                        <div class="col-md-6">
                           <div class="card bg-dark text-light mt-4">
                              <div class="card-body">
                                 <div class="text-center">
                                    <div class="row">
                                       <div class="col-sm-4">
                                          <div>
                                             <h5 class="font-size-15 text-light">Sponsor</h5>
                                             <p class="text-light mb-2 text-truncate">{{$sponsor->name}}</p>
                                          </div>
                                       </div>
                                       <div class="col-sm-4">
                                          <div class="mt-4 mt-sm-0">
                                             <h5 class="font-size-15 text-light">Sponsor ID</h5>
                                             <p class="text-light mb-2">{{$sponsor->user_referral}}</p>
                                          </div>
                                       </div>
                                       <div class="col-sm-4">
                                          <div class="mt-4 mt-sm-0">
                                             <h5 class="font-size-15 text-light">Binary Status</h5>
                                             @php 
                                                $sponsor_status = \App\Models\Binary::where('binary_parent_id',$sponsor->id)->where('binary_status',1)->count();
                                             @endphp
                                             @if($sponsor_status > 1)
                                             <p class="text-light mb-2">Active</p>
                                             @else
                                             <p class="text-light mb-2">InActive</p>
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endif
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="mt-4 mb-4">
                              <label>Parents ID</label>
                              <div class="hstack gap-3">
                                 <input class="me-auto form-control {{ $errors->has('parents_id') ? 'is-invalid' : '' }}" placeholder="Enter parents id" name="parents_id" value="{{!empty($parents) ? $parents->user_referral : ''}}" @if(!empty($parents)) {{"readonly"}} @endif onkeyup="this.value = this.value.toUpperCase();">
                                 @if(empty($parents))
                                 <button type="submit" class="btn btn-secondary"><i class="bx bx-search-alt-2"></i></button>
                                 @else
                                 <a href="{{route('binary.create')}}" class="btn btn-outline-danger"><i class="bx bx-arrow-back"></i></a>
                                 @endif
                              </div>
                           </div>
                           @error('parents_id')
                           <div class="text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                        @if(!empty($parents))
                        <div class="col-md-6">
                           <div class="card bg-dark text-light mt-4">
                              <div class="card-body">
                                 <div class="text-center">
                                    <div class="row">
                                       <div class="col-sm-4">
                                          <div>
                                             <h5 class="font-size-15 text-light">Parents</h5>
                                             <p class="text-light mb-2 text-truncate">{{$parents->name}}</p>
                                          </div>
                                       </div>
                                       <div class="col-sm-4">
                                          <div class="mt-4 mt-sm-0">
                                             <h5 class="font-size-15 text-light">Parents ID</h5>
                                             <p class="text-light mb-2">{{$parents->user_referral}}</p>
                                          </div>
                                       </div>
                                       <div class="col-sm-4">
                                          <div class="mt-4 mt-sm-0">
                                             <h5 class="font-size-15 text-light">Binary Status</h5>
                                             @php 
                                                $parents_status = \App\Models\Binary::where('binary_parent_id',$parents->id)->where('binary_status',1)->count();
                                             @endphp
                                             @if($parents_status > 1)
                                             <p class="text-light mb-2">Active</p>
                                             @else
                                             <p class="text-light mb-2">InActive</p>
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endif
                     </div>
                     @if(!empty($parents))
                     <div class="row">
                        <div class="col-md-3">
                           <div class="mb-4">
                              @php 
                                 $parents_position = \App\Models\Binary::where('binary_parent_id',$parents->id)->where('binary_user_side','R')->count();
                              @endphp
                              <div class="form-check form-check-right">
                                 <input class="form-check-input" type="radio" name="position" value="R" @if($parents_position > 0) {{"disabled"}} @endif>
                                 <label class="form-check-label" for="position">
                                 Binary Position Right Side
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="mb-4">
                              @php 
                                 $parents_position = \App\Models\Binary::where('binary_parent_id',$parents->id)->where('binary_user_side','L')->count();
                              @endphp
                              <div class="form-check form-check-right">
                                 <input class="form-check-input" type="radio" name="position" value="L"  @if($parents_position > 0) {{"disabled"}} @endif>
                                 <label class="form-check-label" for="position">
                                 Binary Position Left Side
                                 </label>
                              </div>
                           </div>
                        </div>
                        @error('position')
                           <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     @endif
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