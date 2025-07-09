@extends('layouts.base.app')

@section('title', 'Data Hasil Produksi')

@section('breadcrumb')
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        {{-- @yield('breadcrumb') --}}
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Hasil
                Produksi</h1>
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
                <li class="breadcrumb-item text-muted">Data Hasil Produksi {{ $data->id ? 'Edit' : 'Create' }}</li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
@endsection

@section('content')
    <form id="form_data" data-redirect-url="{{ route('data_hasil_produksi') }}"
        action="{{ $data->id ? route('data_hasil_produksi.update', $data->id) : route('data_hasil_produksi.store') }}">
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="tab-pane fade active show" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ $data->id ? 'Edit' : 'Create' }} Data Hasil Produk</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row mb-5">

                                {{-- Tanggal --}}
                                <div class="col-lg-6 mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                        name="tanggal" id="tanggal" value="{{ old('tanggal', $data->tanggal) }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Mesin --}}
                                <div class="col-lg-6 mb-3">
                                    <label for="mesin" class="form-label">Mesin</label>
                                    <input type="text" class="form-control @error('mesin') is-invalid @enderror"
                                        name="mesin" id="mesin" placeholder="Mesin"
                                        value="{{ old('mesin', $data->mesin) }}">
                                    @error('mesin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Nama Produk --}}
                                <div class="col-lg-6 mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <select class="form-select @error('nama_produk') is-invalid @enderror" id="nama_produk"
                                        name="nama_produk">
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}" @selected(old('nama_produk', $data->nama_produk) == $produk->id)>
                                                {{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Jenis Bahan --}}
                                <div class="col-lg-6 mb-3">
                                    <label for="jenis_bahan" class="form-label">Jenis Bahan</label>
                                    <input type="text" class="form-control @error('jenis_bahan') is-invalid @enderror"
                                        name="jenis_bahan" id="jenis_bahan" placeholder="Jenis Bahan"
                                        value="{{ old('jenis_bahan', $data->jenis_bahan) }}">
                                    @error('jenis_bahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Acuan Sampling --}}
                                <div class="col-lg-6 mb-3">
                                    <label for="acuan_sampling" class="form-label">Acuan Sampling</label>
                                    <input type="text" class="form-control @error('acuan_sampling') is-invalid @enderror"
                                        name="acuan_sampling" id="acuan_sampling" placeholder="Acuan Sampling"
                                        value="{{ old('acuan_sampling', $data->acuan_sampling) }}">
                                    @error('acuan_sampling')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- AQL Check --}}
                                <div class="col-lg-6 mb-3">
                                    <label for="aql_check" class="form-label">AQL Check</label>
                                    <input type="text" class="form-control @error('aql_check') is-invalid @enderror"
                                        name="aql_check" id="aql_check" placeholder="AQL Check"
                                        value="{{ old('aql_check', $data->aql_check) }}">
                                    @error('aql_check')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Status Pre Order --}}
                                <div class="col-lg-6 mb-3">
                                    <label for="status_pre_order" class="form-label">Status Pre Order</label>
                                    <select class="form-select @error('status_pre_order') is-invalid @enderror"
                                        id="status_pre_order" name="status_pre_order">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Open" @selected(old('status_pre_order', $data->status_pre_order) == 'Open')>Open</option>
                                        <option value="Close" @selected(old('status_pre_order', $data->status_pre_order) == 'Close')>Close</option>
                                    </select>
                                    @error('status_pre_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tanggal Start Awal --}}
                                <div class="col-lg-6 mb-3">
                                    <label for="tanggal_start_awal" class="form-label">Tanggal Start Awal</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_start_awal') is-invalid @enderror"
                                        name="tanggal_start_awal" id="tanggal_start_awal"
                                        value="{{ old('tanggal_start_awal', $data->tanggal_start_awal) }}">
                                    @error('tanggal_start_awal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
