@extends('master')
@section('title', 'list product')
@section('name', 'All Product')
@section('content')
{{--    @if(Session::has('success'))--}}
{{--        <div class="alert-success">--}}
{{--            {{Session::get('success')}}--}}
{{--        </div>--}}
{{--    @endif--}}
    <a href="{{route('products.create')}}">
        <button type="button" class="btn btn-outline-primary">ADD PRODUCT</button>
    </a>
    <table style="text-align: center" class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Old_Price</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        @foreach($products as $key => $product)
            <div>
                <tr>
                    <th scope="row">{{++$key}}</th>
                    <th>{{$product->name}}</th>
                    <th>{{$product->price}}</th>
                    <th>{{$product->old_price}}</th>
                    <th>
                        <img src="{{asset('storage/'.$product->image)}}" style="width: 200px">
                    </th>
                    <th>
                        <a href="{{route('products.delete', ['id'=>$product->id])}}">
                            <button type="button" class="btn btn-outline-danger"
                                    onclick="return confirm('Do you want delete {{$product->name}}?')">Delete
                            </button>
                        </a>
                        <a href="">
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                        </a>
                        <a href="{{route('cart.add', ['id'=>$product->id])}}">
                            <button type="button" class="btn btn-outline-info">Add Cart</button>
                        </a>
                    </th>
                </tr>
            </div>

        @endforeach
    </table>
@endsection