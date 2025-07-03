@extends('layouts.base-test')

@section('title', 'Kết quả')

@push('styles')
    {{-- TODO: public --}}
    <link rel="stylesheet" href="{{ asset('css/mock-result.css') }}">
@endpush

@section('content')

    <!-- Header -->
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}">
                <img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" />
            </a>
            <h1 class="header-title" style="margin-bottom: 0px;">
                KẾT QUẢ
            </h1>
        </div>
    </div>

    <div class="main-content">
        <div class="btn-group">
            <button class="btn-outlined">Kết quả luyện tập</button>
            <span class="btn-none">Kết quả thi thử</span>
        </div>

        <div class="accordion custom-accordion" id="resultsAccordion">
            @foreach ($results as $index => $result)
                <div class="accordion-item mb-3">
                    <div id="collapse{{ $index }}" class="accordion-collapse show"
                        aria-labelledby="heading{{ $index }}" data-bs-parent="#resultsAccordion">
                        <div class="accordion-body">
                            <h5 class="result-title-box">
                                <div class="result-title-box-inner">
                                    <img src="{{ asset('public/icon/result/result.svg') }}" style="width: 32px;"
                                        alt="ICon">
                                    <strong>Lần thi 1</strong>
                                </div>
                            </h5>
                            @if (!empty($result['details']))
                                @foreach ($result['details'] as $categoryName => $group)
                                    <div class="result-part">
                                        <h5 class="part-text">{{ $categoryName }}</h5>
                                        @if (!empty($group['category_name_vn']))
                                            <h5 class="part-text">{{ $group['category_name_vn'] }}</h5>
                                        @endif
                                    </div>

                                    @foreach ($group['questions'] as $detail)
                                        <div class="p-3 bg-light result-card">
                                            <div class="font-sm question-box">
                                                {!! $detail['question'] !!}
                                                @if ($detail['vietnamese_question'])
                                                    <p class="font-very-sm-italic mb-1">Dịch: {!! $detail['vietnamese_question'] !!}</p>
                                                @endif
                                            </div>

                                            <div class="answer-box">
                                                @if ($result['slug'] !== 'civics')
                                                    <p class="font-sm">Câu trả lời của bạn:
                                                        <strong>{{ $detail['user_answer'] }}</strong>
                                                    </p>
                                                @elseif ($detail['is_correct'])
                                                    <div class="d-flex align-items-center gap-2 font-sm">
                                                        <img src="{{ asset('public/icon/mockTests/success.svg') }}"
                                                            alt="Success">
                                                        <p class="text-success m-0">{{ $detail['user_answer'] }}</p>
                                                    </div>
                                                    @if ($detail['vietnamese_correct_answer'])
                                                        <p class="font-very-sm-italic mt-1">Dịch:
                                                            {{ $detail['vietnamese_correct_answer'] }}
                                                        </p>
                                                    @endif
                                                    @if ($detail['pronunciation_suggest_answer'])
                                                        <p class="font-sm"><strong>Phát âm dễ nhớ: </strong>
                                                            {{ $detail['pronunciation_suggest_answer'] }}
                                                        </p>
                                                    @endif
                                                @else
                                                    <div class="d-flex align-items-center gap-2 mb-2 font-sm">
                                                        <img src="{{ asset('public/icon/mockTests/error.svg') }}"
                                                            alt="Error">
                                                        <p class="text-danger m-0">{{ $detail['user_answer'] }}</p>
                                                    </div>

                                                    <div class="d-flex align-items-center gap-2 font-sm">
                                                        <img src="{{ asset('public/icon/mockTests/success.svg') }}"
                                                            alt="Success">
                                                        <p class="text-success m-0">{{ $detail['correct_answer'] }}</p>
                                                    </div>
                                                    @if ($detail['vietnamese_correct_answer'])
                                                        <p class="font-very-sm-italic">Dịch:
                                                            {{ $detail['vietnamese_correct_answer'] }}
                                                        </p>
                                                    @endif
                                                    @if ($detail['pronunciation_suggest_answer'])
                                                        <p class="font-sm"><strong>Phát âm dễ nhớ: </strong>
                                                            {{ $detail['pronunciation_suggest_answer'] }}
                                                        </p>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @else
                                <div class="text-muted">Không có câu hỏi nào trong phần thi này.</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="test-footer">
            <div class="text-center mt-5">
                <a href="{{ route('mock-test.list') }}" class="btn btn-normal px-5 py-2">
                    Tiếp tục làm bài thi thử
                </a>
                <div class="mt-2">
                    <a class="text-decoration-none font-md home-link" href="{{ route('home') }}">Về trang chủ</a>
                </div>
            </div>
        </div>
    @endsection
