@extends('layouts.base-test')

@section('title', 'Kết quả')

@push('styles')
    {{-- TODO: public --}}
    <link rel="stylesheet" href="{{ asset('public/css/mock-result.css') }}">
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


    <main class="main-content">
        <div class="btn-group">
            <a href="{{ route('result.index') }}" class="btn-outlined">Kết quả luyện tập</a>
            <a href="{{ route('result.mock-test') }}" class="btn-none">Kết quả thi thử</a>
        </div>

        @if (isset($totalQuestions))
            <div class="result-box mb-4">
                <div class="result-header">
                    <img src="{{ url('public/icon/home/Icon-civics.svg') }}" alt="icon" />
                    <div>
                        <h3 class="font-sm font-semibold">Civics Test</h3>
                        <p>Kiểm tra công dân</p>
                    </div>
                </div>
                <div class="result-body">
                    <div class="result-left">
                        <div class="d-flex justify-content-between">
                            <span class="label">Tổng số câu</span>
                            <span class="value font-bold">{{ $totalQuestions }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="label">Câu đúng</span>
                            <span class="value correct text-green-600">{{ $totalCorrect }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="label">Câu sai</span>
                            <span class="value incorrect text-red-500">{{ $totalIncorrect }}</span>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="result-right text-center">
                        <div class="label">Độ chính xác</div>
                        <div class="accuracy text-green-700 font-bold text-xl">{{ $accuracy }}%</div>
                    </div>
                </div>
            </div>
        @elseif(isset($message))
            <p class="text-gray-500 text-center">{{ $message }}</p>
        @endif

    </main>

@endsection
