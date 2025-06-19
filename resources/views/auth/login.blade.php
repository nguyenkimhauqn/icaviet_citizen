@extends('layouts.app')

@section('content')
    <div class="container-mobile row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">

            {{-- Logo và banner --}}
            <div class="card-head text-center banner-wrapper">
                <img src="{{ asset('public/banners/banner-login.png') }}" alt="Banner" class="img-fluid">
            </div>

            <div class="card card-body">
                <h3 class="text-start mb-4 font-weight-bold">Đăng nhập</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="form-group mb-3">
                        <input id="email" type="email" placeholder="Nhập email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mật khẩu --}}
                    <div class="form-group mb-3">
                        <input id="password" type="password" placeholder="Nhập mật khẩu"
                            class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Remember + Quên mật khẩu --}}
                    <div class="form-group d-flex justify-content-between align-items-center mb-4">
                        <!-- Bên trái: checkbox + label -->
                        <div class="d-flex align-items-center">
                            <input type="checkbox" name="remember" id="remember" class="checkbox-scaled me-2">
                            <label for="remember" class="mb-0">Ghi nhớ đăng nhập</label>
                        </div>

                        <!-- Bên phải: link quên mật khẩu -->
                        <div class="d-flex align-items-center">
                            <a href="{{ route('password.request') }}" class="mb-0">Quên mật khẩu?</a>
                        </div>
                    </div>

                    {{-- Nút đăng nhập --}}
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary w-30">Đăng nhập</button>
                    </div>

                    {{-- Link đăng ký --}}
                    <div class="text-start">
                        Bạn chưa có tài khoản?
                        <a class="register" href="{{ route('register') }}">Đăng ký ngay</a>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <style>
        .card {
            background-color: #FFFFFF;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px;
            !important;
            border: none !important;
        }

        .card .text-start {
            color: #0B0B0B !important;
        }

        .form-control {
            background-color: #F8F7FB !important;
            height: 50px !important;
            border: none !important;
        }

        .checkbox-scaled {
            transform: scale(1);
            /* ~ 16px * 1.5 = 24px */
            transform-origin: top left;
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        label {
            margin-bottom: 0px !important;
        }

        .btn-primary {
            color: #fff;
            padding: 10px 30px 10px 30px;
            background-color: #1247BB;
            border-color: #1247BB;
        }

        .forget-password {
            color: #0B0B0B;
            font-weight: 600;
        }

        .register {
            color: #1247BB;
            font-weight: 600;
        }

        .navbar-light .navbar-toggler-icon {
            background-image: url('public/icon/align-justify.svg') !important;
            background-size: contain;
            background-repeat: no-repeat;
        }

        .navbar-light .navbar-toggler {
            border: none !important;
        }

        .img-fluid {
            width: 100%;
            height: auto;
        }
    </style>
@endsection
