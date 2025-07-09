@extends('layouts.base.app')

@section('title', 'Laporan Hasil Produksi')

@section('breadcrumb')
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        {{-- @yield('breadcrumb') --}}
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laporan Hasil
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
                <li class="breadcrumb-item text-muted">Laporan Hasil Produksi {{ $data->id ? 'Edit' : 'Create' }}</li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
@endsection

@section('content')
    <form id="form_data" data-redirect-url="{{ route('laporan_hasil_produksi') }}"
        action="{{ $data->id ? route('laporan_hasil_produksi.update', $data->id) : route('laporan_hasil_produksi.store') }}">
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="tab-pane fade active show" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ $data->id ? 'Edit' : 'Create' }} Laporan Hasil Produksi</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row mb-5">
                                {{-- <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="hari" class="form-label">Hari</label>
                                    @php
                                        $daftarHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                    @endphp

                                    <select class="form-control" id="hari" name="hari">
                                        @foreach ($daftarHari as $hari)
                                            <option value="{{ $hari }}" {{ $data->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d') }}"
                                            id="tanggal" placeholder="Tanggal" name="tanggal">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="mesin" class="form-label">Mesin</label>
                                        <input type="text" class="form-control" value="{{ $data->mesin }}"
                                            id="mesin" placeholder="Mesin" name="mesin">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="nama_operator" class="form-label">Nama Operator</label>
                                        <input type="text" class="form-control" value="{{ $data->nama_operator }}"
                                            id="nama_operator" placeholder="Nama Operator" name="nama_operator">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="nama_produk" class="form-label">Nama Produk</label>
                                        <select class="form-select" id="nama_produk" name="nama_produk">
                                            @foreach ($produks as $produk)
                                                <option @selected($data->nama_produk == $produk->id) value="{{ $produk->id }}">
                                                    {{ $produk->nama_produk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="acuan_sampling" class="form-label">Acuan Sampling</label>
                                        <input type="text" class="form-control" value="{{ $data->acuan_sampling }}"
                                            id="acuan_sampling" placeholder="Acuan Sampling" name="acuan_sampling">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="aql_check" class="form-label">AQL Check</label>
                                        <input type="text" class="form-control" value="{{ $data->aql_check }}"
                                            id="aql_check" placeholder="AQL Check" name="aql_check">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="status_produk" class="form-label">Status Produk</label>
                                        <select class="form-select" id="status_produk" name="status_produk">
                                            <option @selected($data->status_pre == 'OK') value="OK">OK</option>
                                            <option @selected($data->status_pre == 'HOLD') value="HOLD">HOLD</option>
                                            <option @selected($data->status_pre == 'NG') value="NG">NG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="temuan_defect" class="form-label">Temuan Defect</label>
                                        <input type="text" class="form-control" value="{{ $data->temuan_defect }}"
                                            id="temuan_defect" placeholder="Temuan Defect" name="temuan_defect">
                                    </div>
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
