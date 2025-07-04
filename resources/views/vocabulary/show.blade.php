@extends('layouts.base-test')

@section('title', 'Hoàn thành N400')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/vocabulary.css') }}">

    <style>
        .container {
            padding: 0;
        }
    </style>
@endpush

@section('content')
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}"><img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" /></a>
            <h1 class="header-title">
                TỪ VỰNG<br>
            </h1>
        </div>
    </div>

    <main class="main-content">
        <div class="vocab-search-section">
            <div class="vocab-search-image">
                <img src="{{ asset('icon/vocabulary/hero.png') }}" alt="Vocabulary Banner">
            </div>

            <div class="vocab-search-box">
                <div class="search-input-wrapper">
                    <input type="text" placeholder="Tìm kiếm từ vựng" />
                    <a class="search-btn">
                        <img src="{{ asset('icon/vocabulary/search.svg') }}" alt="Search">
                    </a>
                </div>

                <div class="vocab-page">
                    <!-- Header tabs -->
                    <div class="vocab-tabs">
                        @foreach ($categories as $cat)
                            <a href="{{ route('vocabulary.show', ['slug' => $topicSlug]) }}?category={{ $cat->slug }}"
                                class="{{ $cat->id === $category->id ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Info alert -->
                    <div class="warning-container mb-2">
                        <div class="mt-3 font-sm text-muted p-3 rounded shadow-sm"
                            style="background: #f9f9fc; border-left: 4px solid #BF0C2C;">
                            <div class="d-flex align-start gap-2 text-dark font-sm" style="color: #BF0C2C;">
                                <img src="{{ asset('public/icon/q-and-a/warning.svg') }}" alt="Warning">

                                <span class="note-text">Các từ vựng thường xuất hiện trong bài thi quốc tịch</span>
                            </div>
                        </div>
                    </div>

                    <div class="vocab-wrapper">
                        <!-- A-Z sidebar -->
                        @if (in_array($category->slug, ['general', 'holidays']))
                            <div class="vocab-sidebar">
                                @foreach (range('A', 'Z') as $char)
                                    <a href="#"
                                        onclick="scrollToLetter('{{ $char }}'); return false;">{{ $char }}</a>
                                @endforeach
                            </div>
                        @endif

                        <!-- Main content -->
                        <div class="vocab-list">
                            @if ($isSplitStates)
                                {{-- Với category "50 bang": chia 2 phần --}}
                                @php
                                    $allStates = $vocabulariesGroupedByLetter->collapse(); // flatten all vocabularies
                                    $firstGroup = $allStates->take(13);
                                    $secondGroup = $allStates->slice(13);
                                @endphp

                                {{-- Phần 1: 13 tiểu bang đầu --}}
                                <h3 class="vocab-section-heading">13 Tiểu bang đầu tiên</h3>
                                <div class="vocab-list">
                                    @foreach ($firstGroup as $vocab)
                                        <div class="vocab-card">
                                            <div class="vocab-header">
                                                <div>
                                                    <strong>{{ $vocab->word }}:</strong>
                                                    <span>{{ $vocab->meaning }}</span>
                                                </div>
                                                <button class="speak-btn">
                                                    <img src="{{ asset('icon/vocabulary/audio.svg') }}" alt="Audio">
                                                </button>
                                            </div>
                                            @if ($vocab->hint)
                                                <div class="vocab-hint">Phát âm dễ nhớ: <i>{{ $vocab->hint }}</i></div>
                                            @endif
                                            @if ($vocab->example)
                                                <div class="vocab-example">Ví dụ: <em>{!! $vocab->example !!}</em></div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Phần 2: các tiểu bang còn lại --}}
                                <h3 class="vocab-section-heading">Các tiểu bang còn lại</h3>
                                <div class="vocab-list">
                                    @foreach ($secondGroup as $vocab)
                                        <div class="vocab-card">
                                            <div class="vocab-header">
                                                <div>
                                                    <strong>{{ $vocab->word }}:</strong>
                                                    <span>{{ $vocab->meaning }}</span>
                                                </div>
                                                <button class="speak-btn">
                                                    <img src="{{ asset('icon/vocabulary/audio.svg') }}" alt="Audio">
                                                </button>
                                            </div>
                                            @if ($vocab->hint)
                                                <div class="vocab-hint">Phát âm dễ nhớ: <i>{{ $vocab->hint }}</i></div>
                                            @endif
                                            @if ($vocab->example)
                                                <div class="vocab-example">Ví dụ: <em>{!! $vocab->example !!}</em></div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                {{-- Mặc định hiển thị theo nhóm A–Z --}}
                                @foreach ($vocabulariesGroupedByLetter as $letter => $items)
                                    <div id="letter-{{ $letter }}">
                                        <h2 class="vocab-letter" style="display: none;">{{ $letter }}</h2>
                                        @foreach ($items as $vocab)
                                            <div
                                                class="vocab-card {{ $topicSlug == 'n400' && $category->slug == 'define' ? 'border' : '' }}">
                                                <div class="vocab-header">
                                                    <div class="vocab-title">
                                                        <strong>{{ $vocab->word }}:</strong>
                                                        <span>{{ $vocab->meaning }}</span>
                                                    </div>
                                                    <button class="speak-btn">
                                                        <img src="{{ asset('icon/vocabulary/audio.svg') }}" alt="Audio">
                                                    </button>
                                                </div>
                                                @if ($vocab->synonymous)
                                                    <div class="d-flex justify-content-between mt-2">
                                                        <p class="synonymous mb-0">{{ $vocab->synonymous }}</p>
                                                        <button class="speak-btn">
                                                            <img src="{{ asset('icon/vocabulary/audio.svg') }}"
                                                                alt="Audio">
                                                        </button>
                                                    </div>
                                                @endif
                                                @if ($vocab->hint)
                                                    <div class="vocab-hint">Phát âm dễ nhớ: <i>{{ $vocab->hint }}</i>
                                                    </div>
                                                @endif
                                                @if ($vocab->example)
                                                    <div class="vocab-example">Ví dụ: <em>{!! $vocab->example !!}</em></div>
                                                @endif
                                                @if ($vocab->synonymous_translate)
                                                    <div class="vocab-hint">Dịch: <i>{{ $vocab->synonymous_translate }}</i>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('.vocab-list');
            const sections = document.querySelectorAll('.vocab-list > div[id^="letter-"]');
            const sidebarLinks = document.querySelectorAll('.vocab-sidebar a');

            function getActiveLetterByScroll() {
                let closestSection = null;
                let minDistance = Infinity;

                sections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    const distance = Math.abs(rect.top - container.getBoundingClientRect().top);
                    if (distance < minDistance) {
                        minDistance = distance;
                        closestSection = section;
                    }
                });

                if (closestSection) {
                    const letter = closestSection.id.replace('letter-', '');
                    sidebarLinks.forEach(link => {
                        link.classList.toggle('active', link.textContent.trim() === letter);
                    });
                }
            }

            container.addEventListener('scroll', () => {
                getActiveLetterByScroll();
            });

            // Chạy 1 lần khi load
            getActiveLetterByScroll();
        });



        function scrollToLetter(letter) {
            const container = document.querySelector('.vocab-list');
            const target = document.getElementById('letter-' + letter);

            if (container && target) {
                container.scrollTo({
                    top: target.offsetTop - container.offsetTop,
                    behavior: 'smooth'
                });
            }

            document.querySelectorAll('.vocab-sidebar a').forEach(el => el.classList.remove('active'));

            const clicked = Array.from(document.querySelectorAll('.vocab-sidebar a'))
                .find(el => el.textContent.trim() === letter);
            if (clicked) clicked.classList.add('active');
        }
    </script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('.vocab-list');
            const sections = document.querySelectorAll('.vocab-list > div[id^="letter-"]');
            const sidebarLinks = document.querySelectorAll('.vocab-sidebar a');

            function getActiveLetterByScroll() {
                let closestSection = null;
                let minDistance = Infinity;

                sections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    const distance = Math.abs(rect.top - container.getBoundingClientRect().top);
                    if (distance < minDistance) {
                        minDistance = distance;
                        closestSection = section;
                    }
                });

                if (closestSection) {
                    const letter = closestSection.id.replace('letter-', '');
                    sidebarLinks.forEach(link => {
                        link.classList.toggle('active', link.textContent.trim() === letter);
                    });
                }
            }

            container.addEventListener('scroll', () => {
                getActiveLetterByScroll();
            });

            getActiveLetterByScroll();

            // 🎧 Thêm sự kiện đọc từ (chỉ đọc English)
            document.querySelectorAll('.speak-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Lấy phần tử gần nhất chứa button và tìm đoạn cần đọc
                    const header = this.closest('.vocab-header');
                    if (header) {
                        const strong = header.querySelector('strong');
                        if (strong) {
                            speakText(strong.textContent.replace(':', '').trim());
                        }
                    } else {
                        const synonym = this.closest('.vocab-card')?.querySelector('.synonymous');
                        if (synonym) {
                            speakText(synonym.textContent.trim());
                        }
                    }
                });
            });
        });
    </script>
@endpush
