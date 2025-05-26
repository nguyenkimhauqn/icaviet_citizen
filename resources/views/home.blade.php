@extends('layouts.app')

@section('content')
    <!-- Nhúng file CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Header -->
            <div class="container text-center mt-4">
                <div class="section-title"> Luyện thi quốc tịch Mỹ </div>
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
                        <a href="{{ route('writing.show') }}">
                            <div class="feature-card">
                                <div class="feature-icon">✍️</div>
                                KIỂM TRA VIẾT
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('reading.show') }}">
                            <div class="feature-card">
                                <div class="feature-icon">🎙️</div>
                                KIỂM TRA ĐỌC
                            </div>
                        </a>
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
                        <a href=" {{ route('n400.categories.index') }} ">
                            <div class="feature-card">
                                <div class="feature-icon">💬</div>
                                PHỎNG VẤN & N400
                            </div>
                        </a>
                    </div>

                    <!-- 4 -->
                    <div class="col-4">
                        <a href=" {{ route('civics.results.index')}} ">
                            <div class="feature-card">
                                <div class="feature-icon">📊</div>
                                KẾT QUẢ
                            </div>
                        </a>
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
