@extends('admin.adminBase')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <h2 class="display-6">Manage Product ({{ count($products) }})</h2>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Title</th>
                            <th>IaVeg</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @if ($item->isVeg)
                                        <img src="{{ asset('icons/veg.png') }}" alt="">
                                    @else
                                        <img src="{{ asset('icons/n-veg.png') }}" alt="">
                                        
                                    @endif
                                </td>
                                <td>{{ $item->discount_price }}₹ <del>{{ $item->price }}</del></td>
                                <td><img src="{{ asset('storage/' . $item->image) }}" width="100px" alt=""></td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->category->cat_title }}</td>
                                <td>
                                    <form action="">                                        
                                        <input type="submit" class="btn btn-danger" value="delete">
                                    </form>
                                </td>   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@endsection
