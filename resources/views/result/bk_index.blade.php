@extends('layouts.base-test')

@section('title', 'Kết quả')

@push('styles')
    {{-- TODO: public --}}
    <link rel="stylesheet" href="{{ asset('public/css/mock-result.css') }}">
@endpush

@section('content')

    <!-- Header -->
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}">
                <img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" />
            </a>
            <h1 class="header-title" style="margin-bottom: 0px;">
                KẾT QUẢ
            </h1>
        </div>
    </div>


    <main class="main-content">
        <div class="btn-group">
            <button class="btn-none">Kết quả luyện tập</button>
            <button class="btn-outlined">Kết quả thi thử</button>
        </div>

        <div class="result-box">
            <div class="result-header">
                <img src="https://cdn-icons-png.flaticon.com/512/3259/3259643.png" alt="icon" />
                <div>
                    <h3 class="font-sm">Civics Test</h3>
                    <p>Kiểm tra công dân</p>
                </div>
            </div>
            <div class="result-body">
                <div class="result-left">
                    <div class="d-flex justify-content-between">
                        <span class="label">Tổng số câu</span>
                        <span class="value">20</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="label">Câu đúng</span>
                        <span class="value correct">10</span>
                    </div>
                    <div class="d-flex justify-content-between"><span class="label">Câu sai</span>
                        <span class="value incorrect">10</span>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="result-right">
                    <div class="label">Độ chính xác</div>
                    <div class="accuracy">50%</div>
                </div>
            </div>
        </div>

        {{-- @foreach ($mockTest as $test)
            <div class="test-card">
                <img src="{{ asset('public/icon/mockTests/' . $test['slug'] . '.svg') }}" alt="{{ $test['name'] }}"
                    class="test-icon" />
                <div class="test-content">
                    <div class="flex gap-sm">
                        <h3 class="test-title">{{ $test['name'] }}</h3>
                        @if (!empty($test['vietnamese_title']))
                            <p class="test-subtitle">({{ $test['vietnamese_title'] }})</p>
                        @endif
                    </div>
                    <p class="test-progress">
                        {!! $test['note'] !!}
                    </p>
                </div>
            </div>
        @endforeach --}}

    </main>
    <!-- Start Button -->
    <div class="test-footer">
        <a class="start-button" href="{{ route('start.mock-test', 'civics') }}">Bắt đầu thi</a>
    </div>
@endsection
