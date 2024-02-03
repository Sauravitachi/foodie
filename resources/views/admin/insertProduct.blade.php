@extends('admin.adminBase')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Insert Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                @error('title')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">IsVeg</label>
                                <div class="d-flex gap-2 mt-2">
                                    <input type="radio" name="isVeg"value="1" checked>Veg
                                    <input type="radio" name="isVeg"value="0">Non-Veg
                                </div>
                                @error('isVeg')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Price</label>
                                <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                                @error('price')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Discount price</label>
                                <input type="number" name="discount_price" class="form-control"
                                    value="{{ old('discount_price') }}">
                                @error('discount_price')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                                @error('image')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <input type="text" name="description" class="form-control"
                                    value="{{ old('description') }}">
                                @error('description')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category Here</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->cat_title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="small btn btn-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-dark w-100" value="Insert Product">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

 
