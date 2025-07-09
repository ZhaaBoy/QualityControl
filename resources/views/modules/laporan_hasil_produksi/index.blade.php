@extends('layouts.base.app')

@section('title', 'Laporan Hasil Produk')

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
                <li class="breadcrumb-item text-muted">Laporan Hasil Produksi</li>
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

            @if (can('Laporan Hasil Produksi', 'create'))
                <div class="d-flex justify-content-end align-items-center gap-3">
                    <form action="{{ route('laporan_hasil_produksi.exportPdf') }}" method="GET"
                        class="d-flex align-items-center gap-2 m-0 p-0" target="_blank">
                        <input type="date" name="start_date" class="form-control form-control-sm">
                        <input type="date" name="end_date" class="form-control form-control-sm">
                        <input type="hidden" name="search" id="export_search">
                        <button type="submit" class="d-flex align-items-center btn btn-danger btn-sm"><i
                                class="bi bi-printer-fill"></i>Cetak</button>
                    </form>

                    <a href="{{ route('laporan_hasil_produksi.create') }}" class="btn btn-primary btn-sm">
                        Add Laporan Hasil Produksi
                    </a>
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
                        <th class="text-start min-w-100p">Mesin</th>
                        <th class="text-start min-w-100p">Nama Produk</th>
                        <th class="text-start min-w-100p">Nama Operator</th>
                        <th class="text-start min-w-100p">Acuan Sampling</th>
                        <th class="text-start min-w-100p">AQL Check</th>
                        <th class="text-start min-w-100p">Status Produk</th>
                        <th class="text-start min-w-100p">Temuan Defect</th>
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
            let route = '{{ route('laporan_hasil_produksi') }}';
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
                        data: 'mesin',
                        name: 'mesin'
                    },
                    {
                        data: 'nama_produk',
                        name: 'nama_produk'
                    },
                    {
                        data: 'nama_operator',
                        name: 'nama_operator'
                    },
                    {
                        data: 'acuan_sampling',
                        name: 'acuan_sampling'
                    },
                    {
                        data: 'aql_check',
                        name: 'aql_check'
                    },
                    {
                        data: 'status_produk',
                        name: 'status_produk',
                        render: function(data, type, row) {
                            let status = row['status_produk'];
                            let badgeClass = '';

                            switch (status) {
                                case 'OK':
                                    badgeClass = 'badge-light-success'; // hijau
                                    break;
                                case 'HOLD':
                                    badgeClass = 'badge-light-warning'; // kuning
                                    break;
                                case 'NG':
                                    badgeClass = 'badge-light-danger'; // merah
                                    break;
                                default:
                                    badgeClass = 'badge-light-secondary'; // abu-abu
                            }

                            return `<span class="badge fs-6 text-center ${badgeClass}">${status}</span>`;
                        }
                    },
                    {
                        data: 'temuan_defect',
                        name: 'temuan_defect'
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
            // Sinkronkan search dari datatable ke input export PDF
            $('#search').on('input', function() {
                $('#export_search').val($(this).val());
            });

            // Set default saat load awal
            $('#export_search').val($('#search').val());
            $(document).on('click', '.delete', function() {
                let id = $(this).attr('id');
                confirmAndDelete("{{ route('laporan_hasil_produksi.destroy') }}", id);
            });
        });
    </script>
@endpush
