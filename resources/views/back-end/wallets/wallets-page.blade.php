@extends('back-end.layouts.app')

@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0 font-size-18">Wallets</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                     <li class="breadcrumb-item active">Wallets</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xl-4">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex">
                     <div class="me-2">
                        <img class="rounded-circle header-profile-user avatar-md" src="{{ static_asset('back-end/images/users/avatar-1.jpg')}}" alt="Header Avatar">
                     </div>
                     <div class="flex-grow-1">
                        <div class="text-muted">
                           <h5>{{$customer->name}}</h5>
                           <p class="mb-1">{{$customer->email}}</p>
                           <p class="mb-0">Id: #{{$customer->user_referral}}</p>
                        </div>
                     </div>
                     <div class="dropdown ms-2">
                        <a class="text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal font-size-18"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                           <a class="dropdown-item" href="#">Refresh</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body border-top">
                  <div class="row">
                     <div class="col-sm-6">
                        <div>
                           <p class="text-muted mb-2">Available Balance</p>
                           <h5>{{number_formats($balance)}}</h5>
                        </div>
                     </div>
                     @if(Auth()->user()->user_id_status == '0')
                     <div class="col-sm-6">
                        <div class="text-sm-end mt-4 mt-sm-0">
                           <p class="text-muted mb-2">Inactive Balance</p>
                           <h5>{{number_formats()}}<span class="badge bg-danger ms-1 align-bottom">+ 1.3 %</span></h5>
                        </div>
                     </div>
                     @endif
                  </div>
               </div>
               <div class="card-body border-top">
                  <p class="text-muted mb-4">Total</p>
                  <div class="text-center">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="mt-4 mt-sm-0">
                              <div class="font-size-24 text-primary mb-2">
                                 <i class="bx bx-import"></i>
                              </div>
                              <p class="text-muted mb-2">receive</p>
                              <h5>{{number_formats($overall)}}</h5>
                              <div class="mt-3">
                                 <a href="#" class="btn btn-primary btn-sm w-sm">Receive</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="mt-4 mt-sm-0">
                              <div class="font-size-24 text-primary mb-2">
                                 <i class="bx bx-wallet"></i>
                              </div>
                              <p class="text-muted mb-2">Withdraw</p>
                              <h5>{{number_formats($withdraw)}}</h5>
                              <div class="mt-3">
                                 <a href="#" class="btn btn-primary btn-sm w-sm">Withdraw</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-8">
            <div class="row">
               <div class="col-md-4">
                  <div class="card mini-stats-wid">
                     <div class="card-body">
                        <div class="d-flex">
                           <div class="flex-grow-1">
                              <p class="text-muted fw-medium">Wallets</p>
                              <h4 class="mb-0">{{number_formats($balance)}}</h4>
                           </div>
                           <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                              <span class="avatar-title rounded-circle bg-primary">
                              <i class="bx bx-wallet font-size-24"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card mini-stats-wid">
                     <div class="card-body">
                        <div class="d-flex">
                           <div class="flex-grow-1">
                              <p class="text-muted fw-medium">Coins</p>
                              <h4 class="mb-0">{{$coins}}</h4>
                           </div>
                           <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                              <span class="avatar-title rounded-circle bg-primary">
                              <i class="bx bx-purchase-tag-alt font-size-24"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card mini-stats-wid">
                     <div class="card-body">
                        <div class="d-flex">
                           <div class="flex-grow-1">
                              <p class="text-muted fw-medium">Withdraw</p>
                              <h4 class="mb-0">{{number_formats($withdraw)}}</h4>
                           </div>
                           <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                              <span class="avatar-title rounded-circle bg-primary">
                              <i class="bx bx-purchase-tag-alt font-size-24"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#wallet" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Wallet history</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="wallet" role="tabpanel">
                            <div class="row">
                                <div class="col-12" style="overflow-x:auto;">  
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                          <thead>
                                              <tr>
                                                  <th>Sr</th>
                                                  <th>ID</th>
                                                  <th>Amount</th>
                                                  <th>TDS(Charge)</th>
                                                  <th>Sedrvice(Charge)</th>
                                                  <th>Date</th>
                                                  <th>Remark</th>
                                                  <th>Status</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          @foreach($wallets as $key => $data)
                                             <tr>
                                               <td>{{ $key + $wallets->firstItem() }}</td>
                                               <td>{{
                                                $data->wallet_transaction_id}}</td>
                                               <td>{{number_formats($data->wallet_amount)}}</td>
                                               <td>{{number_formats($data->wallet_tds_charge)}}</td>
                                               <td>{{number_formats($data->wallet_service_charge)}}</td>
                                               <td>{{canvert_date($data->created_at)}}</td>
                                               <td>{{ $data->wallet_description }}</td>
                                               <td>
                                                  @if($data->wallet_type == '1')
                                                  <span class="badge badge-pill badge-soft-success font-size-11">CR</span>
                                                  @else
                                                  <span class="badge badge-pill badge-soft-danger font-size-11">DR</span>
                                                  @endif
                                               </td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                    </table>
                                     {{ $wallets->links('pagination::bootstrap-5') }}
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
@section('script')
<script src="{{ static_asset('back-end/libs/node-waves/waves.min.js')}}"></script>
<script type="text/javascript">
   $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
       localStorage.setItem('activeTab', $(e.target).attr('href'));
   });

   var activeTab = localStorage.getItem('activeTab');
   if(activeTab){
      $('.nav-link').removeClass('active');
      $('.nav-tabs a[href="' + activeTab + '"]').attr('class','nav-link active');
   }
</script>
@endsection