@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ URL('public/css/results.css') }}">
    <div class="container py-5">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-end mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('civics.results.index') }}"
                    class="btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center"
                    title="Quay về trang chủ" style="width: 48px; height: 48px;">
                    <i class="bi bi-arrow-left-circle-fill fs-3"></i>
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="text-2xl font-bold text-gray-800"> Chi tiết bài kiểm tra</h3>
            </div>
        </div>

        @foreach ($quizQuestions as $item)
            @php
                $question = $item->question;
                $answers = $question->answers;
                $selected = $item->user_answer_id;
                $correctId = $answers->firstWhere('is_correct', true)?->id;
                $isCorrect = $item->is_correct;
                $isStarred = in_array($question->id, $starredIds);
            @endphp

            <div class="mb-4 p-3 border rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="fw-bold">
                        {{ $loop->iteration }}. {{ $question->content }}
                        @if ($isStarred)
                            <span class="text-warning ms-2">⭐</span>
                        @endif
                    </div>
                    <div class="badge {{ $isCorrect ? 'bg-success' : 'bg-danger' }}">
                        {{ $isCorrect ? 'ĐÚNG' : 'SAI' }}
                    </div>
                </div>

                <ul class="list-group mt-3">
                    @foreach ($answers as $ans)
                        @php
                            $isUserAnswer = $ans->id == $selected;
                            $isAnswerCorrect = $ans->is_correct;
                            $class = 'list-group-item';

                            if ($isUserAnswer && $isAnswerCorrect) {
                                $class .= ' list-group-item-success';
                            } elseif ($isUserAnswer && !$isAnswerCorrect) {
                                $class .= ' list-group-item-danger';
                            } elseif (!$isUserAnswer && $isAnswerCorrect) {
                                $class .= ' list-group-item-success text-muted';
                            }
                        @endphp
                        <li class="{{ $class }}">
                            @if ($isUserAnswer)
                                <strong>🟢</strong>
                            @endif
                            {{ $ans->content }}
                            @if ($isAnswerCorrect && !$isUserAnswer)
                                <span class="ms-2">(Đáp án đúng)</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
