@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Pool Community Network</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Pool Community Network</li>
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
                  <h4 class="card-title">Pool Community Network</h4>
                  <div class="body genealogy-body genealogy-scroll">
                     <div class="genealogy-tree">
                        <ul>
                           @foreach($customer as $key => $data_1)
                           <li>
                              <a href="">
                                 <div class="d-flex" style="box-shadow: 5px 5px 10px #888888;border-radius: 5px; padding: 10px;">
                                    <div class="align-self-center me-3">
                                       <i class="mdi mdi-circle text-success font-size-10"></i>
                                    </div>
                                    <div class="align-self-center me-3">
                                        <img src="{{ image_path() }}" class="rounded-circle avatar-xs" alt="">
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate font-size-14 mb-1">{{$data_1->user->name}}</h5>
                                        <p class="text-truncate mb-0">{{$data_1->user->user_referral}}</p>
                                    </div>
                                </div>
                              </a>
                              @if(count($data_1->children) > 0)
                              <ul class="active">
                                 @foreach($data_1->children as $key => $data_2)
                                 <li>
                                    <a href="">
                                       <div class="d-flex" style="box-shadow: 5px 5px 10px #888888;border-radius: 5px; padding: 10px;">
                                          <div class="align-self-center me-3">
                                             <i class="mdi mdi-circle text-success font-size-10"></i>
                                          </div>
                                          <div class="align-self-center me-3">
                                              <img src="{{ image_path() }}" class="rounded-circle avatar-xs" alt="">
                                          </div>
                                          <div class="flex-grow-1 overflow-hidden">
                                              <h5 class="text-truncate font-size-14 mb-1">{{@$data_2->user->name}}</h5>
                                              <p class="text-truncate mb-0">{{@$data_2->user->user_referral}}</p>
                                          </div>
                                      </div>
                                    </a>
                                    @if(count($data_2->children) > 0)
                                    <ul>
                                       @foreach($data_2->children as $key => $data_3)
                                       <li>
                                          <a href="">
                                             <div class="d-flex" style="box-shadow: 5px 5px 10px #888888;border-radius: 5px; padding: 10px;">
                                                <div class="align-self-center me-3">
                                                   <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="align-self-center me-3">
                                                    <img src="{{ image_path() }}" class="rounded-circle avatar-xs" alt="">
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">{{@$data_3->user->name}}</h5>
                                                    <p class="text-truncate mb-0">{{@$data_3->user->user_referral}}</p>
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
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection