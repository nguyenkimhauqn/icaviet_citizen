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

                <div class="vocab-category-buttons">
                    <a href="#" class="vocab-btn">Từ vựng chung</a>
                    <a href="#" class="vocab-btn">Từ vựng N-400</a>
                </div>
            </div>
        </div>

    </main>
@endsection
