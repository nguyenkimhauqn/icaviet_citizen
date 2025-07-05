@extends('layouts.base-test')

@section('title', 'Q&A (Hỏi & Đáp)')

@push('styles')
    {{-- TODO: public --}}
    <link rel="stylesheet" href="{{ asset('publiccss/mock-result.css') }}">
    <link rel="stylesheet" href="{{ asset('publiccss/q-and-a.css') }}">

    <style>
        .container {
            padding: 0;
            background: #fff;
        }
    </style>
@endpush

@section('content')
    <main class="main-content">
        <div class="form-wrapper">
            <div class="form-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('public/icon/icon.svg') }}" alt="ICAVIET" class="logo">
                    </a>
                    <a href="{{ route('qa.index') }}" class="close-btn">
                        <img src="{{ asset('public/icon/q-and-a/close.svg') }}" alt="Close">
                    </a>
                </div>
                <p class="form-title">Gửi phản hồi</p>
            </div>

            <form class="contact-form" method="POST" action="{{ route('qa.send') }}" enctype="multipart/form-data">
                @csrf

                <label>Họ và tên</label>
                <input type="text" name="name" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Tiêu đề</label>
                <input type="text" name="subject" required>

                <label>Nội dung</label>
                <textarea name="message" rows="4" required></textarea>

                <div class="form-footer">
                    <label class="upload-btn d-flex align-items-center gap-2">
                        <img src="{{ asset('public/icon/q-and-a/image.svg') }}" alt="Upload">
                        <input type="file" name="attachment" hidden>
                        <span class="upload-text">Đính kèm hình ảnh</span>
                    </label>

                    <button type="submit" class="submit-btn">Gửi
                        <img src="{{ asset('public/icon/q-and-a/arrow-right.svg') }}" alt="">

                    </button>
                </div>
            </form>
        </div>
    </main>

@endsection

@push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
@endpush
