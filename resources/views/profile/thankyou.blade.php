@extends('master')

@section('content')

<h1 align="center">Thank You <span style="color:#009900">{{Auth::user()->name}}!</span></h1>

<p class="panel-body" style="text-align:center; font-size:24px; line-height: 10px;">
    Your order has been placed!</p>

@endsection
