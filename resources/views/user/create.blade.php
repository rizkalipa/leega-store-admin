@extends('layouts.template')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Manage User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('user_list') }}">Manage User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Create
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
                                <h2 class="card-title">Create User</h2>
                            </div>
                        </div>
                        <form action="{{ route('user_update') }}" method="post">
                            <div class="card-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" autocomplete="off" id="name" name="name" value="{{ isset($user) ? $user->name : '' }}">
                                    @error('name')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" autocomplete="off" id="email" name="email" aria-describedby="emailHelp" value="{{ isset($user) ? $user->email : '' }}">
                                    @error('email')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                    <div id="emailHelp" class="form-text">
                                        We'll never share your email with anyone else.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" autocomplete="off" id="password" name="password">
                                    @error('password')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" autocomplete="off" id="password_confirmation" name="password_confirmation">
                                    @error('password_confirmation')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role">
                                        <option value="user" {{ isset($user) && $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ isset($user) && $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
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
