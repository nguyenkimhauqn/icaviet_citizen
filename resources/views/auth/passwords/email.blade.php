@extends('layouts.app')

@section('content')
<div class="container pt-4">
    <div class="d-flex flex-column justify-content-between" style="min-height: 100vh;">
        {{-- Form nội dung --}}
        <div class="px-4">
            <h3 class="fw-bold mb-4">Đặt lại mật khẩu</h3>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <input type="email" name="email" placeholder="Địa chỉ email"
                        class="form-control bg-light p-4 border-0 @error('email') is-invalid @enderror"
                        required autofocus>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nút Gửi --}}
                <div>
                    <button type="submit" class="btn btn-primary">
                        Gửi liên kết đặt lại mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
