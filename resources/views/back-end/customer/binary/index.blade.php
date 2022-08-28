@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Binary Team</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Binary Team</li>
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
                        <h4 class="card-title">Binary Team</h4>
                     </div>
                     <div class="col-md-4 text-right">
                        <div class="card-footer bg-transparent" style="margin-top: -17px;">
                           <div class="text-center">
                              <a href="{{route('binary.create')}}" class="btn btn-outline-primary btn-sm align-middle me-2" title="New Team" style="float: right;"> 
                              <i class="fas fa-plus"></i> New Team
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="body genealogy-body genealogy-scroll">
                     @if(empty($records[0]))
                     @include('back-end.include.data-not-found')
                     @endif
                     <div class="genealogy-tree">
                        <ul>
                           @foreach($records as $key => $data_1)
                           <li>
                              <a href="{{route('binary.show',[$data_1->user->id])}}">
                                 <div class="d-flex" style="box-shadow: 5px 5px 10px #888888;border-radius: 5px; padding: 10px;">
                                    <div class="align-self-center me-3">
                                       @if($data_1->binary_status == 1)
                                       <i class="mdi mdi-circle text-success font-size-10"></i>
                                       @else
                                       <i class="mdi mdi-circle text-danger font-size-10"></i>
                                       @endif
                                    </div>
                                    <div class="align-self-center me-3">
                                        <img src="{{ static_asset('back-end/images/users/avatar-1.jpg')}}" class="rounded-circle avatar-xs" alt="">
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-14 mb-1">{{ $data_1->user->name }}</h5>
                                        <p class="text-truncate mb-0">{{$data_1->user->user_referral}}</p>
                                    </div>
                                </div>
                              </a>
                              @if(count($data_1->children) > 0)
                              <ul class="active">
                                 @foreach($data_1->children as $key => $data_2)
                                 <li>
                                    <a href="{{route('binary.show',[$data_2->user->id])}}">
                                       <div class="d-flex" style="box-shadow: 5px 5px 10px #888888;border-radius: 5px; padding: 10px;">
                                          <div class="align-self-center me-3">
                                             @if($data_2->binary_status == 1)
                                             <i class="mdi mdi-circle text-success font-size-10"></i>
                                             @else
                                             <i class="mdi mdi-circle text-danger font-size-10"></i>
                                             @endif
                                          </div>
                                          <div class="align-self-center me-3">
                                              <img src="{{ static_asset('back-end/images/users/avatar-1.jpg')}}" class="rounded-circle avatar-xs" alt="">
                                          </div>
                                          <div class="flex-grow-1 overflow-hidden">
                                              <h5 class="text-truncate font-size-14 mb-1">{{ $data_2->user->name }}</h5>
                                              <p class="text-truncate mb-0">{{$data_2->user->user_referral}}</p>
                                          </div>
                                      </div>
                                    </a>
                                    @if(count($data_2->children) > 0)
                                    <ul class="active">
                                       @foreach($data_2->children as $key => $data_3)
                                       <li>
                                          <a href="{{route('binary.show',[$data_3->user->id])}}">
                                             <div class="d-flex" style="box-shadow: 5px 5px 10px #888888;border-radius: 5px; padding: 10px;">
                                                <div class="align-self-center me-3">
                                                   @if($data_3->binary_status == 1)
                                                   <i class="mdi mdi-circle text-success font-size-10"></i>
                                                   @else
                                                   <i class="mdi mdi-circle text-danger font-size-10"></i>
                                                   @endif
                                                </div>
                                                <div class="align-self-center me-3">
                                                    <img src="{{ static_asset('back-end/images/users/avatar-1.jpg')}}" class="rounded-circle avatar-xs" alt="">
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">{{ $data_3->user->name }}</h5>
                                                    <p class="text-truncate mb-0">{{$data_3->user->user_referral}}</p>
                                                </div>
                                            </div>
                                          </a>
                                          @if(count($data_3->children) > 0)
                                          <ul class="active">
                                             @foreach($data_3->children as $key => $data_4)
                                             <li>
                                                <a href="{{route('binary.show',[$data_4->user->id])}}">
                                                   <div class="d-flex" style="box-shadow: 5px 5px 10px #888888;border-radius: 5px; padding: 10px;">
                                                      <div class="align-self-center me-3">
                                                         @if($data_4->binary_status == 1)
                                                         <i class="mdi mdi-circle text-success font-size-10"></i>
                                                         @else
                                                         <i class="mdi mdi-circle text-danger font-size-10"></i>
                                                         @endif
                                                      </div>
                                                      <div class="align-self-center me-3">
                                                          <img src="{{ static_asset('back-end/images/users/avatar-1.jpg')}}" class="rounded-circle avatar-xs" alt="">
                                                      </div>
                                                      <div class="flex-grow-1 overflow-hidden">
                                                          <h5 class="text-truncate font-size-14 mb-1">{{ $data_4->user->name }}</h5>
                                                          <p class="text-truncate mb-0">{{$data_4->user->user_referral}}</p>
                                                      </div>
                                                  </div>
                                                </a>
                                             </li>
                                             @endforeach
                                          </ul>
                                          @endif
                                       </li>
                                       @endforeach
                                    </ul>
                                     @endif
                                 </li>
                                 @endforeach
                              </ul>
                               @endif
                           </li>
                           @endforeach
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection