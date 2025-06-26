@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('/public/css/civics.css') }}">

    <div class="container mt-4">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-center mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}" class="" title="Quay về trang chủ" style="width: 42px; height: 42px;">
                    <img style="width: 50px; height: 50px;" src="{{ url('public/icon/Icon-back-home.svg') }}" alt="">
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="heading-module text-2xl font-bold text-gray-800"> {!! $heading ?? '' !!} </h3>
            </div>
        </div>

        {{-- Tiến độ --}}
        <div class="process sp-bt d-flex justify-content-center">
            <div class="mb-2 text-base">
                <span class="">Câu hỏi </span> <span class="fw-bold"> {{ $page }} /
                    {{ $total }} </span>
            </div>
        </div>

        {{-- Câu hỏi chính --}}
        <div class="question-block ">
            <div class="flex justify-between items-start sp-bt">
                <div class="highlight-title"> {!! $question->content !!} </div>
                <div class="flex space-x-3 ">
                    <span class="d-block text-blue-500 text-xl play-audio-btn"
                        data-audio="{{ asset('public/audio/civics/questions/' . $question->audio_path) }}"> <img
                            src="{{ url('public/icon/Speaker.svg') }}" alt="icon_speaker"> </span>
                    <span class="d-block toggle-star-btn {{ $isStarred ? 'stared' : '' }} "
                        data-question-id={{ $question->id }} data-active={{ $isStarred ? '1' : '0' }}> <img
                            src="{{ url('public/icon/Icon _Starred.svg') }}" alt="icon_starred"> </span>
                </div>
            </div>
        </div>

        <div class="answer-block">
            {{-- Danh sách đáp án --}}
            @foreach ($question->answers as $answer)
                <button class="answer answer-option answer-disabled" type="button" name="answer_id"
                    value="{{ $answer->id }}">
                    {{-- Hiển thị đáp án động theo zip --}}
                    @php
                        $dynamicContent = $answer->content;

                        if ($question->has_guideline && $answer->is_correct && isset($representativeData)) {
                            switch ($question->id) {
                                case 20: // Senator
                                    $senators = $representativeData->senators;
                                    if (is_array($senators) && count($senators) > 0) {
                                        $firstSenator = $senators[0];
                                        $dynamicContent =
                                            $firstSenator['first_name'] . ' ' . $firstSenator['last_name'];
                                    }
                                    break;
                                case 23: // Representative
                                    $rep = $representativeData->representative;
                                    if (is_array($rep)) {
                                        $dynamicContent = $rep['first_name'] . ' ' . $rep['last_name'];
                                    }
                                    break;
                                case 43: // Governor
                                    $gov = $representativeData->governor;
                                    if (is_array($gov)) {
                                        $dynamicContent = $gov['first_name'] . ' ' . $gov['last_name'];
                                    }
                                    break;
                                case 44: // Capital
                                    $dynamicContent = $representativeData->capital ?? $answer->content;
                                    break;
                            }
                        }
                    @endphp

                    <div class="left-answer">
                        {{ $dynamicContent }}
                    </div>
                    @if ($answer->is_correct)
                        <span id="play-audio-answer" class="text-blue-500 text-xl play-audio-answer"
                            data-answer-id="{{ $answer->id }}"
                            data-audio="{{ asset('public/audio/civics/answers/' . $answer->audio_path) }}">
                            <img src="{{ url('public/icon/Icon_Speaker_answer.svg') }}" alt="icon_speaker">
                        </span>
                    @endif
                </button>
                @if ($answer->explanation || $answer->pronunciation)
                    <div id="trans-box" class="trans-box d-none">
                        @if ($answer->explanation)
                            <strong>Dịch:</strong> {{ $answer->explanation }}
                        @endif
                        @if ($answer->pronunciation)
                            <p class="mt-2"><strong>Phát âm dễ nhớ:</strong> {{ $answer->pronunciation }}</p>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Dịch câu hỏi và mẹo ghi nhớ --}}
        @if ($question->translation)
            <p class="mt-2">
                <strong>Dịch:</strong> {{ $question->translation }}
            </p>
        @endif
        <div class="container-tips">
            @if ($question->tips)
                <div class="tips-box">
                    <strong>
                        <p class="d-block"> Mẹo ghi nhớ: </p>
                    </strong>
                    @foreach (json_decode($question->tips, true) as $label => $value)
                        <div class="answer-tips">
                            <span class="tag">
                                <span class="tag-key">{{ $label . ':' }} </span> <span class="tag-value">
                                    {{ $value }} </span>
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Hướng dẫn bổ sung nếu là câu liên quan người đại diện --}}
        @if ($question->has_guideline)
            @php
                // Xác định link động theo ID
                $guidelineLinks = [
                    20 => 'https://www.senate.gov/senators/index.htm',
                    23 => 'https://www.house.gov/representatives',
                    43 => 'https://www.usa.gov/state-governor',
                ];
                $guidelineUrl = $guidelineLinks[$question->id] ?? null;
            @endphp
            <div class="guideline-box mt-5 p-4 bg-white rounded-[20px] border-l-[9px] border-[#27AE60]">
                <p class="fw-bold mb-2 text-lg text-danger">
                    Lưu ý: Thông tin hiển thị dựa trên mã ZIP và dữ liệu công khai có thể không chính xác 100%.
                    Vui lòng kiểm tra lại trên trang web của chính phủ:
                </p>

                @if ($guidelineUrl)
                    <p class="text-base leading-relaxed">
                        <a href="{{ $guidelineUrl }}" target="_blank" class="text-blue-600 underline">
                            {{ $guidelineUrl }}
                        </a>
                    </p>
                @endif
            </div>
        @endif

        {{-- Nút Next căn giữa --}}
        <div class="d-flex justify-content-center mt-8 box-btn next-btn box-next-btn-circle">
            <a href="{{ $nextPageUrl }}" class="next-btn-circle">
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // === * Phát âm thanh * ===
            // Phát âm câu hỏi
            let isPlaying = false;
            $('.play-audio-btn').on('click', function() {
                // Nếu đang phát, chặn click tiếp
                if (isPlaying) {
                    return; // Không cho phát lặp
                }

                let audioSrc = $(this).data('audio');
                let audio = new Audio(audioSrc);

                isPlaying = true; // Đánh dấu đang phát
                audio.play();

                // Khi âm thanh phát xong → cho click lại
                audio.addEventListener('ended', function() {
                    isPlaying = false;
                });

                // Nếu có lỗi khi phát (ví dụ autoplay bị chặn), cho phép phát lại
                audio.addEventListener('error', function() {
                    isPlaying = false;
                });
            });
            // Phát âm câu trả lời theo audio sẵn
            // $('.play-audio-answer').on('click', function() {
            //     alert(1);
            //     let audioSrc = $(this).data('audio');
            //     let audio = new Audio(audioSrc);
            //     if (audio.paused) {
            //         audio.play();
            //     }
            // });


            // Text to speech theo questions
            $('.play-audio-answer').on('click', function() {
                // Phát văn bản bằng giọng nói
                // Lấy nội dung văn bản của đáp án
                const answerText = $(this).closest('button').find('.left-answer').text().trim();
                speakText(answerText);
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
                        // $('.answer-option').css('pointer-events', 'none');
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

                                // 🔊 Phát âm thanh sai
                                const wrongAudio = new Audio(
                                    '{{ asset('public/audio/civics/Wrong-answer.mp3') }}'
                                );
                                wrongAudio.play();
                            }
                            // Trường hợp: chọn đúng (phát âm đúng duy nhất một lần)
                            if (currentId === res.selected_answer_id && currentId ===
                                res.correct_answer_id) {

                                const correctAudio = $(
                                    `.play-audio-answer[data-answer-id="${currentId}"]`
                                );
                                correctAudio.css('display', 'block');

                                // 🔊 Phát âm thanh đúng
                                const correctSound = new Audio(
                                    '{{ asset('public/audio/civics/correct-answer.mp3') }}'
                                );
                                correctSound.play();

                                // Phát đáp án lưu trữ khi chọn đúng

                                // const audioPath = correctAudio.data('audio');
                                // const audio = new Audio(audioPath);
                                // audio.play();

                                //   Phát văn bản câu trả lời đúng
                                const correctAnswerText = currentBtn.find(
                                    '.left-answer').text().trim();
                                speakText(correctAnswerText); // 
                            }

                        });

                        // Hiển thị phần dịch & phát âm
                        $('#trans-box').removeClass('d-none').addClass('d-block');

                        // Hiển thị đáp án đúng khác
                        // tạm off
                        // if (res.is_correct && res.hints.length > 0) {
                        //     // console.log(res.hints);
                        //     res.hints.forEach(function(hint) {
                        //         console.log(hint);

                        //     });

                        //     let hinHtml =
                        //         '<div class=" p-2 rounded bg-green-50 text-sm text-gray-800">';
                        //     hinHtml +=
                        //         '<p class="font-semibold mb-2 text-green-700">Các cách trả lời đúng khác:</p>';
                        //     res.hints.forEach(function(hint) {
                        //         hinHtml += `<div class="pl-2">✅ ${hint}</div>`;
                        //     });
                        //     hinHtml += `</div>`;
                        //     // Gắn hint vào câu trả lời đúng
                        //     $(`[value='${res.correct_answer_id}']`).after(hinHtml);

                        // }

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
                        success: function(res) {
                            if (res.success) {
                                // alert(1);
                                // console.log(ok);
                                const redirectUrl = routeQuizResult.replace('QUIZ_ID', res
                                    .quiz_id) + '?mode=' + mode;
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
            if (parseInt(starBtn.data('active')) === 1) {
                starBtn.css('background', 'gold');
            } else {
                starBtn.css('background', '');
            }

            //  --- [END] Check isStarred ---
            $('.toggle-star-btn').on('click', function() {
                let btn = $(this);
                let questionId = btn.data('question-id');
                // alert(1);
                $.post("{{ url('civics/star') }}/" + questionId, {
                    _token: '{{ csrf_token() }}'
                }, function(res) {
                    // Xu ly phan hoi
                    // alert(res.status)
                    if (res.status === 'added') {
                        btn.css('background-color', 'gold');
                    } else {
                        btn.css('background-color', '');
                    }
                });
            });
            // [END] == * Lưu câu hỏi đánh dấu sao * ===  
        });
    </script>
@endsection
