@extends('layouts.auth.app')

@section('title', 'Sign Up')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Create New Account</h5>
                        <p class="text-muted">Get your free velzon account now</p>
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <x-form.validation.error name="name" />
                            </div>

                            <div class="mb-3">
                                <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="useremail" placeholder="Enter email address"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">
                                <x-form.validation.error name="email" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <div class="position-relative auth-pass-inputgroup">
                                    <input type="password" class="form-control pe-5 password-input" onpaste="return false"
                                        placeholder="Enter password" id="password" name="password" required
                                        autocomplete="new-password" placeholder="Password">
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    <x-form.validation.error name="password" />
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">Password Confirmation</label>
                                <div class="position-relative auth-pass-inputgroup">
                                    <input type="password" class="form-control pe-5 password-input" onpaste="return false"
                                        placeholder="Enter password confirmation" id="password_confirmation"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Password Confirmation">
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the Velzon <a
                                        href="#"
                                        class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a>
                                </p>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">Sign Up</button>
                            </div>

                            <div class="mt-4 text-center">
                                <div class="signin-other-title">
                                    <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                </div>

                                <div>
                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i
                                            class="ri-facebook-fill fs-16"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i
                                            class="ri-google-fill fs-16"></i></button>
                                    <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i
                                            class="ri-github-fill fs-16"></i></button>
                                    <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i
                                            class="ri-twitter-fill fs-16"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="mt-4 text-center">
                <p class="mb-0">Already have an account ? <a href="{{ route('login') }}"
                        class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
            </div>

        </div>
    </div>
@endsection


{{-- @extends('layouts.auth.app')

@section('title', 'Register')

@section('content')

    <style>
        body {
            background-color: #f1f1f1
        }

        .btn-submit {
            border-radius: 10px;
            background-color: #c4c4c4;
            color: black
        }

        .btn-submit:hover {
            background-color: #5c636a;
        }

        .card {
            border-radius: 25px;
            background-color: #BABAE8;
        }

        .card-logo {
            background-color: #222866;
            border-radius: 25px;
        }

        .card-form {
            background-color: #BABAE8;
            border-radius: 25px;
        }

        @media(max-width: 768px) {
            .card-text {
                font-size: 10px
            }
        }

        @media(max-width: 425px) {
            .card-text {
                font-size: 10px
            }

            .card-logo {
                border-radius: 25px;
            }
        }
    </style>

    @include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-lg-12">
                <div class="card mb-3" style="">
                    <div class="row g-0">
                        <div class="col-md-5 card-logo" style="">
                            <img src="/assets/images/logo_dkpp.jpeg" class="img-fluid mx-auto d-block mt-5 pt-4 mb-4"
                                alt="..." style="width: 170px; height:auto">
                            <div class="text-center">
                                <h5 class="fs-3 card-title fw-bolder text-white">DKPP</h5>
                                <p class="card-text fs-4 text-white">Dewan Kehormatan Penyelenggara Pemilu Republik
                                    Indonesia</p>
                            </div>
                        </div>
                        <div class="col-md-7 card-form" style="">
                            <div class="card-body">
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <h5 class="card-title mt-3 mb-4 fs-3 fw-bolder text-dark">Register</h5>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter your name" name="name" value="{{ old('name') }}"
                                            required autocomplete="name" autofocus>
                                        <x-form.validation.error name="name" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label text-dark">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Enter email address" name="email" value="{{ old('email') }}"
                                            required placeholder="Email" autocomplete="email" autofocus>
                                        <x-form.validation.error name="email" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-dark" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5" placeholder="Enter password"
                                                id="password-input" name="password" required placeholder="Password"
                                                autocomplete="current-password">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                            <x-form.validation.error name="password" />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation">Password Confirmation</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input"
                                                onpaste="return false" placeholder="Enter password confirmation"
                                                id="password_confirmation" name="password_confirmation" required
                                                autocomplete="new-password" placeholder="Password Confirmation">
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <a href="{{ route('login') }}" class="">Sudah punya akun ?<b> Login</b></a>
                                        </div>
                                    </div>

                                    <div class="row mb-4 justify-content-center">
                                        <div class="col">
                                            <div class="">
                                                <button class="btn btn-dark btn-submit w-100 btn-md"
                                                    type="submit">Daftar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            const password_confirmation = document.getElementById("password_confirmation");
            const btn_show = document.getElementById("password-addon");

            btn_show.addEventListener("click", function() {
                if (password.type === "password") {
                    password.type = "text";
                    password_confirmation.type = "text";
                    btn_show.innerHTML = '<i class="ri-eye-off-fill align-middle"></i>';
                } else {
                    password.type = "password";
                    password_confirmation.type = "password";
                    btn_show.innerHTML = '<i class="ri-eye-fill align-middle"></i>';
                }
            });
        });
    </script>

@endsection --}}
