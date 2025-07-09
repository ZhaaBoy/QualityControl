@extends('layouts.auth.app')

@section('title', 'Log In')


@section('content')
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(/assets/media/illustrations/sketchy-1/14.png)">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->

            <div class="mb-12">
                <div class="d-flex align-items-center">
                    <img class="me-3" alt="Logo" src="{{asset('logo/logo.png')}}"  style="height: 80px"/>
                    <h1 style="font-size: xxx-large">DEPARTEMEN QUALITY CONTROL</h1>
                </div>
            </div>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Login</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <input type="text" value="{{ old('name') }}" placeholder="Nama Pengguna" name="name" autocomplete="off" class="form-control bg-transparent" />
                        <x-form.validation.error name="name" />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
                        <x-form.validation.error name="password" />
                        <!--end::Input-->
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button class="btn btn-primary" type="submit">Masuk</button>
                        <!--end::Submit button-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
        <!--end::Authentication - Sign-in-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $('#reload').click(function() {
            $.ajax({
            type: 'GET',
                url: "{{ route('reloadCaptcha') }}",
                success: function(data) {
                    $('.captcha span').html(data.captcha);
                },
            });
        });

        // Show Password
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById("password-input");
            const btn_show = document.getElementById("password-addon");

            btn_show.addEventListener("click", function() {
                if (password.type === "password") {
                    password.type = "text";
                    btn_show.innerHTML = '<i class="ri-eye-off-fill align-middle"></i>';
                } else {
                    password.type = "password";
                    btn_show.innerHTML = '<i class="ri-eye-fill align-middle"></i>';
                }
            });
        });
    </script>

@endsection
