@extends('master')
@section('title', 'card product')
@section('name', 'Card Product')
@section('content')

    @if(Session::has('success'))
        <p class="alert-danger">{{Session::get('success')}}</p>
        @endif
{{--    @if(Session::has('cart'))--}}
{{--        totalQty = {{$carts->totalQty}}<br>--}}
{{--        totalPrice = {{$carts->totalPrice}}<br>--}}
    @if(!Session::has('cart'))
        <div class="alert-danger">No product in your cart</div>
        @else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            @foreach($carts->items as $key=>$item)
                <form method="post" action="{{route('cart.update', ['id'=>$item['product']->id])}}">
                    @csrf
                    <tr>
                        <th scope="row">
                            <div style="text-align: center">
                                <h3>{{$item['product']->name}}</h3>
                            </div>
                        </th>
                        <th scope="col">
                            {{$item['product']->price}}
                        </th>
                        <th scope="col">
                            <input type="number" name="quantity" min="1" value="{{$item['qty']}}">
                        </th>
                        <th scope="col">
                            {{$item['price']}}
                        </th>
                        <th>
                            <button type="submit" class="btn btn-outline-danger">Update</button>
                            <a href="{{route('cart.destroy', ['id'=>$item['product']->id])}}">
                                <button type="button"
                                        onclick="return confirm('Do you want delete {{$item['product']->name}}?')"
                                        class="btn btn-danger">Delete
                                </button>
                            </a>
                        </th>
                    </tr>
                </form>
            @endforeach
            <tr>
                <th>Total Quantity: {{$carts->totalQty}}</th>
                <th>Total Price: {{$carts->totalPrice}}</th>
            </tr>
        </table>
    @endif
@endsection
