@extends('layouts.base-test')

@section('title', 'Q&A (Hỏi & Đáp)')

@push('styles')
    {{-- TODO: public --}}
    <link rel="stylesheet" href="{{ asset('css/mock-result.css') }}">
    <link rel="stylesheet" href="{{ asset('css/q-and-a.css') }}">
@endpush

@section('content')

    <!-- Header -->
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}">
                <img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" />
            </a>
            <h1 class="header-title" style="margin-bottom: 0px;">
                Q&A (Hỏi & Đáp)
            </h1>
        </div>
    </div>


    <main class="main-content">
        <div class="btn-group">
            <button class="btn-outlined">Câu hỏi thi quốc tịch</button>
            <button class="btn-none">Câu hỏi về app</button>
        </div>

        <div class="warning-container mb-2">
            <div class="mt-3 font-sm text-muted p-3 rounded shadow-sm"
                style="background: #f9f9fc; border-left: 4px solid #BF0C2C;">
                <div class="d-flex align-center gap-2 text-dark font-sm" style="color: #BF0C2C;">
                    <img src="{{ asset('public/icon/q-and-a/warning.svg') }}" alt="Warning">

                    <span>
                        <span class="note-title" style="color: #BF0C2C; flex-shrink: 0;">Lưu ý:</span>
                        <span class="note-text"> Các thông tin có thể thay đổi. Vui lòng xem cập nhật mới nhất tại
                            <a href="https://uscis.gov">uscis.gov</a>
                        </span>
                    </span>
                </div>
            </div>
        </div>

        @foreach ($categories as $category)
            <h2 class="condition-title">{{ $category->name }}</h2>
            <div>
                @foreach ($category->items as $index => $item)
                    <div x-data="{ open: false }" class="qa-box">
                        <button @click="open = !open" class="qa-toggle">
                            <span class="qa-question">{{ $loop->iteration }}. {{ $item->question }}</span>

                            {{-- Icon khi đóng (arrow-down) --}}
                            <img x-show="!open" src="{{ asset('icon/q-and-a/arrow-down.svg') }}" alt="↓"
                                class="qa-icon">

                            {{-- Icon khi mở (arrow-up) --}}
                            <img x-show="open" src="{{ asset('icon/q-and-a/arrow-up.svg') }}" alt="↑"
                                class="qa-icon">
                        </button>

                        <div x-show="open" x-transition class="qa-answer">
                            {{ $item->answer ?? 'Đang cập nhật...' }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

    </main>
    <!-- Start Button -->
    <div class="test-footer end">
        <a class="send-button" href="{{ route('start.mock-test', 'civics') }}">
            Gửi phản hồi
            <img src="{{ asset('icon/q-and-a/send.svg') }}" alt="Gửi">
        </a>
    </div>
@endsection

@push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
@endpush
