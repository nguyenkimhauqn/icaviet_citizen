@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/civics.css') }}">

    <div class="container mt-4">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-center mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}" title="Quay về trang chủ" style="width: 42px; height: 42px;">
                    <img style="width: 50px; height: 50px;" src="{{ url('public/icon/Icon-back-home.svg') }}" alt="">
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="heading-module text-2xl">
                    Civics Test <br> KIỂM TRA CÔNG DÂN
                </h3>
            </div>
        </div>

        {{-- Banner Image --}}
        <div class="banner-civics mb-3">
            <img src="{{ url('public/banners/banner-form-civics.png') }}" class="img-fluid w-100 rounded" alt="banner">
        </div>

        {{-- Form Chọn chế độ --}}
        <form action="{{ route('civics.show') }}" method="GET">
            <div class="civics-options-box p-4 bg-white rounded shadow-sm">
                <div class="option mb-4">
                    <label class="d-flex justify-content-between align-items-center w-100">
                        <div>
                            <div class="fw-bold">Học 10 câu ngẫu nhiên</div>
                            <small class="">Phù hợp để luyện mỗi ngày hoặc mới bắt đầu</small>
                        </div>
                        <input type="radio" name="mode" class="form-check-input" value="random10" checked>
                    </label>
                </div>

                <div class="option mb-2">
                    <label class="d-flex justify-content-between align-items-center w-100">
                        <div>
                            <div class="fw-bold">Học 100 câu</div>
                            <small class="">Phù hợp để ôn tập toàn bộ nội dung</small>
                        </div>
                    </label>
                </div>
                <div class="ps-3">
                    <label class="d-flex justify-content-between align-items-center mb-2">
                        <span>Theo thứ tự</span>
                        <input type="radio" name="mode" class="form-check-input" value="ordered">
                    </label>
                    <label class="d-flex justify-content-between align-items-center">
                        <span>Ngẫu nhiên</span>
                        <input type="radio" name="mode" class="form-check-input" value="random">
                    </label>
                </div>
            </div>

            {{-- Next Button --}}
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary rounded-circle" style="width: 56px; height: 56px;">
                    <i class="bi bi-arrow-right text-white"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
