@extends('layouts.app')
@section('content')
    <!-- Nhúng file CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/study.css') }}">

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
                <h3 class="heading-module text-2xl font-bold text-gray-800"> Tài liệu học tập</h3>
                <span class="quiz-sub"> Study Materials </span>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        {{-- Banner Image --}}
        <div class="banner-civics mb-3">
            <img src="{{ url('public/banners/banner-hoc-tap.png') }}" class="img-fluid w-100 rounded" alt="banner">
        </div>

        <div class="list-group quiz-menu">
            <a href="{{ route('study_materials.show', ['type' => 'guild']) }}"
                class="list-group-item quiz-item border rounded shadow-sm d-flex align-items-center">
                {{-- <div class="quiz-icon text-danger"> <i class="bi bi-file-earmark-text-fill"> </i></div> --}}
                <div class="quiz-icon text-danger"> <img src="{{ url('public/icon/home/icon-study.png') }}" alt="">
                </div>
                <div class="quiz-text ms-3">
                    <span class="quiz-title"> Hướng dẫn thi </span>
                </div>
                <div class="ms-auto"><i class="bi bi-chevron-right"></i></div>
            </a>

            <a href="{{ route('study_materials.show', ['type' => 'civics']) }}"
                class="list-group-item quiz-item border rounded shadow-sm d-flex align-items-center">
                <div class="quiz-icon text-warning"> <img src="{{ url('public/icon/home/Icon-civics.svg') }}"
                        alt=""> </div>
                <div class="quiz-text ms-3">
                    <span class="quiz-title"> Tài liệu Civics </span>
                    <span class="quiz-sub"> (Công dân)</span>
                </div>
                <div class="ms-auto"><i class="bi bi-chevron-right"></i></div>
            </a>

            <a href="{{ route('study_materials.show', ['type' => 'reading-writing']) }}"
                class="list-group-item quiz-item border rounded shadow-sm d-flex align-items-center">
                <div class="quiz-icon text-primary"><img src="{{ url('public/icon/home/icon-reading.svg') }}"
                        alt=""> </div>
                <div class="quiz-text ms-3">
                    <span class="quiz-title"> Tài liệu Reading </span>
                    <span class="quiz-sub">(Đọc) và</span>
                    <span class="quiz-title"> Writing </span>
                    <span class="quiz-sub"> (Viết)</span>
                </div>
                <div class="ms-auto"><i class="bi bi-chevron-right"></i></div>
            </a>

        </div>

        {{-- <div class="practice-button-container">
            <a href="#" class="practice-button">Luyện tập tất cả</a>
        </div> --}}
    </div>
@endsection
