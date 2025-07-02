@extends('layouts.base-test')

@section('title', 'Hoàn thành N400')

@section('content')
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}"><img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" /></a>
            <h1 class="header-title">
                THI THỬ<br>
                {{-- <span class="header-subtitle">{{ $currentTest->title }}</span>

                @if ($currentTest->vietnamese_title)
                    <span class="header-subtitle-2">({{ $currentTest->vietnamese_title }})</span>
                @endif --}}
            </h1>
        </div>
    </div>

    <main class="main-content">
        <div class="prepare-card">
            <img src="{{ asset('public/icon/n400/n400-completed.svg') }}" alt="N400 Completed" class="prepare-icon" />

            <p class="text-center text-muted mb-2 font-sm">Bạn đã hoàn thành các câu hỏi trong phần N-400</p>

            <div class="font-md mt-3">
                You’re better every day!
            </div>
            <div class="font-sm">
                Bạn đang tiến bộ hơn mỗi ngày!
            </div>
        </div>
    </main>

    <div class="test-footer">
        <div class="text-center mt-5">
            <a href="{{ route('n400.categories.index') }}" class="btn btn-normal px-5 py-2">
                Tiếp tục làm phần khác
            </a>
            <div class="mt-2">
                <a class="text-decoration-none font-md home-link" href="{{ route('home') }}">Về trang chủ</a>
            </div>
        </div>
    </div>
@endsection
