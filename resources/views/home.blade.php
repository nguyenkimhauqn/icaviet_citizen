@extends('layouts.app')

@section('content')
    <!-- Nhúng file CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Header -->
            <div class="container text-center mt-4">
                <div class="section-title">CITIZEN NOW</div>
                <div class="subtitle d-flex justify-content-center align-items-center mt-2">
                    Mở khóa các tính năng cao cấp
                    <button>CHI TIẾT</button>
                </div>
            </div>

            <!-- Logo -->
            <div class="container text-center mt-3">
                <img src="{{ asset('public/image/logo.png') }}" alt="Logo" width="120" />
            </div>

            <!-- Grid chức năng -->
            <div class="container grid-container">
                <div class="row g-3">
                    <!-- 1 -->
                    <div class="col-4">
                        <a href="{{ route('civics.show') }}">
                            <div class="feature-card">
                                <div class="feature-icon">📝</div>
                                KIỂM TRA CÔNG DÂN
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">✍️</div>
                            KIỂM TRA VIẾT
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">🎙️</div>
                            KIỂM TRA ĐỌC
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="col-4">
                        <a href="{{ route('civics.starred') }}">
                            <div class="feature-card">
                                <div class="feature-icon">⭐</div>
                                BÀI KIỂM TRA CÓ GẮN DẤU SAO
                            </div>
                        </a>
                    </div>

                    {{-- <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">📖</div>
                            TÀI LIỆU HỌC TẬP
                        </div>
                    </div> --}}
                    {{-- <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">🔁</div>
                            THẺ FLASH
                        </div>
                    </div> --}}

                    <!-- 3 -->
                    {{-- <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">🎧</div>
                            MÁY NGHE NHẠC
                        </div>
                    </div> --}}
                    <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">🎥</div>
                            VIDEO HỌC TẬP
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">💬</div>
                            PHỎNG VẤN & N400
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">📊</div>
                            KẾT QUẢ
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">🧑‍💼</div>
                            ĐẠI DIỆN CỦA BẠN
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="feature-card">
                            <div class="feature-icon">❓</div>
                            CÂU HỎI THƯỜNG GẶP
                        </div>
                    </div>

                    <!-- 5 -->
                    {{-- <div class="col-4 offset-4">
                        <div class="feature-card">
                            <div class="feature-icon">🔗</div>
                            CHIA SẺ
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
