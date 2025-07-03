@extends('layouts.base-test')

@section('title', $testType->title)

@section('content')

    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}"><img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" /></a>
            <h1 class="header-title">
                THI THỬ<br>
                <span class="header-subtitle">{{ $testType->name }}</span>

                @if ($testType->vietnamese_name)
                    <span class="header-subtitle-2">({{ $testType->vietnamese_name }})</span>
                @endif
            </h1>
        </div>
    </div>

    <main class="main-content">
        @if ($question)
            <form method="POST" action="{{ route('submit.answer', [$testType->slug, 'page' => $page]) }}" id="questionForm">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <input type="hidden" name="question_content" value="{{ $question->content }}">

                <div class="quiz-container">
                    <h1 class="font-sm">
                        {{ strip_tags($question->content) }}
                    </h1>

                    <input type="text" name="answer_text" readonly class="instruction-text form-control mt-3"
                        placeholder="Nhấn vào micro và đọc câu" value="">
                </div>
            </form>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

    </main>

    <div class="test-footer">
        {{-- <a href="{{ $page > 1 ? route('start.mock-test', $testType->slug) . '?page=' . ($page - 1) : '#' }}"
                        class="btn btn-round {{ $page <= 1 ? 'disabled' : '' }}" id="prevBtn">
                        <img src="{{ asset('public/icon/mockTests/arrow-left.svg') }}" alt="Prev" />
                    </a> --}}
        <button class="btn btn-round active microBtn">
            <img class="micro-icon" src="{{ asset('public/icon/mockTests/micro.svg') }}" alt="">
        </button>
        <a href="{{ route('start.mock-test', $testType->slug) }}?page={{ $page + 1 }}" class="btn-round disabled"
            id="nextBtn">
            <img src="{{ asset('public/icon/mockTests/arrow-right.svg') }}" alt="Next" />
        </a>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.option').on('click', function() {
                $('.option').removeClass('active');
                $(this).addClass('active');
                $('#answer_id').val($(this).data('answer'));
                $('#nextBtn').addClass('active');

            });

            $('.microBtn').on('click', function() {
                if (isListening) return;

                const $btn = $(this);
                const $icon = $('.micro-icon');
                const originalSrc = $icon.attr('src');
                const recordingSrc = '{{ asset('public/icon/mockTests/micro-recording.svg') }}';

                $icon.attr('src', recordingSrc);

                listen(
                    function(text) {
                        $('input[name="answer_text"]').val(text).trigger('input');

                        // Disable micro button
                        $btn.prop('disabled', true);

                        // Enable next button
                        $('#nextBtn').removeClass('disabled').addClass('active');
                    },
                    function() {
                        $icon.attr('src', originalSrc);
                    },
                    function() {
                        $icon.attr('src', originalSrc);
                    }
                );
            });

            $('.audio').on('click', function() {
                const text = $('.questionText').val();
                speak(text);
            })

            $('#nextBtn').on('click', function(e) {
                e.preventDefault();

                // if (!$('#answer_id').val()) {
                //     alert('Vui lòng chọn một đáp án!');
                //     return;
                // }

                $('#questionForm').submit();
            });
        });
    </script>
@endpush
