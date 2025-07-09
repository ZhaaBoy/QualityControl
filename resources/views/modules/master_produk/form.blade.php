@extends('layouts.base.app')

@section('title', 'Master Produk')

@section('breadcrumb')
<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <!--begin::Page title-->
    {{-- @yield('breadcrumb') --}}
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Master Produk</h1>
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
            <li class="breadcrumb-item text-muted">Master Produk {{ $data->id ? 'Edit' : 'Create' }}</li> 
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')
<form id="form_data" data-redirect-url="{{ route('master_produk') }}" action="{{$data->id ? route('master_produk.update', $data->id) : route('master_produk.store')}}">
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="tab-pane fade active show" id="kt_ecommerce_add_product_advanced" role="tab-panel">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ $data->id ? 'Edit' : 'Create' }} Master Produk</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mb-5">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="customer" class="form-label">Customer</label>
                                    <input type="text" class="form-control" value="{{ $data->customer }}" id="customer" placeholder="Customer" name="customer">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kode_barang" class="form-label">Kode Barang</label>
                                    <input type="text" class="form-control" value="{{ $data->kode_barang }}" id="kode_barang" placeholder="Kode Barang" name="kode_barang">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" value="{{ $data->nama_produk }}" id="nama_produk" placeholder="Nama Produk" name="nama_produk">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="bahan" class="form-label">Bahan</label>
                                    <input type="text" class="form-control" value="{{ $data->bahan }}" id="bahan" placeholder="Bahan" name="bahan">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="gramature" class="form-label">Gramature</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="d-flex align-items-center">
                                                <label class="form-check-label fs-6" for="gramature_min">Min : </label>
                                                <input type="number" name="gramature_min" class="form-control form-control-sm w-50"
                                                    placeholder="" value="{{ $data->gramature_min ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="d-flex align-items-center">
                                                <label class="form-check-label fs-6" for="gramature_standar">Standar : </label>
                                                <input type="number" name="gramature_standar" class="form-control form-control-sm w-50"
                                                    placeholder="" value="{{ $data->gramature_standar ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="d-flex align-items-center">
                                                <label class="form-check-label fs-6" for="gramature_max">Max : </label>
                                                <input type="number" name="gramature_max" class="form-control form-control-sm w-50"
                                                    placeholder="" value="{{ $data->gramature_max ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tebal_bahan" class="form-label">Tebal Bahan</label>
                                    <input type="number" class="form-control" value="{{ $data->tebal_bahan }}" id="tebal_bahan" placeholder="Tebal Bahan" name="tebal_bahan">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="dimensi" class="form-label">Dimensi</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="d-flex align-items-center">
                                                <label class="form-check-label fs-6" for="dimensi_panjang">Panjang : </label>
                                                <input type="number" name="dimensi_panjang" class="form-control form-control-sm w-50"
                                                    placeholder="" value="{{ $data->dimensi_panjang ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="d-flex align-items-center">
                                                <label class="form-check-label fs-6" for="dimensi_lebar">Lebar : </label>
                                                <input type="number" name="dimensi_lebar" class="form-control form-control-sm w-50"
                                                    placeholder="" value="{{ $data->dimensi_lebar ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="d-flex align-items-center">
                                                <label class="form-check-label fs-6" for="dimensi_tinggi">Tinggi : </label>
                                                <input type="number" name="dimensi_tinggi" class="form-control form-control-sm w-50"
                                                    placeholder="" value="{{ $data->dimensi_tinggi ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="javascript:history.back()" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
            

            <button type="submit" onclick="handleUpload('form_btn', 'form_data', '{{$data->id ? 'PATCH' : 'POST'}}');" class="btn btn-primary" id="form_btn">
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