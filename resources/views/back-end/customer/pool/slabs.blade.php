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
                <h4 class="mb-sm-0 font-size-18">Auto Pool</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Auto Pool</li>
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
                            <h4 class="card-title">Auto Pool</h4>
                        </div>
                    </div>
                    <div class="col-12" style="overflow-x:auto;">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Teams</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($poolstab as $key => $data)
                            <tr>
                                <td>{{ $key + $poolstab->firstItem() }}</td>
                                <td>{{ $data->slab_name}}</td>
                                <td>{{ $data->slab_amount }}</td>
                                <td>{{ $data->slab_user_target }}</td>
                                <td>
                                    @if($data->slab_completed == '1')
                                    <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                    @else
                                    <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $poolstab->links('pagination::bootstrap-5') }}    
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection