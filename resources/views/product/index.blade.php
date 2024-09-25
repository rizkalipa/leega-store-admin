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
                        <li class="breadcrumb-item"><a href="#">Manage Product</a></li>
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="card-title">List Product</h2>
                                <a href="{{ route('product_create') }}" class="btn btn-primary px-3">
                                    <span class=""><i class="fas fa-user-plus me-2 fs-6"></i></span>
                                    Create Product
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-active">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Sub Type</th>
                                        <th>Stock</th>
                                        <th style="width: 350px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->type_product ? $product->type_product->name : '-' }}</td>
                                            <td>{{ $product->sub_type_product ? $product->sub_type_product->name : '-' }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                <a href="{{ route('product_edit', $product->id) }}" class="btn btn-primary px-3">
                                                    <span class=""><i class="fas fa-edit me-2 fs-6"></i></span>
                                                    Edit
                                                </a>
                                                <a href="{{ route('product_delete', $product->id) }}" class="btn btn-danger px-3">
                                                    <span class=""><i class="fas fa-trash me-2 fs-6"></i></span>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
