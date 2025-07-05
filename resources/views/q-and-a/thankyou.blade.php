@extends('layouts.base-test')

@section('title', 'Hoàn thành N400')

@section('content')
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}"><img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" /></a>
            <h1 class="header-title">
                THANK YOU<br>
            </h1>
        </div>
    </div>

    <main class="main-content">
        <div class="prepare-card">
            <img src="{{ asset('public/icon/n400/n400-completed.svg') }}" alt="N400 Completed" class="prepare-icon" />

            <p class="text-center text-muted mb-2 font-sm">Cảm ơn bạn đã gửi phản hồi!</p>

            <div class="font-md mt-3">
                Chúng tôi sẽ xử lý phản hồi trong thời gian sớm nhất.
            </div>
        </div>
    </main>

    <div class="test-footer">
        <div class="text-center mt-5">
            <div class="mt-2">
                <a class="text-decoration-none font-md home-link" href="{{ route('home') }}">Về trang chủ</a>
            </div>
        </div>
    </div>
@endsection
