@extends('layouts.base-test')

@section('title', 'Hoàn thành N400')

@push('styles')
    <link rel="stylesheet" href="{{ asset('public/css/vocabulary.css') }}">

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
                <img src="{{ asset('public/icon/vocabulary/hero.png') }}" alt="Vocabulary Banner">
            </div>

            <div class="vocab-search-box">
                {{-- <form method="GET" action="{{ route('vocabulary.show', ['slug' => 'general']) }}"
                    style="width: 100%; height: 100%;">
                    <input type="hidden" name="category" value="general">
                    <div class="search-input-wrapper">
                        <input type="text" name="search" placeholder="Tìm kiếm từ vựng" value="{{ request('search') }}">
                        <button type="submit" class="search-btn">
                            <img src="{{ asset('public/icon/vocabulary/search.svg') }}" alt="Search">
                        </button>
                    </div>
                </form> --}}

                <div class="vocab-category-buttons">
                    <a href="{{ route('vocabulary.show', ['slug' => 'general']) }}" class="vocab-btn">Từ vựng chung</a>
                    <a href="{{ route('vocabulary.show', ['slug' => 'n400']) }}" class="vocab-btn">Từ vựng N-400</a>

                </div>

                <!-- Info alert -->
                <div class="warning-container mb-2">
                    <div class="mt-2 font-sm text-muted p-2 rounded shadow-sm"
                        style="background: #f9f9fc; border-left: 4px solid #BF0C2C;">
                        <div class="d-flex align-start gap-2 text-dark font-sm" style="color: #BF0C2C;">
                            <img src="{{ asset('public/icon/q-and-a/warning.svg') }}" alt="Warning">

                            <span class="note-text">Các từ vựng thường xuất hiện trong bài thi quốc tịch</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
