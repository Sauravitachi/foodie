@extends('home.base')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <h2>My Cart({{$count = count($order->orderItem) }})</h2>
                
            </div>
            @if ($count)
                
            
            <div class="col-8">
                @php
                    $total_price = 0;
                 $total_discount_price = 0;
                    $delivery_charge = 50;
                @endphp
                @foreach ($order->orderItem as $item)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('storage/' . $item->product->image) }}" class="w-100" alt="">
                            </div>
                            <div class="col-10">
                                <h2 class="text-capitalize">{{ $item->product->title }}</h2>
                                <div class="container">
                                    <h6> price: ₹{{ $item->product->discount_price * $item->qty }}/-
                                        <del>{{ $item->product->price * $item->qty }}</del>/- </h6>
                                </div>
                                <div class="col-3">
                                    <a href="{{ route('removeFromCart', $item->product->id) }}" class="btn btn-danger">-</a>
                                    <span>{{ $item->qty }}</span>
                                    <a href="{{ route('addToCart', $item->product->id) }}" class="btn btn-success">+</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $total_price += $item->product->price * $item->qty;
                    $total_discount_price += $item->product->discount_price * $item->qty;
                @endphp
                @endforeach
            </div>
            <div class="col-4">
                <div class="list-group">
                    <span class="list-group-item list-group-item-action">Total Price
                        <span class="float-end">₹{{ $total_price }}</span>
                    </span>
                    <span class="list-group-item list-group-item-action bg-success text-white">Discount
                        <span class="float-end">₹{{ $total_price - $total_discount_price }}</span>
                    </span>
                    <span class="list-group-item list-group-item-action">Tax (GST)
                        <span class="float-end">₹{{ $gst = $total_discount_price * 0.18 }}</span>
                    </span>
                    @php
                        $net_payable = $total_discount_price + $gst;
                         $delivery_charge = ($net_payable <= 500) ? 50 : 0;
                    @endphp
                    <span class="list-group-item list-group-item-action">Delivary Charge
                        <span class="float-end">
                            @if ($delivery_charge)
                            {{ $delivery_charge }}
                        @else
                            FREE
                        @endif
                        </span>
                    </span>
                    <span class="list-group-item list-group-item-action text-success fw-bold h3">Net Payable
                        <span class="float-end">₹{{$net_payable}}</span>
                    </span>
                </div>

                <div class="d-flex mt-5 gap-1">
                    <div class="col">
                        <a href="" class="btn btn-dark w-100 btn-lg">Add More</a>                        
                    </div>
                    <div class="col">
                        <a href="{{route('checkout')}}" class="btn btn-success w-100 btn-lg">Proceed</a>
                    </div>
                </div>
            </div>
            @else
                <h1 class="display-3 fw-bold text-secondary">
                    Cart is Empty
                </h1>
                <a href="{{route('home.index')}}" class="btn btn-dark w-25 mt-4">Continue Shoping</a>
            @endif
        </div>
    </div>
@endsection
