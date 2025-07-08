@extends('layouts.app')

@section('content')
    <!-- Nhúng file CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/study.css') }}">

    <div id="wp-star" class="container mt-4">

        {{-- Header --}}
        <div class="wp-header d-flex align-items-center mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}" title="Quay về trang chủ" style="width: 42px; height: 42px;">
                    <img style="width: 50px; height: 50px;" src="{{ url('public/icon/Icon-back-home.svg') }}" alt="">
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="heading-module text-2xl font-bold text-gray-800">Tài liệu học tập</h3>
                <span class="sub-heading">{{ $section['title'] }}</span>
            </div>
        </div>

        {{-- Nút Quay lại --}}
        <a href="javascript:history.back()" class="back-button mb-4 d-inline-flex align-items-center">
            <div class="back-icon"><i class="bi bi-arrow-left-short"></i></div>
            <span class="back-text">Quay lại</span>
        </a>

        {{-- Danh sách tài liệu/video --}}
        <div class="list-video-box">
            @foreach ($section['materials'] as $item)
                <a href="{{ $item['link'] }}" target="_blank" class="text-decoration-none d-block">
                    <div class="video-box">
                        <div class="video-thumbnail">
                            <img src="{{ url($item['thumbnail']) }}" alt="Video thumbnail" />
                        </div>
                        <div class="video-info">
                            <div class="video-label">
                                <img src="{{ url('public/icon/study/' . ($item['icon'] ?? 'icon-video-thumbnail.svg')) }}"
                                    alt="Video icon" />
                                <span>{{ ucfirst($item['type'] ?? 'video') }}</span>
                            </div>
                            <div class="video-title">{{ $item['title'] }}</div>
                            @if (!empty($item['subtitle']))
                                <div class="video-subtitle">{{ $item['subtitle'] }}</div>
                            @endif
                        </div>
                        <div class="video-arrow">
                            <i class="bi bi-arrow-right-short"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
