@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ URL('public/css/results.css') }}">
    <div class="container py-4">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-end mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}"
                    class="btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center"
                    title="Quay về trang chủ" style="width: 48px; height: 48px;">
                    <i class="bi bi-arrow-left-circle-fill fs-3"></i>
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="text-2xl font-bold text-gray-800 text-center"> KẾT QUẢ </h3>
            </div>
        </div>
        {{-- <h1 class="text-center mb-4">📊 KẾT QUẢ</h1> --}}

        {{-- <div class="d-flex justify-content-around text-center mb-4">
        <div>
            <div class="circular-chart red">
                <span class="display-4">{{ $average }}%</span>
            </div>
            <p class="text-muted mt-2">ĐIỂM TRUNG BÌNH</p>
        </div>
        <div>
            <div class="circular-chart">
                <span class="display-4">{{ $challengeCount }}</span>
            </div>
            <p class="text-muted mt-2">ĐIỂM THỬ THÁCH</p>
        </div>
    </div> --}}

        @foreach ($quizzes as $quiz)
            @php
                $percent =
                    $quiz->total_questions > 0 ? round(($quiz->correct_answers / $quiz->total_questions) * 100) : 0;

                $isPassed = $percent >= 60;
            @endphp

            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="text-start">
                        <a href="{{ route('civics.results.show', $quiz->id) }}">
                            <h5 class="mb-1">Bài kiểm tra <span class="text-primary"> {{ $quiz->correct_answers }} </span>
                                /
                                {{ $quiz->total_questions }} Câu hỏi</h5>
                            <small class="text-muted">{{ $quiz->created_at->format('D, M d, Y h:i A') }}</small>
                        </a>
                    </div>

                    <div class="text-end">
                        <div class="mb-2">
                            <span class="badge {{ $isPassed ? 'bg-success' : 'bg-danger' }}">
                                {{ $percent }}%
                            </span>
                        </div>
                        <div>
                            {{-- <span class="me-2 badge text-success">👍 {{ $quiz->correct_count }}</span>
                        <span class="me-2 text-danger">👎 {{ $quiz->wrong_count }}</span> --}}
                            <a href="{{ route('civics.results.show', $quiz->id) }}"
                                class="btn btn-sm btn-outline-secondary">
                                ➤
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
