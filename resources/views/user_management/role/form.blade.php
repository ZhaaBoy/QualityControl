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
            <li class="breadcrumb-item text-muted">Role Management {{ @$data[0]->id ? 'Edit' : 'Create' }}</li> 
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')
<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ @$data[0]->id ? 'Edit' : 'Create'}} Role</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <form action="">
                    <input type="hidden" id="id" value="{{ @$data[0]->id }}">
                    <input type="hidden" id="value_desc" value="{{ @$data[0]->description }}">
    
                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Role Name" value="{{ @$data[0]->name }}">
                    </div>
    
                    <!-- Permissions Assignment -->
                    <div class="row mb-3">
                        <label class="mb-3">Assign Permission to Roles:</label>
    
                        @foreach ($first_level as $first_permission)
                            @php
                                $checkedPermission = in_array($first_permission->id, $data_array) ? 'checked' : '';
                                $hakaksesIds = [];
                                if ($checkedPermission) {
                                    foreach ($list_permission_checked as $val) {
                                        if ($val->permission_id === $first_permission->id) {
                                            $hakaksesIds[] = $val->hakakses_id;
                                        }
                                    }
                                }
                            @endphp
    
                            @if ($first_permission->level == 1)
                                <div class="permission-container">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3 mb-3">
                                        <input type="checkbox" class="form-check-input" name="permission[]" id="permission_{{ $first_permission->id }}" value="{{ $first_permission->id }}" {{ $checkedPermission }}>
                                        <label for="permission_{{ $first_permission->id }}" class="checkbox checkbox-outline checkbox-success mx-3">
                                            {{ $first_permission->name }}
                                        </label>
                                    </div>
    
                                    <!-- Hakakses for First Level -->
                                    <div style="margin-left: 20px">
                                        @foreach ($list_Hakakses as $key => $value)
                                            @php
                                                $checkedHakakses = in_array($value->id, $hakaksesIds) ? 'checked' : '';
                                                $checkboxId = "hakakses_{$first_permission->name}_{$value->name}";
                                            @endphp
                                            @if($first_permission->type == 'dropdown')
                                                @if ($loop->index == 1)
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3 mb-3">
                                                        <input type="checkbox" class="form-check-input" name="hakakses[]" id="{{ $checkboxId }}" value="{{ $value->id }}" {{ $checkedHakakses }} data-permission="{{ $first_permission->id }}">
                                                        <label for="{{ $checkboxId }}" class="checkbox checkbox-outline checkbox-success mx-3">
                                                            {{ $value->name }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @else   
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3 mb-3">
                                                    <input type="checkbox" class="form-check-input" name="hakakses[]" id="{{ $checkboxId }}" value="{{ $value->id }}" {{ $checkedHakakses }} data-permission="{{ $first_permission->id }}">
                                                    <label for="{{ $checkboxId }}" class="checkbox checkbox-outline checkbox-success mx-3">
                                                        {{ $value->name }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                        <hr>
                                    </div>
    
                                    <!-- Second Level Permissions -->
                                    @php
                                        $second_level = Spatie\Permission\Models\Permission::orderBy('position', 'ASC')
                                            ->where('level', 2)
                                            ->where('group', $first_permission->group)
                                            ->get();
                                    @endphp
    
                                    @foreach ($second_level as $second_permission)
                                        @php
                                            $checkedSubPermission = in_array($second_permission->id, $data_array) ? 'checked' : '';
                                            $hakaksesSubIds = [];
                                            if ($checkedSubPermission) {
                                                foreach ($list_permission_checked as $val) {
                                                    if ($val->permission_id === $second_permission->id) {
                                                        $hakaksesSubIds[] = $val->hakakses_id;
                                                    }
                                                }
                                            }
                                        @endphp
    
                                        <div class="form-check form-check-sm form-check-custom form-check-solid mb-3" style="margin-left: 20px">
                                            <input type="checkbox" class="form-check-input" name="permission[]" id="permission_{{ $second_permission->id }}" value="{{ $second_permission->id }}" {{ $checkedSubPermission }}>
                                            <label for="permission_{{ $second_permission->id }}" class="checkbox checkbox-outline checkbox-success mx-3">
                                                {{ $second_permission->name }}
                                            </label>
                                        </div>
    
                                        <!-- Hakakses for Second Level -->
                                        <div style="margin-left: 40px">
                                            @foreach ($list_Hakakses as $key => $value)
                                                @php
                                                    $checkedHakakses = in_array($value->id, $hakaksesSubIds) ? 'checked' : '';
                                                    $checkboxId = "hakakses_{$second_permission->name}_{$value->name}";
                                                @endphp
                                                @if ($second_permission->type == 'dropdown')
                                                    @if ($loop->index == 1)
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3 mb-3">
                                                            <input type="checkbox" class="form-check-input" name="hakakses[]" id="{{ $checkboxId }}" value="{{ $value->id }}" {{ $checkedHakakses }} data-permission="{{ $second_permission->id }}">
                                                            <label for="{{ $checkboxId }}" class="checkbox checkbox-outline checkbox-success mx-3">
                                                                {{ $value->name }}
                                                            </label>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3 mb-3">
                                                        <input type="checkbox" class="form-check-input" name="hakakses[]" id="{{ $checkboxId }}" value="{{ $value->id }}" {{ $checkedHakakses }} data-permission="{{ $second_permission->id }}">
                                                        <label for="{{ $checkboxId }}" class="checkbox checkbox-outline checkbox-success mx-3">
                                                            {{ $value->name }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
    
                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Role description">{{ @$data[0]->description }}</textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-end">
        <a href="javascript:history.back()" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>

        <button type="button" class="btn btn-primary" id="simpan">
            <span class="indicator-label">
                Submit
            </span>
            <span class="indicator-progress" style="display: none;">
                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </div>
</div>
@endsection

@push('script')
<script>

$(document).ready(function() {
    $('input[name="permission[]"]').on('change', function() {
        var permissionChecked = $(this).prop('checked');
        var permissionId = $(this).val();
        $('input[name="hakakses[]"][data-permission="' + permissionId + '"]').prop('checked', permissionChecked);
    });

    $('input[name="hakakses[]"]').on('change', function() {
        var permissionId = $(this).data('permission');

        var checkedCount = $('input[name="hakakses[]"][data-permission="' + permissionId + '"]:checked').length;
        
        $('#permission_' + permissionId).prop('checked', checkedCount > 0);
    });
});
 

</script>
@endpush

@push('script_processing')
<script>
var textarea = $('#description'); 
var newValue = $('#value_desc').val();
textarea.val(newValue); 


let button = document.querySelector("#simpan");
button.addEventListener("click", function() {
    $('.indicator-progress').show();
    $('.indicator-label').hide();
    let id = $('#id').val();
    let url;
    let title;
    if(id > 0 ) {
        url = "{{ route('settings.role.update') }}";
    }else{
        url = "{{ route('settings.role.store') }}";
    }
    
    let datas = [];
    $('input[name="permission[]"]:checked').each(function () {
        let permissionId = $(this).val();
        let hakaksesArr = [];
        let hakaksesSelected = $('input[name="hakakses[]"]:checked[data-permission="' + permissionId + '"]').length > 0;
        if (!hakaksesSelected) {
            Swal.fire('Permission with ID ' + permissionId + ' does not have any hakakses selected!', '', 'error');
            return; 
        }
        $('input[name="hakakses[]"]:checked[data-permission="' + permissionId + '"]').each(function () {
            let hakaksesId = $(this).val();
            hakaksesArr.push(hakaksesId);
        });
        datas.push({ permission_id: permissionId, hakakses: hakaksesArr });
    });
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: "{{ csrf_token() }}",
            id: id,
            name: $('#name').val(),
            description: $('#description').val(),
            permissions: JSON.stringify(datas),
        },
        success: function (res) {
            $('.indicator-progress').hide();
            $('.indicator-label').show();
            Swal.fire({
                icon: 'success',
                title: res.text,
                showConfirmButton: false,
                timer: 1500
            }).then((res) => {
                var url = "{{ route('settings.role') }}";
                window.location.href = url;
            })
        },
        error: function (xhr) {
            $('.indicator-progress').hide();
            $('.indicator-label').show();
            if(xhr.responseJSON.text == 'Anda tidak memiliki izin' ){
                    Swal.fire({
                    icon: 'error',
                    title: xhr.responseJSON.text,
                    showConfirmButton: false,
                    timer: 1500
                })
            }else{
                iziToast.warning({
                    title: 'Gagal',
                    message: xhr.responseJSON.text,
                });
            }
        }
    });
});
</script>
@endpush