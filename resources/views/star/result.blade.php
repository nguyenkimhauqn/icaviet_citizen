@extends('layouts.app')

@section('content')
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('public/css/result.css') }}">

    <div class="container py-5">
        <div class="test-result-container">
            <!-- Tiêu đề -->
            <h5 class="result-title text-center"> KẾT THÚC CÂU HỎI GẮN SAO </h5>

            <!-- Hình vỗ tay -->
            <div class="result-icon text-center">
                <img src="{{ url('public/icon/Clap.gif') }}" alt="Kết quả icon" />
            </div>

            <!-- Lời động viên -->
            <h3 class="encouragement-en text-center">Practice makes perfect!</h3>
            <p class="encouragement-vi text-center">Luyện tập nhiều sẽ giỏi!</p>

            <!-- Nút CTA -->


            <div class="action-buttons text-center">

                <a href="{{ route('star.category') }}" class="btn btn-primary mb-2 d-inline-block">
                    Tiếp tục làm phần khác
                </a>

                <a class="back-home mt-4 d-inline-block" href="{{ url('/') }}"
                    class="text-primary text-center d-block">Về trang
                    chủ</a>
            </div>
        </div>

    </div>
@endsection
