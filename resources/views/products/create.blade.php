@extends('master')
@section('title', 'Add Product')
@section('name', 'New Product')
@section('content')
    <div class="form-group">
        <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
            @csrf
            <div>
                <label>Product</label>
                <input class="form-control" type="text" name="name" placeholder="Enter your name product" required>
            </div>
            <div>
                <label>Price</label>
                <input class="form-control" type="number" name="price" placeholder="Enter your price" required>
            </div>
            <div>
                <label>Old Price</label>
                <input class="form-control" type="number" name="old_price" placeholder="Enter your price" required>
            </div>
            <div>
                <label>Image</label>
                <input class="form-control-file" type="file" name="image" required>
            </div>
            <div>
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
        </form>
    </div>
    @endsection