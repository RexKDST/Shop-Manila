@extends('master')

@section('content')
<style>
    table td { padding:10px
    }</style>



<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/profile')}}">Profile</a></li>
                <li class="active">My Order</li>
            </ol>
        </div><!--/breadcrums-->



        <div class="row">
            @include('profile.menu')
            <div class="col-md-8">
               <h2 ><span style='color:green'>{{ucwords(Auth::user()->name)}}</span>,Your Current Orders:</h2>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Orders ID </th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Quantity</th>
                            <th>Product Price</th>
                            <th>Order Total</th>
                            <th>Order Status</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{date('F j, Y', strtotime($order->created_at))}}</td>
                            <td>&nbsp;<strong>{{$order->id}}</strong></td>
                            <td>{{ucwords($order->pro_name)}}</td>
                            <td>{{$order->pro_code}}</td>
                            <td>&nbsp;&nbsp;&nbsp;{{$order->qty}}</td>
                            <td>₱{{$order->pro_price}}</td>
                            <td>₱{{$order->total}}</td>
                            <td>{{$order->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>
@endsection
