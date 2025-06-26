@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="mb-4 display-4 font-weight-bold">Kết quả bài kiểm tra</h1>

            <div class="h3 mb-4">
                {{ $quiz->correct_answers }} / {{ $quiz->total_questions }} câu đúng
            </div>

            @if (($quiz->correct_answers / $quiz->total_questions) >= 0.6)
                <div class="alert alert-success py-4">
                    <h2 class="mb-0">🎉 Chúc mừng, bạn đã <strong>ĐẬU</strong>!</h2>
                </div>
            @else
                <div class="alert alert-danger py-4">
                    <h2 class="mb-0">😢 Rất tiếc, bạn đã <strong>RỚT</strong>.</h2>
                </div>
            @endif

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Về trang chủ</a>
                @php
                    $retryRoute = $mode === 'show' ? route('civics.show') : route('civics.starred');
                @endphp
                <a href="{{ $retryRoute  }}" class="btn btn-success btn-lg">Làm lại bài kiểm tra</a>
            </div>
        </div>
    </div>
</div>
@endsection
