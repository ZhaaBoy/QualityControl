@extends('layouts.base.app')

@section('title', 'User Management')

@section('breadcrumb')
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        {{-- @yield('breadcrumb') --}}
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">User</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Kelola User {{ @$data[0]->id ? 'Edit' : 'Create' }}</li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
@endsection

@section('content')
    <form id="form_data" data-redirect-url="{{ route('settings.user') }}"
        action="{{ $data->id ? route('settings.user.update', $data->id) : route('settings.user.store') }}">
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="tab-pane fade active show" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Create Data Surat Masuk</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row mb-5">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label required">Name</label>
                                        <input type="text" class="form-control" value="{{ $data->name }}"
                                            id="name" placeholder="User Name" name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label required">Username</label>
                                        <input type="text" class="form-control" value="{{ $data->username }}"
                                            id="username" placeholder="Username" name="username">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label required">Email</label>
                                        <input type="email" class="form-control" value="{{ $data->email }}"
                                            id="email" placeholder="Email" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label required">Password @if ($data->id)
                                                <i class="" style="color: red"> masukkan password jika anda ingin
                                                    mengganti password</i>
                                            @endif
                                        </label>
                                        <input type="password" class="form-control" id="password" placeholder="Password"
                                            name="password">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label required">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            placeholder="Confirm Password" name="confirm_password">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="role" class="form-label required">Select Role</label>
                                        <select class="form-select" id="role" name="role" data-choices
                                            data-choices-removeItem>
                                            @foreach ($roles as $role)
                                                <option @selected($data->hasRole($role->name)) value="{{ $role->name }}">
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="javascript:history.back()" id="kt_ecommerce_add_product_cancel"
                    class="btn btn-light me-5">Cancel</a>


                <button type="submit"
                    onclick="handleUpload('form_btn', 'form_data', '{{ $data->id ? 'PATCH' : 'POST' }}');"
                    class="btn btn-primary" id="form_btn">
                    <span class="indicator-label">
                        Simpan
                    </span>

                    <span class="indicator-progress" style="display: none;">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </form>

@endsection

@push('script_processing')
    <script>
        var textarea = $('#description');
        var newValue = $('#value_desc').val();
        textarea.val(newValue);
    </script>
@endpush
