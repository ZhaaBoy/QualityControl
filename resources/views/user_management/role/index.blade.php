@extends('layouts.base.app')

@section('title', 'Role Management')

@section('breadcrumb')
<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <!--begin::Page title-->
    {{-- @yield('breadcrumb') --}}
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Role</h1>
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
            <li class="breadcrumb-item text-muted">Role Management</li> 
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
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" id="search" name="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Role" />
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        @if(can('Role Management', 'create'))
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <a href="{{ route('settings.role.create') }}" class="btn btn-primary">Add Role</a>
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
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="text-start min-w-100px">No</th>
                    <th class="text-start min-w-100px">Name</th>
                    <th class="text-start min-w-100px">Description</th>
                    <th class="text-start min-w-100px">Menu</th>
                    <th class="text-start min-w-100px">Actions</th>
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
{{-- Modal Show --}}
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Menu</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script_processing')
<script>
function loadData() {
    let route = '{{ route('settings.role') }}';
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
                d.search = $('#search').val();  // Menambahkan search ke data yang dikirim
                d.year = 2024;     // Jika ada parameter lain
                d.month = 10;     // Jika ada parameter lain
            }
        },
        columns: [
            {
                data: 'DT_RowIndex',
            },
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'menu', name: 'menu', orderable: false, searchable: false  },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
}
$(document).ready(function() {
    loadData();

    $(document).on('click', '.lihat-menu', function(){
        var id = $(this).data('id');
        var user_id = $(this).data('userid');
        let url = '{{ route('settings.role.show', [':id', ':user_id']) }}';
        url = url.replace(':id', id);
        url = url.replace(':user_id', user_id);

        $('.modal-body').empty();
        $('.modal-body').append('<i>please wait ...</i>');
        $.ajax({
            type: "get",
            url: url,
            success: function (response) {
                let html = `<div class="row">
                                <div class="col-sm-12">
                                    <div class="verti-sitemap">
                                        <ul class="list-unstyled mb-0">
                                            <li class="p-0 parent-title"><a href="javascript: void(0);"
                                                    class="bi bi-arrow-right-circle"><b>${response.role}</b></a>
                                            </li>
                                            <li>`;

                $.map(response.menus, function (permission) {
                           
                                if (permission.level === 1 && permission.level === 1 ) {
                                    html += `<div class="first-list">`;
                                        html += `
                                            <div class="list-wrap">
                                                <a href="javascript: void(0);"
                                                    class="fw-medium">
                                                    <i class="${permission.icon} me-1 align-bottom"></i>${permission.name}</a>
                                            </div>
                                        `;

                                        var submenus = response.menus.filter(function (sub_permission) {
                                            return sub_permission.level === 2 && sub_permission.group === permission.group;
                                        });

                                        if (submenus.length > 0) {
                                            html += `<ul class="second-list list-unstyled">`;
                                            $.map(submenus, function (submenu) {
                                                html += `<li>
                                                            <a href="javascript: void(0);"><i
                                                                    class="${submenu.icon} me-1 align-bottom"></i>${submenu.name}</a>
                                                        </li>`;
                                            });
                                            html += `</ul>`;
                                        }
                                    html += `</div>`;
                                }
                });
                                html += `   </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>`;
                $('.modal-body').html(html);
            }
        });
    });

    $(document).on('click', '.delete', function () {
        let id = $(this).attr('id');
        confirmAndDelete("{{ route('settings.permission.destroy') }}", id);
    });
});
</script>

@endpush
