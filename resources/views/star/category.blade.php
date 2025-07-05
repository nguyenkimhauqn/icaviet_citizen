@extends('layouts.app')
@section('content')
    <!-- Nhúng file CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/star.css') }}">

    <div id="wp-star" class="container mt-4">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-center mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}" class="" title="Quay về trang chủ" style="width: 42px; height: 42px;">
                    <img style="width: 50px; height: 50px;" src="{{ url('public/icon/Icon-back-home.svg') }}"
                        alt="">
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="heading-module text-2xl font-bold text-gray-800"> Câu hỏi gắn sao </h3>
            </div>
        </div>

        {{-- Banner Image --}}
        <div class="banner-civics mb-3">
            <img src="{{ url('public/banners/banner-starred.png') }}" class="img-fluid w-100 rounded" alt="banner">
        </div>

        <div class="list-group quiz-menu">
            <a href="{{route('civics.starred')}}" class="list-group-item quiz-item border rounded shadow-sm d-flex align-items-center">
                {{-- <div class="quiz-icon text-danger"> <i class="bi bi-file-earmark-text-fill"> </i></div> --}}
                <div class="quiz-icon text-danger"> <img src="{{ url('public/icon/home/Icon-civics.svg') }}" alt=""> </div>
                <div class="quiz-text ms-3">
                    <span class="quiz-title">Civics Test</span>
                    <span class="quiz-sub">(Bài thi công dân)</span>
                </div>
                <div class="ms-auto"><i class="bi bi-chevron-right"></i></div>
            </a>

            <a href="{{route('reading.starred')}}" class="list-group-item quiz-item border rounded shadow-sm d-flex align-items-center">
                <div class="quiz-icon text-warning"> <img src="{{ url('public/icon/home/icon-reading.svg') }}" alt="">  </div>
                <div class="quiz-text ms-3">
                    <span class="quiz-title">Reading Test</span>
                    <span class="quiz-sub">(Bài thi đọc)</span>
                </div>
                <div class="ms-auto"><i class="bi bi-chevron-right"></i></div>
            </a>

            <a href="{{route('writing.starred')}}" class="list-group-item quiz-item border rounded shadow-sm d-flex align-items-center">
                <div class="quiz-icon text-primary"><img src="{{ url('public/icon/home/Icon-writing.svg') }}" alt=""> </div>
                <div class="quiz-text ms-3">
                    <span class="quiz-title">Writing Test</span>
                    <span class="quiz-sub">(Bài thi viết)</span>
                </div>
                <div class="ms-auto"><i class="bi bi-chevron-right"></i></div>
            </a>

            <a href="{{route('n400.categories.starred')}}" class="list-group-item quiz-item border rounded shadow-sm d-flex align-items-center">
                <div class="quiz-icon text-orange"> <img src="{{ url('public/icon/home/Icon-n400.svg') }}" alt="">  </div>
                <div class="quiz-text ms-3">
                    <span class="quiz-title">N-400 & Speaking</span>
                    <span class="quiz-sub">(N-400 và nói)</span>
                </div>
                <div class="ms-auto"><i class="bi bi-chevron-right"></i></div>
            </a>
        </div>

        {{-- <div class="practice-button-container">
            <a href="#" class="practice-button">Luyện tập tất cả</a>
        </div> --}}
    </div>
@endsection
