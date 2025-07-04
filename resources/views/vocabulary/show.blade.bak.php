@extends('layouts.base-test')

@section('title', 'Hoàn thành N400')

@push('styles')
<link rel="stylesheet" href="{{ asset('public/css/vocabulary.css') }}">

<style>
    .container {
        padding: 0;
    }
</style>
@endpush

@section('content')
<div class="header-inner sticky-header">
    <div class="header">
        <a href="{{ route('home') }}"><img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" /></a>
        <h1 class="header-title">
            TỪ VỰNG<br>
        </h1>
    </div>
</div>

{{-- <form method="GET" action="{{ route('vocabulary.show', ['slug' => $topicSlug]) }}"
style="width: 100%; height: 100%;">
<input type="hidden" name="category" value="{{ $category->slug }}">
<div class="search-input-wrapper">
    <input type="text" name="search" placeholder="Tìm kiếm từ vựng" value="{{ request('search') }}">
    <button type="submit" class="search-btn">
        <img src="{{ asset('public/icon/vocabulary/search.svg') }}" alt="Search">
    </button>
</div>
</form> --}}

<main class="main-content">

    <div class="vocab-search-section">
        <div class="vocab-search-box">

            <div class="sticky-wrapper">
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
                            <h3 class="vocab-section-heading" onclick="showLightbox(); return false;">13 Tiểu bang
                                đầu
                                tiên</h3>

                            <!-- Button trigger -->
                            <a href="#" class="font-italic-sm d-flex gap-2" style="font-style: italic;"
                                onclick="showLightbox(); return false;">
                                <img src="{{ asset('public/icon/vocabulary/upload-img.svg') }}" alt="">
                                Hình ảnh 13 tiểu bang đầu tiên
                            </a>

                            <!-- Lightbox modal -->
                            <div id="lightbox" class="lightbox-overlay" onclick="hideLightbox()">
                                <span class="lightbox-close" onclick="hideLightbox()">&times;</span>
                                <img src="{{ asset('public/icon/vocabulary/tieubang.jpg') }}" class="lightbox-image"
                                    alt="13 tiểu bang đầu tiên" onclick="event.stopPropagation()" />
                            </div>

                            <div class="vocab-list">
                                @foreach ($firstGroup as $vocab)
                                <div class="vocab-card">
                                    <div class="vocab-header">
                                        <div>
                                            <strong>{{ $vocab->word }}:</strong>
                                            <span>{{ $vocab->meaning }}</span>
                                        </div>
                                        <button class="speak-btn">
                                            <img src="{{ asset('public/icon/vocabulary/audio.svg') }}" alt="Audio">
                                        </button>
                                    </div>
                                    @if ($vocab->hint)
                                    <div class="vocab-hint">Phát âm dễ nhớ: <i>{{ $vocab->hint }}</i>
                                    </div>
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
                                            <img src="{{ asset('public/icon/vocabulary/audio.svg') }}" alt="Audio">
                                        </button>
                                    </div>
                                    @if ($vocab->hint)
                                    <div class="vocab-hint">Phát âm dễ nhớ: <i>{{ $vocab->hint }}</i>
                                    </div>
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
                                    @if (isset($vocab->user_id))
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="additional-vocab-title mb-0">Từ vựng được thêm</p>
                                        <button class="btn edit-vocab-btn"
                                            data-word="{{ $vocab->word }}"
                                            data-meaning="{{ $vocab->meaning }}"
                                            data-synonymous="{{ $vocab->synonymous }}"
                                            data-hint="{{ $vocab->hint }}"
                                            data-id="{{ $vocab->id }}"
                                            data-synonymous_translate="{{ $vocab->synonymous_translate }}">
                                            <img src="{{ asset('public/icon/vocabulary/edit.svg') }}"
                                                alt="Edit">
                                        </button>
                                    </div>
                                    @endif

                                    <div class="vocab-header">
                                        <div class="vocab-title">
                                            <strong>{{ $vocab->word }}:</strong>
                                            <span>{{ $vocab->meaning }}</span>
                                        </div>
                                        <button class="speak-btn">
                                            <img src="{{ asset('public/icon/vocabulary/audio.svg') }}"
                                                alt="Audio">
                                        </button>
                                    </div>
                                    @if ($vocab->synonymous)
                                    <div class="d-flex justify-content-between mt-2">
                                        <p class="synonymous mb-0">{{ $vocab->synonymous }}</p>
                                        <button class="speak-btn">
                                            <img src="{{ asset('public/icon/vocabulary/audio.svg') }}"
                                                alt="Audio">
                                        </button>
                                    </div>
                                    @endif
                                    @if ($vocab->hint)
                                    <div class="vocab-hint">Phát âm dễ nhớ: <i>{{ $vocab->hint }}</i>
                                    </div>
                                    @endif
                                    @if ($vocab->example)
                                    <div class="vocab-example">Ví dụ: <em>{!! $vocab->example !!}</em>
                                    </div>
                                    @endif
                                    @if ($vocab->synonymous_translate)
                                    <div class="vocab-hint">Dịch:
                                        <i>{{ $vocab->synonymous_translate }}</i>
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
    </div>


</main>

<div class="test-footer justify-content-between">
    @if ($topicSlug == 'n400' && $category->slug == 'define')
    <div class="btn-group d-flex justify-content-between" style="width: 100%">
        <button class="btn-round sm">
            <img src="{{ asset('public/icon/vocabulary/arrow-up.svg') }}" alt="">
        </button>
        <div class="d-flex align-items-center gap-2 font-sm" style="cursor: pointer;" onclick="openModal()">
            <span>Thêm tư vựng</span>
            <button class="btn-round sm square">
                +
            </button>
        </div>
    </div>
    @endif
</div>

<div id="vocabModal" class="modal">
    <form id="vocabForm" class="modal-content" method="POST" action="{{ route('vocabulary.store') }}">
        @csrf
        <input type="hidden" name="vocab_id" id="vocab_id" />
        <h3 id="modalTitle">Thêm từ vựng mới</h3>

        <input type="text" name="word" id="word" placeholder="Nhập từ vựng" required />
        <input type="text" name="hint" id="hint" placeholder="Phát âm dễ nhớ" />
        <input type="text" name="synonymous" id="synonymous" placeholder="Định nghĩa tiếng Anh" />
        <input type="text" name="meaning" id="meaning" placeholder="Nghĩa tiếng Việt" />


        <button type="submit" class="submit-btn">Lưu</button>
    </form>
</div>


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



    function showLightbox() {
        document.getElementById('lightbox').classList.add('show');
    }

    function hideLightbox() {
        document.getElementById('lightbox').classList.remove('show');
    }



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

    function openModal() {
        document.getElementById('vocabModal').style.display = 'block';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('vocabModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('.edit-vocab-btn').click(function() {
            const id = $(this).data('id');
            const word = $(this).data('word');
            const hint = $(this).data('hint');
            const synonymous = $(this).data('synonymous');
            const meaning = $(this).data('meaning');
            const translate = $(this).data('synonymous_translate');

            // Đổi title + action form
            $('#modalTitle').text('Chỉnh sửa từ vựng');
            // $('#vocabForm').attr('action', '/vocabulary/' + id); // route('vocabulary.update', id)
            // $('#vocabForm').append('<input type="hidden" name="_method" value="PUT">');

            // Gán dữ liệu
            $('#vocab_id').val(id);
            $('#word').val(word);
            $('#hint').val(hint);
            $('#synonymous').val(synonymous);
            $('#meaning').val(meaning);
            $('#synonymous_translate').val(translate);

            // Hiển thị modal
            $('#vocabModal').fadeIn();
        });

        // Đóng modal khi click ngoài
        $(document).mouseup(function(e) {
            const modal = $("#vocabModal .modal-content");
            if (!modal.is(e.target) && modal.has(e.target).length === 0) {
                $('#vocabModal').fadeOut();
            }
        });
    });
</script>
@endpush