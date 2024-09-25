@extends('layouts.template')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Manage Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('product_list') }}">Manage Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="card-title">Create Product</h2>
                            </div>
                        </div>
                        <form action="{{ route('product_update', $product->id) }}" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="product_id" value="{{ isset($product) ? $product->id : '' }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" id="name" name="name" value="{{ isset($product) ? $product->name : '' }}">
                                    @error('name')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="type">
                                        @foreach($types as $item)
                                            <option value="{{ $item->id }}" {{ isset($product) && $product->type == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="sub_type" class="form-label">Sub Type</label>
                                    <select class="form-select" id="sub_type" name="sub_type">
                                        @foreach($subTypes as $item)
                                            <option value="{{ $item->id }}" {{ isset($product) && $product->sub_type == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" autocomplete="off" id="stock" name="stock" value="{{ isset($product) ? $product->stock : '' }}">
                                    @error('stock')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>

                                @if(isset($product) && $product->image)
                                    <div class="mb-3 w-100">
                                        <img src="{{ url('product_image/' . $product->image) }}" class="img-thumbnail">
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input type="file" class="form-control" autocomplete="off" id="image" name="image" data-max-size="2000000">
                                    @error('image')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
