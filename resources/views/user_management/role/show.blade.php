@extends('layouts.base.app')

@section('title', 'Role Management')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Role Management" page="Role Management" active="Role {{ @$data[0]->id ? 'Show' : 'Create'}}" route="{{ route('settings.role') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="">
            <div class="modal-header">
                <h5>{{ @$data[0]->id ? 'Show' : 'Create'}} Role</h5>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="verti-sitemap">
                                <ul class="list-unstyled mb-0">
                                    <li class="p-0 parent-title"><a href="javascript: void(0);"
                                            class="bi bi-arrow-right-circle">{{ $role }}</a>
                                    </li>
                                    @foreach ($list_permission as $permission)
                                    <li>
                                        <div class="first-list">
                                            @if($permission->level == 2)
                                            <ul class="second-list list-unstyled">
                                                <li>
                                                    <a href="javascript: void(0);"><i
                                                            class=" me-1 align-bottom"></i>{{ $permission->name }}</a>

                                                </li>
                                            </ul>
                                            @else
                                            <div class="list-wrap">
                                                <a href="javascript: void(0);"
                                                    class="fw-medium text-primary"><i
                                                        class="{{ $permission->icon }} me-1 align-bottom"></i>{{ $permission->name }}</a>
                                            </div>
                                            @endif

                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
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
        </form>
        <center>
            <div class="card-footer d-flex justify-content-center py-6 px-9">
                <a href="{{ route('settings.role') }}" class="btn btn-success btn-active-light-primary me-2"><i class="ki-duotone ki-arrow-left fs-4 ms-1 me-0">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>Kembali</a>
            </div>
        </center>
    </div>
</div>

@endsection
