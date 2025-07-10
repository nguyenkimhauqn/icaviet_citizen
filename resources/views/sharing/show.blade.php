@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ url('public/css/sharing.css') }}">

    <div class="container my-5 bg-white p-4 rounded shadow-sm">


        {{-- Header --}}
        <div class="wp-header d-flex align-items-center">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}" class="" title="Quay về trang chủ" style="width: 42px; height: 42px;">
                    <img style="width: 50px; height: 50px;" src="{{ url('public/icon/Icon-back-home.svg') }}" alt="">
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="heading-module text-2xl font-bold text-gray-800"> CHIA SẺ KINH NGHIỆM </h3>
            </div>
        </div>

        {{-- Nút quay lại --}}
        <div class="mb-3 mt-3">
            <a href="{{ route('sharing.index') }}" class="text-decoration-none text-secondary">
                <i class="bi bi-arrow-left-circle"></i> Quay lại danh sách
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success small mb-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tiêu đề bài --}}
        <h2 class="fw-bold text-dark mb-2">{{ $question->title }}</h2>

        {{-- Meta --}}
        <div class="text-muted mb-3" style="font-size: 0.9rem;">
            Đăng bởi <strong class="text-dark">{{ $question->user->name }}</strong> •
            {{ $question->created_at->diffForHumans() }}
        </div>

        {{-- Tags --}}
        <div class="mb-4">
            @foreach ($question->tags as $tag)
                <span class="badge bg-light text-dark border me-1 mb-1">{{ $tag->name }}</span>
            @endforeach
        </div>

        {{-- Nội dung --}}
        <div class="article-content mb-5" style="line-height: 1.8; font-size: 1rem; color: #333;">
            {!! nl2br(e($question->content)) !!}
        </div>

        {{-- Nội dung bình luận --}}
        @forelse($question->comments as $comment)
            <div class="border-top pt-3 mt-3">
                <div class="d-flex justify-content-between">
                    <strong>{{ $comment->user->name }}</strong>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <div class="text-dark mt-1" style="font-size: 0.95rem;">{{ $comment->content }}</div>
            </div>
        @empty
            <p class="text-muted mt-3">Chưa có bình luận nào.</p>
        @endforelse

        {{-- Bình luận --}}
        <h5 class="border-top pt-4 mt-4 mb-3 fw-semibold text-dark">BÌNH LUẬN</h5>

        @auth
            <form action="{{ route('sharing.comment.store', $question->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                    <textarea name="content" rows="3" class="form-control" placeholder="Nhập bình luận của bạn..." required>{{ old('content') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Gửi bình luận</button>
            </form>
        @else
            <div class="alert alert-secondary py-2 text-muted small">
                Bạn cần <a href="{{ route('login') }}" class="text-decoration-underline">đăng nhập</a> để bình luận.
            </div>
        @endauth



    </div>
@endsection
