@extends('layouts.base-test')

@section('title', 'Kết quả')

@push('styles')
    {{-- TODO: public --}}
    <link rel="stylesheet" href="{{ asset('public/css/mock-result.css') }}">
@endpush

@section('content')
    @php
        dd("ok");
    @endphp
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
            <button class="btn-none">Kết quả luyện tập</button>
            <button class="btn-outlined">Kết quả thi thử</button>
        </div>

        <div class="accordion custom-accordion" id="resultsAccordion">
            @foreach ($resultsByAttempt as $attemptIndex => $attempt)
                <div class="mb-4 p-2 rounded shadow-sm bg-white">
                    <h5 class="result-title-box-index">
                        <img src="{{ asset('public/icon/result/result.svg') }}" style="width: 32px;" alt="ICon">
                        <strong>Lần thi {{ count($resultsByAttempt) - $attemptIndex }}</strong>
                    </h5>

                    @foreach ($attempt['results'] as $index => $result)
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <div class="test-title">{!! $result['title'] !!}</div>
                                </div>
                            </div>
                            @if ($result['slug'] !== 'n400')
                                <span class="mx-2 font-md {{ $result['is_passed'] ? 'text-success' : 'text-danger' }}">
                                    {{ $result['correct'] }}/{{ $result['total'] }}
                                </span>
                            @else
                                @php
                                    $numberOfTest = count($resultsByAttempt) - $attemptIndex;
                                    $url =
                                        route('result.detail', ['attemptId' => $attempt['attempt_id']]) .
                                        '?numberOfTest=' .
                                        $numberOfTest;
                                @endphp

                                <a href="{{ $url }}" class="result-link">
                                    Xem lại câu
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

@endsection
