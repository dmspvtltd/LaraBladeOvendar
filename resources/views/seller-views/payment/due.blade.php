@extends('layouts.back-end.app-seller')
@section('Payments Dus')

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="content container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-sm">
                <h1 class="page-header-title">Payments Due <span
                        class="badge badge-soft-dark ml-2">2</span>
                </h1>
            </div>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Payment Due Table </h5>
                        {{-- <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6 mb-3 mb-lg-0">
                                <form action="{{ url()->current() }}" method="GET">
                                    
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{\App\CPU\translate('search')}}" aria-label="Search orders" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn-primary">{{\App\CPU\translate('search')}}</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{\App\CPU\translate('SL#')}}</th>
                                    <th>Order ID</th>
                                    <th>Product ID</th>
                                    <th>Price</th>
                                    <th>Quentity</th>
                                    <th>Commesion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payment_dues as $k=>$item)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            {{$item->order_id}}
                                        </td>
                                        <td>
                                            {{$item->product_id}}
                                        </td>
                                        <td>
                                            @if ($item->product ? $item->product->variation : '' != null)
                                                @foreach (json_decode($item->product ? $item->product->variation : '') as $variation)
                                                    {{$variation->price}}
                                                @endforeach
                                            @endif
                                            
                                        </td>
                                        <td>
                                            asf
                                        </td>
                                        <td>
                                            asdf
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Footer -->
                     <div class="card-footer">
                        {{$payment_dues->links()}}
                    </div>
                    @if(count($payment_dues)==0)
                        <div class="text-center p-4">
                            <img class="mb-3" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                            <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                        </div>
                    @endif
                    <!-- End Footer -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
