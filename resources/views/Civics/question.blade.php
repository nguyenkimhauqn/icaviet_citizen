@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('/public/css/civics.css') }}">

    <div class="container max-w-2xl mx-auto px-4 py-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-4 header-civics">
            <h1 class="text-2xl font-bold text-gray-800">KIỂM TRA CÔNG DÂN</h1>
        </div>
        {{-- Tiến độ --}}
        <div class="sp-bt">
            <div class="mb-2 text-base">
                <span class="highlight-text">Câu hỏi {{ $page }}</span> / <span class="highlight-text">
                    {{ $total }} </span>
            </div>
            <div class="mb-2 text-base">
                <div class="text-sm highlight-text"> Số lượt làm bài kiểm tra {{ $quizId }} </div>
            </div>
        </div>

        {{-- Câu hỏi chính --}}
        <div class="question-block ">
            <div class="flex justify-between items-start sp-bt">
                <div class="highlight-title"> {{ $question->content }} </div>
                <div class="flex space-x-3 ">
                    <button class="text-blue-500 text-xl play-audio-btn"
                        data-audio="{{ asset('public/audio/civics/questions/' . $question->audio_path) }}">🔊</button>
                    <button class="toggle-star-btn {{ $isStarred ? 'stared' : '' }} " data-question-id={{ $question->id }} data-active={{ $isStarred ? '1' : '0' }}>⭐</button>
                </div>
            </div>
        </div>

        {{-- Danh sách đáp án --}}
        @foreach ($question->answers as $answer)
            <button class="answer answer-option answer-disabled" type="button" name="answer_id"
                value="{{ $answer->id }}">
                <div class="left-answer">
                    🟦 {{ $answer->content }}
                </div>
                @if ($answer->is_correct)
                    <span class="text-blue-500 text-xl play-audio-answer" data-answer-id="{{ $answer->id }}"
                        data-audio="{{ asset('public/audio/civics/answers/' . $answer->audio_path) }}">
                        🔊
                    </span>
                @endif
            </button>
        @endforeach
        {{-- Nút Next căn giữa --}}
        <div class="flex justify-center mt-8 box-btn next-btn">
            <a href="{{ $nextPageUrl }}" type="button"
                class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 text-2xl">
                <img class="img-fluid icon-arrow" src="{{ asset('/public/icon/arrow-right.png') }}" alt="icon_arrow_right">
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // === * Phát âm thanh * ===
            // Phát âm câu hỏi
            $('.play-audio-btn').on('click', function() {
                let audioSrc = $(this).data('audio');
                let audio = new Audio(audioSrc);
                if (audio.paused) {
                    audio.play();
                }
            });
            // Phát âm câu trả lời
            $('.play-audio-answer').on('click', function() {
                let audioSrc = $(this).data('audio');
                let audio = new Audio(audioSrc);
                if (audio.paused) {
                    audio.play();
                }
            });
            // Phát tự động câu hỏi khi vào trang
            const autoPlayBtn = $('.play-audio-btn').first(); // 1 cau
            if (autoPlayBtn.length) {
                const audioSrc = autoPlayBtn.data('audio');
                const autoAudio = new Audio(audioSrc);
                autoAudio.play().catch(function(e) {
                    console.warn('Autoplay bị chặn bởi trình duyệt:', e);
                });
            }
            // [END] - Phát âm thanh 

            // AJAX kiểm tra đáp án
            $('.answer-option').on('click', function(e) {
                e.preventDefault();
                const button = $(this);
                const answerId = button.val();
                const questionId = {{ $question->id }};

                $.ajax({
                    url: `{{ url('civics/answer') }}/${questionId}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        answer_id: answerId
                    },
                    success: function(res) {
                        if (!res.success) return alert('Có lỗi xảy ra.');

                        $('.answer-option').prop('disabled', true);

                        // Xử lý màu đáp án đúng & sai. 
                        $('.answer-option').each(function() {
                            const currentBtn = $(this);
                            const currentId = parseInt(currentBtn.val());
                            // Reset các màu cũ trước

                            // Trường hợp: Luôn hiển thị đáp án đúng
                            if (currentId === res.correct_answer_id) {
                                currentBtn.addClass(
                                    'bg-green-500 text-white answer-correct');

                            }
                            // Trường hợp: chọn sai
                            if (currentId === res.selected_answer_id && currentId !==
                                res.correct_answer_id) {
                                currentBtn.addClass(
                                    'bg-red-500 text-white answer-wrong');
                            }
                            // Trường hợp: chọn đúng (phát âm đúng duy nhất một lần)
                            if (currentId === res.selected_answer_id && currentId ===
                                res.correct_answer_id) {

                                const correctAudio = $(
                                    `.play-audio-answer[data-answer-id="${currentId}"]`
                                );
                                correctAudio.css('display', 'block');
                                const audioPath = correctAudio.data('audio');
                                const audio = new Audio(audioPath);
                                audio.play();
                            }

                        });

                        // Hiển thị đáp án đúng khác
                        if (res.is_correct && res.hints.length > 0) {
                            // console.log(res.hints);
                            res.hints.forEach(function(hint) {
                                console.log(hint);

                            });

                            let hinHtml =
                                '<div class=" p-2 rounded bg-green-50 text-sm text-gray-800">';
                            hinHtml +=
                                '<p class="font-semibold mb-2 text-green-700">Các cách trả lời đúng khác:</p>';
                            res.hints.forEach(function(hint) {
                                hinHtml += `<div class="pl-2">✅ ${hint}</div>`;
                            });
                            hinHtml += `</div>`;
                            // Gắn hint vào câu trả lời đúng
                            $(`[value='${res.correct_answer_id}']`).after(hinHtml);

                        }

                    },
                    error: function() {
                        alert('Lỗi kết nối máy chủ.');
                    }
                });
            });
            // [END] - AJAX check 

            // Check Result
            $('.box-btn a').on('click', function(e) {
                const currentPage = {{ $page }}; // so cau hien tai
                const totalQuestions = {{ $total }} // tong so cau
                const mode = "{{ $mode }}"; // 
                // alert(1);
                const routeQuizResult = "{{ route('civics.quizResult', ['quiz' => 'QUIZ_ID']) }}";
                const nextPage = currentPage + 1;
                if (nextPage > totalQuestions) {
                    e.preventDefault(); // stop move page
                    // alert(1);
                    // Gui AJAX
                    $.ajax({
                        type: "POST",
                        url: "{{ url('civics/finish-quiz') }}",
                        data: {
                            _token: " {{ csrf_token() }} "
                        },
                        dataType: "json",
                        success: function (res) {
                                if (res.success) {
                                    // alert(1);
                                    // console.log(ok);
                                    const redirectUrl = routeQuizResult.replace('QUIZ_ID', res.quiz_id) + '?mode=' + mode;
                                    // chuyen huong trang success:
                                    window.location.href = redirectUrl;
                                } else {
                                    alert("Không thể hoàn thành bài kiểm tra. Vui lòng thử lại!'");
                                }
                        },

                        error: function() {
                            alert("Loi ket noi may chu");
                        }
                    });
                }
            });
            // [END] - Check Result

            // === * Lưu câu hỏi đánh dấu sao * ===  

            //  --- Check isStarred ---
            const starBtn = $('.toggle-star-btn');
            if( parseInt(starBtn.data('active'))  === 1){
                starBtn.css('background','gold');
            } else {
                starBtn.css('background','');
            }

            //  --- [END] Check isStarred ---
            $('.toggle-star-btn').on('click', function () {
                let btn = $(this);
                let questionId = btn.data('question-id');
                // alert(1);
                $.post("{{ url('civics/star') }}/" + questionId, {
                    _token: '{{ csrf_token() }}'
                }, function (res) {
                    // Xu ly phan hoi
                    // alert(res.status)
                    if(res.status === 'added') {
                        btn.css('background-color','gold');
                    } else {
                        btn.css('background-color','');
                    }
                });
            });
            // [END] == * Lưu câu hỏi đánh dấu sao * ===  
        });
    </script>
@endsection
