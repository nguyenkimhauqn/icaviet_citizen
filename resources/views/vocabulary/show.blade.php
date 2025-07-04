@extends('layouts.base-test')

@section('title', 'Hoàn thành N400')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/vocabulary.css') }}">

    <style>
        .container {
            padding: 0;
        }
    </style>
@endpush

@section('content')
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}"><img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" /></a>
            <h1 class="header-title">
                TỪ VỰNG<br>
            </h1>
        </div>
    </div>

    <main class="main-content">
        <div class="vocab-search-section">
            <div class="vocab-search-image">
                <img src="{{ asset('icon/vocabulary/hero.png') }}" alt="Vocabulary Banner">
            </div>

            <div class="vocab-search-box">
                <div class="search-input-wrapper">
                    <input type="text" placeholder="Tìm kiếm từ vựng" />
                    <a class="search-btn">
                        <img src="{{ asset('icon/vocabulary/search.svg') }}" alt="Search">
                    </a>
                </div>

                <div class="vocab-page">
                    <!-- Header tabs -->
                    <div class="vocab-tabs">
                        <a href="#" class="active">Tổng quan</a>
                        <a href="#">12 tháng</a>
                        <a href="#">Ngày lễ</a>
                        <a href="#">Tên gọi</a>
                        <a href="#">Chính phủ</a>
                        <!-- thêm tùy ý -->
                    </div>

                    <!-- Info alert -->
                    <div class="warning-container mb-2">
                        <div class="mt-3 font-sm text-muted p-3 rounded shadow-sm"
                            style="background: #f9f9fc; border-left: 4px solid #BF0C2C;">
                            <div class="d-flex align-start gap-2 text-dark font-sm" style="color: #BF0C2C;">
                                <img src="{{ asset('public/icon/q-and-a/warning.svg') }}" alt="Warning">

                                <span class="note-text">Các từ vựng thường xuất hiện trong bài thi quốc tịch</span>
                            </div>
                        </div>
                    </div>

                    <div class="vocab-wrapper">
                        <!-- A-Z sidebar -->
                        <div class="vocab-sidebar">

                            @foreach (range('A', 'Z') as $char)
                                <a href="#"
                                    onclick="scrollToLetter('{{ $char }}'); return false;">{{ $char }}</a>
                            @endforeach

                        </div>

                        <!-- Main content -->
                        <div class="vocab-list">
                            @foreach ($vocabulariesGroupedByLetter as $letter => $items)
                                <div id="letter-{{ $letter }}">
                                    <h2 class="vocab-letter">{{ $letter }}</h2>
                                    @foreach ($items as $vocab)
                                        <div class="vocab-card">
                                            <div class="vocab-header">
                                                <div><strong>{{ $vocab->word }}:</strong> {{ $vocab->meaning }}</div>
                                                <button class="speak-btn">
                                                    <img src="{{ asset('icon/vocabulary/audio.svg') }}" alt="Audio">
                                                </button>
                                            </div>
                                            @if ($vocab->hint)
                                                <div class="vocab-hint">Phát âm dễ nhớ: <i>{{ $vocab->hint }}</i></div>
                                            @endif
                                            @if ($vocab->example)
                                                <div class="vocab-example">Ví dụ: <em>{{ $vocab->example }}</em></div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection

@push('scripts')
    <script>
        function scrollToLetter(letter) {
            const container = document.querySelector('.vocab-list');
            const target = document.getElementById('letter-' + letter);
            if (container && target) {
                container.scrollTo({
                    top: target.offsetTop - container.offsetTop,
                    behavior: 'smooth'
                });
            }
        }
    </script>
@endpush
