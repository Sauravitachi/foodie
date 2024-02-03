@extends('admin.adminBase')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
                <div class="row g-2">
                    <div class="col-6">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h3 class="display-3">{{$categories}}</h3>
                                <h6>Total categories</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h3 class="display-3">{{$products}}</h3>
                                <h6>Total Dishes</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h3 class="display-3">100+</h3>
                                <h6>Happy Customer</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h3 class="display-3">80+</h3>
                                <h6>Total Orders</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
