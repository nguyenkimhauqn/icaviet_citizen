@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ url('public/css/sharing.css') }}">

    <div class="container max-w-xl mx-auto px-4 py-6">

        {{-- Header --}}
        <div class="wp-header d-flex align-items-center">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}" class="" title="Quay về trang chủ" style="width: 42px; height: 42px;">
                    <img style="width: 50px; height: 50px;" src="{{ url('public/icon/Icon-back-home.svg') }}" alt="">
                </a>
            </div>
            <div class="">
                <h3 class="heading-module text-2xl font-bold text-gray-800"> CHIA SẺ KINH NGHIỆM </h3>
            </div>
        </div>

        <div class="question-box d-flex justify-content-between mb-4 mt-4">
            <a class="btn-back d-block" href="{{route('sharing.index')}}"> <i class="bi bi-arrow-left-circle"></i> </a>
            <h5 class="text-lg font-semibold fs-4">Đặt câu hỏi mới</h5>
            <span class="btn-delete text-gray-400 text-2xl font-light hover:text-gray-600"> <i class="bi bi-x-lg"> </i>
            </span>
        </div>
        {{-- Thông báo lỗi --}}
        @if ($errors->any())
            <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-800 text-sm rounded">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('sharing.store') }}" method="POST">
            @csrf

            {{-- Input tiêu đề --}}
            {{-- <div class="mb-4">
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Tiêu đề câu hỏi..."
                    class="w-100 border border-blue-500 rounded px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div> --}}

            {{-- Textarea --}}
            <textarea id="content-input" name="content" rows="8" placeholder="Nhập nội dung câu hỏi..."
                class="w-100 border border-blue-500 rounded  focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none text-sm mb-4"
                required>{{ old('content') }}</textarea>

            {{-- Chọn tag --}}
            <div class="mb-4">
                <div class="flex items-center gap-2 mb-2 text-sm text-gray-500">
                    <i class="bi bi-tags"></i>
                    <span>Chọn tag bài viết</span>
                </div>

                <div class="flex flex-wrap gap-2">
                    {{-- @foreach ($tags as $t)
                        <label class="tag-label">
                            <input type="checkbox" name="tags[]" value="{{ $t->id }}" class="hidden"
                                {{ in_array($t->id, old('tags', [])) ? 'checked' : '' }}>
                            <span>{{ $t->name }}</span>
                        </label>
                    @endforeach --}}

                    @foreach ($tags as $t)
                        <label class="tag-label">
                            <input type="checkbox" name="tags[]" value="{{ $t->id }}" class="hidden"
                                {{ in_array($t->id, old('tags', [])) ? 'checked' : '' }}>
                            <span>{{ $t->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Nút đăng --}}
            <div class="box-btn d-flex justify-content-center">
                <button type="submit" class="btn-create">
                    Đăng bài
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-delete').on('click', function() {
                $('#content-input').val('');
            });
        });
    </script>
@endsection
