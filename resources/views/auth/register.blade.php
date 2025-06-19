@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <div class="login-wrapper text-center" style="min-height: 100vh;">
            <div class="login-card text-start">
                <h3 class="fw-bold text-start mb-4">Đăng ký</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-body">
                        {{-- Họ và tên --}}
                        <div class="mb-3">
                            <input type="text" name="name" placeholder="Họ và tên" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required autofocus>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="Nhập email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mật khẩu --}}
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Nhập mật khẩu" id="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Xác nhận mật khẩu --}}
                        <div class="mb-4">
                            <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu"
                                id="password-confirm" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-footer">
                        {{-- Nút đăng ký --}}
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .form-control {
            background-color: #F8F7FB !important;
            height: 50px !important;
            border: none !important;
        }

        .btn-primary {
            color: #fff;
            padding: 10px 30px 10px 30px;
            background-color: #1247BB;
            border-color: #1247BB;
            font-size: 20px;
        }

        .login-card {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 30px 20px;
        }
        .form-body {
            flex: 1 1 auto;
        }
        .form-footer {
            margin-top: auto;
        }
    </style>
@endsection
