@extends('back-end.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-12">
             <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Withdraw</h4>
                <div class="page-title-right">
                   <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                      <li class="breadcrumb-item active">Withdraw Records</li>
                   </ol>
                </div>
             </div>
          </div>
       </div>
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-body">
                       <div class="row mb-4">
                          <div class="col-md-8">
                              <h4 class="card-title">Withdraw Records</h4>
                          </div>
                           <div class="col-md-4 text-right">
                              <div class="card-footer bg-transparent" style="margin-top: -17px;">
                                  <div class="text-center">
                                      <a href="{{route('payout.create')}}" class="btn btn-outline-primary btn-sm align-middle me-2" title="New Team" style="float: right;"> 
                                        <i class="fas fa-plus"></i> Withdraw
                                      </a>
                                  </div>
                              </div>
                          </div>
                       </div>
                       <div class="row mb-4">
                         <div class="col-lg-12">
                            <form class="row gy-2 gx-3 align-items-center" action="{{route('payout.index')}}" method="get">
                               @csrf
                               <div class="col-sm-auto">
                                  <label class="visually-hidden" for="autoSizingInput">From</label>
                                  <input type="date" class="form-control form-control-md"  name="from_date" value="{{$from}}" required>
                               </div>
                               <div class="col-sm-auto">
                                  <label class="visually-hidden" for="autoSizingInput">To</label>
                                  <input type="date" class="form-control form-control-md"  name="to_date" value="{{$to}}" required>
                               </div>
                               <div class="col-sm-auto">
                                  <button type="submit" class="btn btn-md btn-primary"><i class="bx bx-search font-size-16 align-middle me-2"></i>Search</button>
                               </div>
                               <div class="col-sm-auto">
                                  <a href="{{route('payout.index')}}" class="btn btn-md btn-danger"><i class="bx bx-rotate-left font-size-16 align-middle me-2"></i>Reset</a>
                               </div>
                            </form>
                         </div>
                      </div>
                       <div class="col-12" style="overflow-x:auto;">
                           <table class="table table-bordered dt-responsive w-100">
                               <thead>
                                   <tr>
                                       <th>Sr</th>
                                       <th>Transaction ID</th>
                                       <th>Amount</th>
                                       <th>Transfer Amount</th>
                                       <th>TDS(Charge)</th>
                                       <th>Service(Charge)</th>
                                       <th>Account</th>
                                       <th>Date</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                @foreach($withdraw as $key => $data)
                                   <tr>
                                       <td>{{ $key + $withdraw->firstItem() }}</td>
                                       <td>{{ $data->withdraw_transaction_id }}</td>
                                       <td>{{ $data->withdraw_amount }}</td>
                                       <td>{{ ($data->withdraw_amount-$data->withdraw_tds_charge-$data->withdraw_service_charge) }}</td>
                                       <td>{{ $data->withdraw_tds_charge }} ({{ $data->withdraw_tds_rate }}%)</td>
                                       <td>{{ $data->withdraw_service_charge }} ({{ $data->withdraw_service_rate }}%)</td>
                                       @php  $bank = App\Models\BankAccount::where('id',$data->withdraw_bank_id)->first(); @endphp
                                       <td>{{ @$bank->bank_account_holder }}-{{ @$bank->bank_account_number }}</td>
                                       <td>{{ canvert_date($data->created_at) }}</td>
                                       <td>
                                        @if($data->withdraw_status == '1')
                                        <span class="badge badge-pill badge-soft-success">Approved</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-danger">Pending</span>
                                        @endif
                                       </td>
                                        <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle btn btn-outline-dark btn-sm" role="button" data-bs-toggle="dropdown" aria-haspopup="true"><i class="bx bx-menu font-size-14"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">   
                                                @if(Auth()->user()->user_type =="admin")
                                                <a class="dropdown-item" title="Status" href="{{route('payout.status.update',[$data->id,'1'])}}">Approved
                                                </a>
                                                @endif
                                                @if($data->withdraw_status != "1" && Auth()->user()->user_type !="admin")
                                                <a class="dropdown-item" title="Edit" href="{{route('payout.remove',[$data->id])}}">Delete
                                                </a>
                                                @endif
                                                @if(Auth()->user()->user_type =="admin")
                                                <a class="dropdown-item" title="Edit" href="{{route('payout.remove',[$data->id])}}">Delete
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        </td>
                                   </tr>
                                @endforeach
                               </tbody>
                           </table>
                           {{ $withdraw->links('pagination::bootstrap-5') }}
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
 </div>
@endsection
