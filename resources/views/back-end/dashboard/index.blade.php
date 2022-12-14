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
          <div class="col-xl-12">
             <div class="row">
               <div class="col-md-3">
                   <div class="card mini-stats-wid">
                      <div class="card-body">
                         <div class="d-flex">
                            <div class="flex-grow-1">
                               <p class="text-muted fw-medium">Team</p>
                               <h5 class="mb-0">{{ $countmember }}</h5>
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
               @if(Auth()->user()->user_type =='admin')
                <div class="col-md-3">
                   <div class="card mini-stats-wid">
                      <div class="card-body">
                         <div class="d-flex">
                            <div class="flex-grow-1">
                               <p class="text-muted fw-medium">Payment</p>
                               <h5 class="mb-0">{{ number_formats($payment) }}</h5>
                            </div>
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                               <span class="avatar-title">
                               <i class="bx bx-wallet font-size-24"></i>
                               </span>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                @endif
                @if(Auth()->user()->user_id_status == '1')
                <div class="col-md-3">
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
                <div class="col-md-3">
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
                <div class="col-md-3">
                   <div class="card mini-stats-wid">
                      <div class="card-body">
                         <div class="d-flex">
                            <div class="flex-grow-1">
                               <p class="text-muted fw-medium">Withdraw</p>
                               <h5 class="mb-0">{{number_formats($withdraw)}}</h5>
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
                <div class="col-md-3">
                   <div class="card mini-stats-wid">
                      <div class="card-body">
                         <div class="d-flex">
                            <div class="flex-grow-1">
                               <p class="text-muted fw-medium">Service(Charge)</p>
                               <h5 class="mb-0">{{number_formats($service)}}</h5>
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
                <div class="col-md-3">
                   <div class="card mini-stats-wid">
                      <div class="card-body">
                         <div class="d-flex">
                            <div class="flex-grow-1">
                               <p class="text-muted fw-medium">TDS</p>
                               <h5 class="mb-0">{{number_formats($tds)}}</h5>
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
    </div>
 </div>
@endsection
@php
   //direct
   $direct = App\Models\Wallets::where('wallet_uses','login_commission')->sum('wallet_amount');
   //pool
   $pool = App\Models\Wallets::whereIn('wallet_uses',['level_income','level_income_over'])->sum('wallet_amount');
   //level
   $level = App\Models\Wallets::whereIn('wallet_uses',['level_income_plan','level_income_plan_over','level_active','level_direct_commission'])->sum('wallet_amount');
   //Login
   $login = App\Models\Wallets::where('wallet_uses','login_commission')->sum('wallet_amount');
   //service
   $service = App\Models\Wallets::sum('wallet_service_charge');
   //tds
   $tds = App\Models\Wallets::sum('wallet_tds_charge');
   //payout
   $payout = App\Models\Wallets::where('wallet_type','0')->sum('wallet_amount');
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