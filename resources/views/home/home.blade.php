@extends('home.base')

@section('content')
    <div class="text-white" style="height:400px; object-fit:cover; background-position: center;   background-attachment: fixed;
    background-image:url('https://wallpapercave.com/wp/wp10322952.jpg')" >
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <h1 class="mt-5 bg-danger px-2 py-1 rounded-2"> 
                Explore Foods&Snacks
            </h1>
            <form class="d-flex justify-content-center flex-column gap-3" action="" method="get">
                <input type="search" class="form-control-lg border-0" placeholder="Search Your Appetite" size="70">
                <input type="submit" class="btn btn-dark btn-lg" value="Explore">
            </form>
        </div>
    </div>

    <div class="container"> 
        @foreach ($categories as $cat)
            <div class="container my-5">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-capitalize h4 text-secondary">{{ $cat->cat_title }}</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach ($cat->products as $item)
                        <div class="col-3">
                            <div class="card rounded-0">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card border-0 rounded-0">
                                            <img class="img-fulid" src="{{ asset('storage/' . $item->image) }}"
                                                style="object-fit:cover; height;15 0px;" alt="">

                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body p-1">
                                            <span class="float-end mb-0">
                                                @if ($item->isVeg)
                                                    <img src="{{ asset('icons/veg.png') }}" width="20px" alt="">
                                                @else
                                                    <img src="{{ asset('icons/n-veg.png') }}" width="20px" alt="">
                                                @endif
                                            </span>
                                            <h6 class="small mb-0">{{ $item->title }}</h6>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col me-auto" style="margin-left:-10px;">
                                                <span class="text-success small fw-bold">
                                                    Rs.{{ $item->discount_price }}/-
                                                    <del class="small text-muted ">Rs.{{ $item->price }}/-</del>
                                                </span>
                                                
                                            </div>
                                        </div>
                                        <span class="float-end mb-2 mt-3">
                                            <a href="{{route('addToCart',$item->id)}}" class="btn btn-success btn-sm small rounded-0">Add
                                                to Cart</a>
                                            
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
        @endforeach
    </div>
@endsection
