@extends('layouts.base.app')

@section('title', 'Data Hasil QC')

@section('breadcrumb')
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        {{-- @yield('breadcrumb') --}}
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Hasil QC</h1>
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
                <li class="breadcrumb-item text-muted">Data Hasil QC {{ $data->id ? 'Edit' : 'Create' }}</li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
@endsection

@section('content')
    <form id="form_data" data-redirect-url="{{ route('data_hasil_qc') }}"
        action="{{ $data->id ? route('data_hasil_qc.update', $data->id) : route('data_hasil_qc.store') }}">
        @csrf
        @if ($data->id)
            @method('PATCH')
        @endif
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="tab-pane fade active show" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ $data->id ? 'Edit' : 'Create' }} Data Hasil QC</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row mb-5">
                                <div class="col-lg-6 mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal"
                                        class="form-control @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal', $data->tanggal) }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <select name="nama_produk" id="nama_produk"
                                        class="form-select @error('nama_produk') is-invalid @enderror">
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}" @selected(old('nama_produk', $data->nama_produk) == $produk->id)>
                                                {{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="jenis_bahan" class="form-label">Jenis Bahan</label>
                                    <input type="text" name="jenis_bahan" id="jenis_bahan"
                                        class="form-control @error('jenis_bahan') is-invalid @enderror"
                                        value="{{ old('jenis_bahan', $data->jenis_bahan) }}">
                                    @error('jenis_bahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="tebal_bahan" class="form-label">Tebal Bahan</label>
                                    <input type="number" name="tebal_bahan" id="tebal_bahan"
                                        class="form-control @error('tebal_bahan') is-invalid @enderror"
                                        value="{{ old('tebal_bahan', $data->tebal_bahan) }}">
                                    @error('tebal_bahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="nama_mesin" class="form-label">Nama Mesin</label>
                                    <input type="text" name="nama_mesin" id="nama_mesin"
                                        class="form-control @error('nama_mesin') is-invalid @enderror"
                                        value="{{ old('nama_mesin', $data->nama_mesin) }}">
                                    @error('nama_mesin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="jumlah_cavity" class="form-label">Jumlah Cavity</label>
                                    <input type="number" name="jumlah_cavity" id="jumlah_cavity"
                                        class="form-control @error('jumlah_cavity') is-invalid @enderror"
                                        value="{{ old('jumlah_cavity', $data->jumlah_cavity) }}">
                                    @error('jumlah_cavity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="status_pre" class="form-label">Status Pre</label>
                                    <select name="status_pre" id="status_pre"
                                        class="form-select @error('status_pre') is-invalid @enderror">
                                        <option value="OK" @selected(old('status_pre', $data->status_pre) == 'OK')>OK</option>
                                        <option value="NO" @selected(old('status_pre', $data->status_pre) == 'NO')>NO</option>
                                    </select>
                                    @error('status_pre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Dimensi</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="number" name="dimensi_panjang" placeholder="Panjang"
                                                class="form-control @error('dimensi_panjang') is-invalid @enderror"
                                                value="{{ old('dimensi_panjang', $data->dimensi_panjang) }}">
                                            @error('dimensi_panjang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-4">
                                            <input type="number" name="dimensi_lebar" placeholder="Lebar"
                                                class="form-control @error('dimensi_lebar') is-invalid @enderror"
                                                value="{{ old('dimensi_lebar', $data->dimensi_lebar) }}">
                                            @error('dimensi_lebar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-4">
                                            <input type="number" name="dimensi_tinggi" placeholder="Tinggi"
                                                class="form-control @error('dimensi_tinggi') is-invalid @enderror"
                                                value="{{ old('dimensi_tinggi', $data->dimensi_tinggi) }}">
                                            @error('dimensi_tinggi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="aql_check" class="form-label">AQL Check</label>
                                    <input type="text" name="aql_check" id="aql_check"
                                        class="form-control @error('aql_check') is-invalid @enderror"
                                        value="{{ old('aql_check', $data->aql_check) }}">
                                    @error('aql_check')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="inline" class="form-label">Inline</label>
                                    <select name="inline" id="inline"
                                        class="form-select @error('inline') is-invalid @enderror">
                                        <option value="Thermolid" @selected(old('inline', $data->inline) == 'Thermolid')>Thermolid</option>
                                        <option value="Vacuum" @selected(old('inline', $data->inline) == 'Vacuum')>Vacuum</option>
                                        <option value="Sortir Atas" @selected(old('inline', $data->inline) == 'Sortir Atas')>Sortir Atas</option>
                                    </select>
                                    @error('inline')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="point_critical" class="form-label">Point Critical</label>
                                    <input type="text" name="point_critical" id="point_critical"
                                        class="form-control @error('point_critical') is-invalid @enderror"
                                        value="{{ old('point_critical', $data->point_critical) }}">
                                    @error('point_critical')
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
                    <span class="indicator-label">Simpan</span>
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
