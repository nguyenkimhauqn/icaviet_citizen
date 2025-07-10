@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ url('public/css/sharing.css') }}">

    <div class="container max-w-2xl mx-auto px-4">
        <div class="box-stick">
            {{-- Header --}}
            <div class="wp-header d-flex align-items-center">
                <div class="btn-home mr-2">
                    <a href="{{ route('home') }}" class="" title="Quay về trang chủ" style="width: 42px; height: 42px;">
                        <img style="width: 50px; height: 50px;" src="{{ url('public/icon/Icon-back-home.svg') }}"
                            alt="">
                    </a>
                </div>
                <div class="flex justify-between items-center header-civics">
                    <h3 class="heading-module text-2xl font-bold text-gray-800"> CHIA SẺ KINH NGHIỆM </h3>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}

                </div>
            @endif
            <div class="header-filter pt-4 pb-4">
                <div class="filler-search">
                    <a href="{{ route('sharing.create') }}" class="ask-box">
                        Bạn muốn đặt câu hỏi
                    </a>
                    <span class="icon-search">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
                <form method="GET" class="mb-4 mt-4">
                    <div class="mb-3 d-flex align-items-end">
                        {{-- <label for="tag" class="form-label"> Lọc: </label> --}}
                        <select class="form-select" id="tag" name="tag" onchange="this.form.submit()">
                            <option value="">-- Tất cả --</option>
                            @foreach ($allTags as $t)
                                <option value="{{ $t->name }}" {{ request('tag') == $t->name ? 'selected' : '' }}>
                                    {{ $t->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        @foreach ($questions as $q)
            <div class="question-card">
                {{-- Avatar + Info --}}
                <div class="flex items-start gap-3">
                    <div class="avt-name d-flex">
                        {{-- Avatar --}}
                        <div class="avatar">
                            {{ strtoupper(substr($q->user->name, 0, 1)) }}
                        </div>
                        {{-- Header: tên + tag --}}
                        <div class="text-sm">
                            <span class="fw-bold text-gray-800">{{ $q->user->name }}</span>
                            <span class="text-gray-500"> đã đăng </span>
                            @if ($q->tags->first())
                                <a href="?tag={{ $q->tags->first()->name }}"
                                    class="tag-link">{{ $q->tags->first()->name }}</a>
                            @endif
                            <div class="text-xs text-gray-400 mb-2">{{ $q->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    {{-- Nội dung chính --}}
                    <div class="flex-1">

                        {{-- Nội dung bài viết --}}
                        <a href="{{ route('sharing.show', $q->slug) }}" class="title">
                            {{ $q->content }}
                        </a>

                        {{-- Footer: số bình luận --}}
                        <div class="d-flex justify-content-between text-xs text-gray-500 mt-2  items-center gap-1">
                            <a href="{{ route('sharing.show', $q->slug) }}" class="tex-cmt">
                                <i class="bi bi-chat"></i>
                                <span> Bình luận </span>
                            </a>
                            <div class="count-comment">
                                {{ $q->comments->count() }} bình luận
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Phân trang --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $questions->appends(request()->query())->links() }}
        </div>

        <!-- Modal tìm kiếm -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="GET" action="{{ route('sharing.index') }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="searchModalLabel">Tìm kiếm câu hỏi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="search" class="form-label">Từ khóa</label>
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="Nhập từ khóa...">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="tag" class="form-label">Chọn Tag</label>
                                <select class="form-select" id="tag" name="tag">
                                    <option value="">-- Tất cả --</option>
                                    @foreach ($allTags as $t)
                                        <option value="{{ $t->name }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tìm</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.icon-search').on('click', function() {
                $('#searchModal').modal('show');
            });
        });
    </script>
@endsection
