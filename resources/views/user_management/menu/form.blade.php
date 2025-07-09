@extends('layouts.base.app')

@section('title', 'Menu Management')

@section('breadcrumb')
<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <!--begin::Page title-->
    {{-- @yield('breadcrumb') --}}
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Menu</h1>
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
            
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Menu Management {{ $data->id ? 'Edit' : 'Create' }}</li> 
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')
<form id="form_data" data-redirect-url="{{ route('settings.permission') }}" action="{{$data->id ? route('settings.permission.update', $data->id) : route('settings.permission.store')}}">
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="tab-pane fade active show" id="kt_ecommerce_add_product_advanced" role="tab-panel">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Create Menu</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control" id="name" value="{{ $data->name}}" placeholder="Nama Menu" name="name">
                        </div>
        
                        <div id="route_panel">
                            <div class="mb-3">
                                <label for="route" class="form-label">Route</label>
                                <input type="text" readonly class="form-control" id="route" value="default" placeholder="Nama Route" name="route">
                            </div>
                        </div>
        
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" placeholder="Remix Icon (eg: fa-solid fa-bars)" class="form-control" id="icon" value="{{ $data->icon }}" name="icon">
                        </div>
        
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <select class="form-control" id="level" name="level">
                                            <option @selected($data->level == 1 ) value="1" >1</option>
                                            <option @selected($data->level == 2 ) value="2" >2</option>
                                            {{-- <option @selected($data->level == 3 ) value="3" >3</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input type="number" class="form-control" value="{{ $data->position }}" id="position" placeholder="position" name="position">
                                </div>
                            </div>
                            <div class="col-lg-4" id="type_menu" style="{{ $data->level == 2 ? 'display: none;' : '' }}">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option {{ $data->type == 'static' ? 'selected' : '' }} value="static">Static</option>
                                        <option {{ $data->type == 'dropdown' ? 'selected' : ''}} value="dropdown">Dropdown</option>
                                    </select>
                                </div>
                            </div>
                        </div>
        
                        <div id="grup_menu" style="{{ $data->level == 2 ? '' : 'display: none;' }}">
                            <div class="mb-3">
                                <label for="menu_group_id" class="form-label">Grup</label>
                                <select class="form-control" id="menu_group_id" name="menu_group_id" data-choices data-choices-removeItem>
                                    @foreach ($groups as $item)
                                        <option {{ $item->group == $data->group ? 'selected' : ''}} value="{{ $item->group }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
        
        
                        <div id="parent_menu" style="display: none;">
                            <div class="mb-3">
                                <label for="grup_select" class="form-label">Parent Menu</label>
                                <select class="form-control" id="grup_select" name="grup">
                                        <option value="test" >test</option>
                                        <option value="test" >test</option>
                                        <option value="test" >test</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="roles[]" class="form-label">Role Name</label>
                            <select class="form-control select2" id="roles[]" name="roles[]" data-choices data-choices-removeItem multiple>
                                @foreach ($roles as $role)
                                    <option @selected($data->hasRole($role->name)) value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="text" class="form-control" id="description" placeholder="Menu description" name="description"></textarea>
                        </div>
                        <input type="hidden" value="{{ $data->description }}" id="value_desc">
                        <input type="hidden" value="{{ $data->id}}" id="id">
                        {{-- @dd($data) --}}
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
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
    var textarea = $('#description');
    var newValue = $('#value_desc').val();
    textarea.val(newValue);
    $('#level').change(function(){
        var level_val = $(this).val();
        level_val = parseInt(level_val);
        switch(level_val) {
            case 2:
            $('#grup_menu').show();
            $('#type_menu').hide();
            $('#parent_menu').hide();
            break;
            case  3:
            $('#grup_menu').show();
            $('#parent_menu').show()
            break;
            default:
            $('#grup_menu').hide();
            $('#type_menu').show();
            $('#parent_menu').hide();
            break;
        }
    });
    $('#type').change(function(){
        var type_val = $(this).val();
        switch(type_val) {
            case 'dropdown':
            $('#route_panel').hide();
            break;
            case 'static':
            $('#route_panel').show();
            break;
            default:
            $('#route_panel').show();
            break;
        }
    });
</script>
@endpush
