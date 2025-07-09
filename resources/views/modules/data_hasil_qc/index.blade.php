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
                <li class="breadcrumb-item text-muted">Data Hasil QC</li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
@endsection

@section('content')
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" id="search" name="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Search Menu" />
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->

            @if (can('Data Hasil QC', 'create'))
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <a href="{{ route('data_hasil_qc.create') }}" class="btn btn-primary">Add Data Hasil QC</a>
                </div>
            @endif
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="dataTable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="text-center min-w-100px">No</th>
                        <th class="text-start min-w-100p">Hari & Tanggal</th>
                        <th class="text-start min-w-100p">Nama Produk</th>
                        <th class="text-start min-w-100p">Nama Mesin</th>
                        <th class="text-start min-w-100p">Jumlah Cavity</th>
                        <th class="text-start min-w-100p">Jenis Bahan</th>
                        <th class="text-start min-w-100p">Tebal Bahan</th>
                        <th class="text-start min-w-100p">Status Pre</th>
                        <th class="text-start min-w-100p">Dimensi Panjang</th>
                        <th class="text-start min-w-100p">Dimensi Lebar</th>
                        <th class="text-start min-w-100p">Dimensi Tinggi</th>
                        <th class="text-start min-w-100p">AQL Check</th>
                        <th class="text-start min-w-100p">Inline</th>
                        <th class="text-start min-w-100p">Point Critical</th>
                        <th class="text-start min-w-100p">Actions</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-semibold text-gray-600">
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
@endsection

@push('script_processing')
    <script>
        function loadData() {
            let route = '{{ route('data_hasil_qc') }}';
            initializeDataTable({

                tableId: 'dataTable',
                searchInputId: 'search',
                pageLength: 5,
                searching: false,
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: {
                    url: route,
                    type: 'GET',
                    data: function(d) {
                        d.search = $('#search').val(); // Menambahkan search ke data yang dikirim
                        d.year = 2024; // Jika ada parameter lain
                        d.month = 10; // Jika ada parameter lain
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        className: 'text-center',
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'nama_produk',
                        name: 'nama_produk'
                    },
                    {
                        data: 'nama_mesin',
                        name: 'nama_mesin'
                    },
                    {
                        data: 'jumlah_cavity',
                        name: 'jumlah_cavity'
                    },
                    {
                        data: 'jenis_bahan',
                        name: 'jenis_bahan'
                    },
                    {
                        data: 'tebal_bahan',
                        name: 'tebal_bahan'
                    },
                    {
                        data: 'status_pre',
                        name: 'status_pre'
                    },
                    {
                        data: 'dimensi_panjang',
                        name: 'dimensi_panjang'
                    },
                    {
                        data: 'dimensi_lebar',
                        name: 'dimensi_lebar'
                    },
                    {
                        data: 'dimensi_tinggi',
                        name: 'dimensi_tinggi'
                    },
                    {
                        data: 'aql_check',
                        name: 'aql_check'
                    },
                    {
                        data: 'inline',
                        name: 'inline'
                    },
                    {
                        data: 'point_critical',
                        name: 'point_critical'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        }

        $(document).ready(function() {
            loadData();

            $(document).on('click', '.delete', function() {
                let id = $(this).attr('id');
                confirmAndDelete("{{ route('data_hasil_qc.destroy') }}", id);
            });
        });
    </script>
@endpush
