@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Nhúng file CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
    <div class="banner">
        <img src="{{ url('public/banners/banner-vi-nguoi-viet.png') }}" id="banner-home" class="img-fluid w-100"
            alt="banner-home">
    </div>
    <div class="wp-menu">
        <div class="row justify-content-center">
            <!-- Grid chức năng -->
            <div class="container-home">
                <div class="row g-3">
                    <!-- 1. Civics Test -->
                    <div class="col-4">
                        <a href="{{ route('civics.form') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/Icon-civics.svg') }}" alt="icon-civics">
                                </div>
                                <span class="title_en">Civics Test</span>
                                <span class="title_vn">Kiểm tra công dân</span>
                            </div>
                        </a>
                    </div>

                    <!-- 2. Writing Test -->
                    <div class="col-4">
                        <a href="{{ route('writing.show') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/Icon-writing.svg') }}" alt="icon-writing">
                                </div>
                                <span class="title_en">Writing Test</span>
                                <span class="title_vn">Kiểm tra viết</span>
                            </div>
                        </a>
                    </div>

                    <!-- 3. Reading Test -->
                    <div class="col-4">
                        <a href="{{ route('reading.show') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/icon-reading.svg') }}" alt="icon-reading">
                                </div>
                                <span class="title_en">Reading Test</span>
                                <span class="title_vn">Kiểm tra đọc</span>
                            </div>
                        </a>
                    </div>

                    <!-- 4. Mock Test -->
                    <div class="col-4">
                        <a href="{{ route('mock-test.list') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/icon-moctest.svg') }}" alt="icon-mocktest">
                                </div>
                                <span class="title_en">Mock Test</span>
                                <span class="title_vn">Thi thử</span>
                            </div>
                        </a>
                    </div>

                    <!-- 5. N-400 & Speaking -->
                    <div class="col-4">
                        <a href="{{ route('n400.categories.index') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/Icon-n400.svg') }}" alt="icon-n400">
                                </div>
                                <span class="title_en">N-400 & Speaking</span>
                                <span class="title_vn">N400 & Nói</span>
                            </div>
                        </a>
                    </div>

                    <!-- 6. Results -->
                    <div class="col-4">
                        <a href="{{ route('result.mock-test') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/icon-result.svg') }}" alt="icon-result">
                                </div>
                                <span class="title_en">Results</span>
                                <span class="title_vn">Kết quả</span>
                            </div>
                        </a>
                    </div>

                    <!-- 7. Vocabulary -->
                    <div class="col-4">
                        <a href="{{ route('vocabulary.index') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/icon-vocabulary.svg') }}" alt="icon-vocabulary">
                                </div>
                                <span class="title_en">Vocabulary</span>
                                <span class="title_vn">Từ vựng</span>
                            </div>
                        </a>
                    </div>

                    <!-- 8. Study Materials -->
                    <div class="col-4">
                        <a href="{{route('study_materials.index')}}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/icon-study.png') }}" alt="icon-study">
                                </div>
                                <span class="title_en">Study Materials</span>
                                <span class="title_vn">Tài liệu học tập</span>
                            </div>
                        </a>
                    </div>

                    <!-- 9. Starred Questions -->
                    <div class="col-4">
                        <a href="{{ route('star.category') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/icon-star.png') }}" alt="icon-star">
                                </div>
                                <span class="title_en">Starred Questions</span>
                                <span class="title_vn">Câu hỏi gắn sao</span>
                            </div>
                        </a>
                    </div>

                    <!-- 10. Q & A -->
                    <div class="col-4">
                        <a href="{{ route('qa.index') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/icon-qa.svg') }}" alt="icon-star">
                                </div>
                                <span class="title_en">Q & A</span>
                                <span class="title_vn">Hỏi & đáp</span>
                            </div>
                        </a>
                    </div>

                    <!-- 11. Chia sẻ kinh nghiệm -->
                    <div class="col-4">
                        <a href="{{ route('sharing.index') }}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/icon-chia-se-kinh-nghiem.svg') }}" alt="icon-star">
                                </div>
                                <span class="title_en">Chia sẻ kinh nghiệm</span>
                            </div>
                        </a>
                    </div>

                    <!-- 12. Dân biểu -->
                    <div class="col-4">
                        <a href="{{route('representative.form')}}">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <img src="{{ asset('public/icon/home/icon-dai-dien.svg') }}" alt="icon-star">
                                </div>
                                <span class="title_en">Your Representatives</span>
                                <span class="title_vn bage bage-primary">Dân biểu của bạn</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
