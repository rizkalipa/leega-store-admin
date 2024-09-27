@extends('layouts.template')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Manage Order</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Manage Order</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @foreach($orders as $order)
                        <div class="card {{ trim($order->status) == 'N' ? 'card-primary' : 'card-success' }} mb-5">
                            <div class="card-header">
                                <h3 class="card-title me-5">ORDER ID #0{{ $order->id }}</h3>
                                <h3 class="card-title me-5">STATUS : {{ trim($order->status) == 'N' ? 'WAITING' : (trim($order->status) == 'R' ? 'READY TO PICKUP' : 'FINISH') }}</h3>
                                <h3 class="card-title">CREATED : {{ date('Y/m/d H:i:s', strtotime($order->created_at)) }}</h3>
                            </div>
                            <div class="card-body">
                                @foreach($order->order_details as $index => $orderDetail)
                                    @if($index)
                                        <hr>
                                    @endif

                                    <div class="row py-2 px-3">
                                        <div class="col-12 d-flex">
                                            <div class="me-4" style="width: 150px; height: 150px;">
                                                <img src="{{ $orderDetail->product->image }}" class="img-thumbnail w-100" style="object-fit: cover;">
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center w-100">
                                                <div style="width: 200px;">
                                                    <p>Product Name</p>
                                                    <h3>{{ $orderDetail->product->name }}</h3>
                                                </div>
                                                <div style="width: 200px;">
                                                    <p>Qty.</p>
                                                    <h3>{{ $orderDetail->qty }}</h3>
                                                </div>
                                                <div style="width: 200px;">
                                                    <p>Price</p>
                                                    <h3>Rp {{ number_format($orderDetail->product->price) }}</h3>
                                                </div>
                                                <div style="width: 200px;">
                                                    <p>Sub Total</p>
                                                    <h3>Rp {{ number_format($orderDetail->sub_total) }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center w-100">
                                <div class="py-2 px-3 d-flex w-50">
                                    <h4 class="me-3 mb-0">Total : </h4>
                                    <h4 class="mb-0"><b>Rp {{ number_format((int) $order->total) }}</b></h4>
                                </div>
                                <div class="w-50 text-end">
                                    @if(trim($order->status) == 'N')
                                        <form action="{{ route('order_update') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="status" value="R">

                                            <button class="btn btn-primary">
                                                <span><i class="fas fa-check-circle me-2"></i></span>
                                                Ready to Pickup
                                            </button>
                                        </form>
                                    @elseif(trim($order->status) == 'R')
                                        <form action="{{ route('order_update') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="status" value="C">

                                            <button class="btn btn-success">
                                                <span><i class="fas fa-check-circle me-2"></i></span>
                                                Complete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
