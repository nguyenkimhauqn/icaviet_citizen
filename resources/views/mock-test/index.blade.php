@extends('layouts.base-test')

@section('title', 'Home Page')

@section('content')

    <!-- Header -->
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}">
                <img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" />
            </a>
            <h1 class="header-title" style="margin-bottom: 0px;">
                THI THỬ
            </h1>
        </div>
    </div>


    <main class="main-content">
        <h2 class="section-title">Yêu cầu bài thi quốc tịch</h2>

        @foreach ($mockTest as $test)
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
        @endforeach

        <!-- Warning Section -->
        <div class="warning-section">
            <div class="warning-content">
                <img src="{{ asset('public/icon/mockTests/warning.svg') }}" alt="Warning" class="warning-icon" />
                <p class="warning-text">
                    Phần thi thử được thiết kế nhằm mô phỏng gần nhất với kỳ thi thật nên sẽ không hỗ trợ tiếng Việt.
                </p>
            </div>
        </div>

    </main>
    <!-- Start Button -->
    <div class="test-footer">
        <a class="start-button" href="{{ route('start.mock-test', 'civics') }}">Bắt đầu thi</a>
    </div>
@endsection
