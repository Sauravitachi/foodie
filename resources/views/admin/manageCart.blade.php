@extends('admin.adminBase')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <h2 class="display-6">Manage Carts ({{ count($carts) }})</h2>
            </div>
            <div class="container">
                <div class="row ">
                    <div class="col-12 p-0 ">
                        @foreach ($carts as $item)
                            <div class="card mt-0">
                                <div class="card-header">
                                  <table class="table">
                                    <tr>
                                        <th>Order Id</th>
                                        <td>{{$item->id}}</td>
                                        <th>Order By</th>
                                        <td>{{$item->users->name}}</td>
                                        <th>Contact</th>
                                        <td>{{$item->users->email}}</td>
                                    </tr>                                
                                  </table>
                                </div>
                                <div class="card-body mt-0 p-1">
                                    <table class="table mt-0">
                                        <tr>
                                            <th class="h5">Id</th>
                                            <th class="h5" >Name</th>
                                            <th class="h5">Qty</th>
                                            <th class="h5">Product Image</th>
                                        </tr>
                                        @foreach ($item->orderItem as $i)
                                            <tr>
                                                <td>{{$i->id}}</td>
                                                <td>{{$i->product->title}}</td>
                                                <td>{{$i->qty}}</td>
                                                <td>
                                                    <img src="{{asset('storage/'. $i->product->image)}}" width="40px" alt="">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@endsection
