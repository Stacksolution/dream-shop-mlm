@extends('back-end.layouts.app')

@section('content')
<div class="page-content"> 
    <div class="container-fluid">
       <div class="row">
          <div class="col-12">
             <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                <div class="page-title-right">
                   <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                      <li class="breadcrumb-item active">Dashboard</li>
                   </ol>
                </div>
             </div>
          </div>
       </div>
       <div class="row">
         @php $status = App\Models\Document::document_status(Auth()->user()->id); 
         @endphp
         @if($status != "approved")
         <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <i class="mdi mdi-block-helper me-2"></i>
               Your KYC Verification Still pending after upload your documents and wait some time for KYC update Process !
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         </div>
         @endif
          <div class="col-xl-12">
             <div class="row">
                <div class="col-md-4">
                   <div class="card mini-stats-wid">
                      <div class="card-body">
                         <div class="d-flex">
                            <div class="flex-grow-1">
                               <p class="text-muted fw-medium">Team</p>
                               <h4 class="mb-0">{{ $countmember }}</h4>
                            </div>
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                               <span class="avatar-title">
                               <i class="bx bx-user font-size-24"></i>
                               </span>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                @if(Auth()->user()->user_id_status == '1')
                <div class="col-md-4">
                   <div class="card mini-stats-wid">
                      <div class="card-body">
                         <div class="d-flex">
                            <div class="flex-grow-1">
                               <p class="text-muted fw-medium">Wallets</p>
                               <h5 class="mb-0">{{number_formats($wallets)}}</h5>
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
                @endif
                
                @if(Auth()->user()->user_id_status == '0')
                <div class="col-md-4">
                   <div class="card mini-stats-wid">
                      <div class="card-body">
                         <div class="d-flex">
                            <div class="flex-grow-1">
                               <p class="text-muted fw-medium">Inactive Wallet</p>
                               <h5 class="mb-0">{{number_formats($wallets)}}</h5>
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
                @endif
             </div>
          </div>
          <div class="col-xl-12">
            <div class="wizard clearfix">
               <div class="steps clearfix">
                  <ul role="tablist">
                     @if($activation['level_1'] == 1)
                     <li class="current">
                        <a id="basic-example-t-0" href="javascript:;">
                           <span class="number">1.</span> Auto Pool
                        </a>
                     </li>
                     @else
                     <li class="disabled">
                        <a id="basic-example-t-0" href="{{route('subscriprion.index')}}">
                           <span class="number">1.</span> Auto Pool
                        </a>
                     </li>
                     @endif
                     @if($activation['level_2'] == 1)
                     <li class="current">
                        <a id="basic-example-t-1" href="javascript:;">
                           <span class="number">2.</span> Level
                        </a>
                     </li>
                     @else
                     <li class="disabled">
                        @if($activation['level_1'] == 1)
                        <a id="basic-example-t-1" href="{{route('level.checkout',[Auth()->user()->id])}}">
                           <span class="number">2.</span> Level
                        </a>
                        @else
                        <a id="basic-example-t-1" href="javascript:;">
                           <span class="number">2.</span> Level
                        </a>
                        @endif
                     </li>
                     @endif
                     @if($activation['level_3'] == 1)
                     <li class="current">
                        <a id="basic-example-t-3" href="javascript:;">
                           <span class="number">3.</span> Binary
                        </a>
                     </li>
                     @else
                     <li class="disabled">
                        @if($activation['level_2'] == 1)
                        <a id="basic-example-t-3" href="">
                           <span class="number">3.</span> Binary
                        </a>
                        @else
                        <a id="basic-example-t-3" href="javascript:;">
                           <span class="number">3.</span> Binary
                        </a>
                        @endif
                     </li>
                     @endif
                     @if($activation['level_4'] == 1)
                     <li class="current">
                        <a id="basic-example-t-4" href="javascript:;">
                           <span class="number">4.</span> Daily
                        </a>
                     </li>
                     @else
                     <li class="disabled">
                        @if($activation['level_3'] == 1)
                        <a id="basic-example-t-4" href="">
                           <span class="number">4.</span> Daily
                        </a>
                        @else
                        <a id="basic-example-t-4" href="javascript:;">
                           <span class="number">4.</span> Daily
                        </a>
                        @endif
                     </li>
                     @endif
                     @if($activation['level_5'] == 1)
                     <li class="current">
                        <a id="basic-example-t-5" href="javascript:;">
                           <span class="number">5.</span> Rewards
                        </a>
                     </li>
                     @else
                     <li class="disabled">
                        @if($activation['level_4'] == 1)
                        <a id="basic-example-t-5" href="">
                           <span class="number">5.</span> Rewards
                        </a>
                        @else
                        <a id="basic-example-t-5" href="javascript:;">
                           <span class="number">5.</span> Rewards
                        </a>
                        @endif
                     </li>
                     @endif
                  </ul>
               </div>
            </div>
          </div>
       </div>
       <div class="mt-4"></div>
       <div class="row">
           <div class="col-xl-6">
               <div class="card">
                   <div class="card-body">
                       <h4 class="card-title mb-4">Income Reports</h4>
                       <div id="pie-chart" class="e-charts"></div>
                   </div>
               </div>
           </div>
           <div class="col-xl-6">
               <div class="card">
                   <div class="card-body">
                       <h4 class="card-title mb-4">Withdrawa & Deduction</h4>
                       <div id="pie-chart-withdrow" class="e-charts"></div>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-12">
             <div class="card border border-info">
                 <div class="card-header bg-transparent border-danger">
                     <h5 class="my-0 text-info"><i class="bx bx-info-circle me-3"></i>Refer and Earn ! </h5>
                 </div>
                 <div class="card-body">
                     <p class="card-text">Earn upto Rs 10,000 by referring your friends to join {{env('APP_NAME')}}. You will receive Rs 100 for every successful referral. Your friend will also receive a surprise but guaranteed cashback reward on making his/her activet your profile on {{env('APP_NAME')}}</p>
                 </div>
             </div>
          </div>
    </div>
 </div>
@endsection
@php
   $user_id = Auth()->user()->id;
   //direct
   $direct = App\Models\Wallets::where('wallet_user_id',$user_id)->where('wallet_uses','login_commission')->sum('wallet_amount');
   //pool
   $pool = App\Models\Wallets::where('wallet_user_id',$user_id)->where('wallet_uses','level_income')->sum('wallet_amount');
   //level
   $level = App\Models\Wallets::where('wallet_user_id',$user_id)->where('wallet_uses','level_income_plan')->sum('wallet_amount');

   //Login
   $login = App\Models\Wallets::where('wallet_user_id',$user_id)->where('wallet_uses','login_commission')->sum('wallet_amount');


   //service
   $service = App\Models\Wallets::where('wallet_user_id',$user_id)->sum('wallet_service_charge');

   //tds
   $tds = App\Models\Wallets::where('wallet_user_id',$user_id)->sum('wallet_tds_charge');

   //tds
   $payout = App\Models\Wallets::where('wallet_user_id',$user_id)->where('wallet_uses','cash_withdraw')->sum('wallet_amount');
@endphp
@section('script')
<script src="{{ static_asset('back-end/libs/echarts/echarts.min.js')}}"></script>
<script type="text/javascript">
// pie chart for income reports
var dom = document.getElementById("pie-chart");
var myChart = echarts.init(dom);
var app = {};
option = null;
option = {
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    color: ['#556ee6', '#f1b44c', '#f46a6a', '#50a5f1', '#34c38f'],
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['Direct','Pool'],
    },
    
    series : [
        {
            name: 'Total Income',
            type: 'pie',
            radius : '70%',
            center: ['50%', '50%'],
            data:[
                {value:'{{$direct}}', name:'Direct'},
                {value:'{{$pool}}', name:'Pool'},
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}

// pie chart for income reports
var dom = document.getElementById("pie-chart-withdrow");
var myChart = echarts.init(dom);
var app = {};
option = null;
option = {
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    color: ['#50a5f1', '#34c38f','#556ee6', '#f1b44c', '#f46a6a'],
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['Service','TDS','Bank Transfer'],
    },
    
    series : [
        {
            name: 'Total Income',
            type: 'pie',
            radius : '70%',
            center: ['50%', '50%'],
            data:[
                {value:'{{$service}}', name:'Service'},
                {value:'{{$tds}}', name:'TDS'},
                {value:'{{$payout}}', name:'Bank Transfer'},
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
</script>
@endsection
