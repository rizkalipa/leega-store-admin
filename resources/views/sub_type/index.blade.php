@extends('layouts.template')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Master Sub Type Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Master Sub Type Product</a></li>
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
                                <h2 class="card-title">List Sub Type Product</h2>
                                <a href="{{ route('sub_type_create') }}" class="btn btn-primary px-3">
                                    <span class=""><i class="fas fa-user-plus me-2 fs-6"></i></span>
                                    Create Sub Type
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-active">
                                    <tr>
                                        <th style="width: 80px;">#</th>
                                        <th>Name</th>
                                        <th style="width: 350px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subTypes as $index => $subType)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $subType->name }}</td>
                                            <td>
                                                <a href="{{ route('sub_type_edit', $subType->id) }}" class="btn btn-primary px-3">
                                                    <span class=""><i class="fas fa-edit me-2 fs-6"></i></span>
                                                    Edit
                                                </a>
                                                <a href="{{ route('sub_type_delete', $subType->id) }}" class="btn btn-danger px-3">
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
