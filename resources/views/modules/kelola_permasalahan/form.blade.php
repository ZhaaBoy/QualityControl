@extends('layouts.base.app')

@section('title', 'Kelola Permasalahan')

@section('breadcrumb')
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        {{-- @yield('breadcrumb') --}}
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kelola
                Permasalahan</h1>
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
                <li class="breadcrumb-item text-muted">Kelola Permasalahan {{ $data->id ? 'Edit' : 'Create' }}</li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
@endsection

@section('content')
    <form id="form_data" method="POST" enctype="multipart/form-data" data-redirect-url="{{ route('kelola_permasalahan') }}"
        action="{{ $data->id ? route('kelola_permasalahan.update', $data->id) : route('kelola_permasalahan.store') }}">
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
                                <h2>{{ $data->id ? 'Edit' : 'Create' }} Kelola Permasalahan</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row mb-5">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="jam" class="form-label">Waktu</label>
                                        <input type="datetime-local" class="form-control"
                                            value="{{ $data->jam ? \Carbon\Carbon::parse($data->jam)->format('Y-m-d\TH:i') : '' }}"
                                            id="jam" name="jam">
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
                                        <label for="permasalahan" class="form-label">Permasalahan</label>
                                        <input type="text" class="form-control" value="{{ $data->permasalahan }}"
                                            id="permasalahan" placeholder="Permasalahan" name="permasalahan">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="inline" class="form-label">Inline</label>
                                        <select class="form-select" id="inline" name="inline">
                                            <option @selected($data->inline == 'Thermolid') value="Thermolid">Thermolid</option>
                                            <option @selected($data->inline == 'Vacuum') value="Vacuum">Vacuum</option>
                                            <option @selected($data->inline == 'Sortir Atas') value="Sortir Atas">Sortir Atas</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="penyebab" class="form-label">Penyebab</label>
                                        <input type="text" class="form-control" value="{{ $data->penyebab }}"
                                            id="penyebab" placeholder="Penyebab" name="penyebab">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    @if ($data->foto)
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="foto" class="form-label">Foto</label>
                                                <a class="btn"
                                                    href="{{ asset('storage/kelola_permasalahan/foto/' . $data->foto) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/kelola_permasalahan/foto/' . $data->foto) }}"
                                                        alt="Foto" class="img-fluid" style="max-width: 100px;">
                                                </a>
                                            </div>
                                            <div class="col-8">
                                                <label for="foto" class="form-label">*</label>
                                                <input type="file" class="form-control" id="foto"
                                                    name="foto">
                                            </div>
                                        </div>
                                    @else
                                        <label for="foto" class="form-label">Input Foto</label>
                                        <input type="file" accept="image/*" class="form-control" id="foto"
                                            name="foto">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="javascript:history.back()" id="kt_ecommerce_add_product_cancel"
                    class="btn btn-light me-5">Cancel</a>


                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>

@endsection
