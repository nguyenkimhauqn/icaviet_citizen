@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('/public/css/n400.css') }}">

    <div class="container max-w-2xl mx-auto px-4 py-6">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-end mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('n400.categories.index') }}"
                    class="btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center"
                    title="Quay về trang chủ" style="width: 48px; height: 48px;">
                    <i class="bi bi-arrow-left-circle-fill fs-3"></i>
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="text-2xl font-bold text-gray-800"> {{ $category->title_en ?? 'PHỎNG VẤN N400' }} </h3>
            </div>
        </div>

        {{-- Tiến độ + Thêm câu hỏi --}}
        <div
            class="sp-bt d-flex justify-content-between align-items-center mb-3 px-2 py-2 border rounded shadow-sm bg-light">
            {{-- Tiến độ --}}
            <div class="text-base fw-semibold">
                <span class="highlight-text">Câu hỏi {{ $index + 1 }}</span>
                /
                <span class="highlight-text">{{ $total }}</sp˝an>
            </div>

            @if ($question->user_id === auth()->id())
                <div class="d-flex justify-content-center gap-2 mt-2">
                    {{-- Nút chỉnh sửa nội dung câu hỏi --}}
                    <button class="btn-circle btn-sm icon-btn" id="edit-question-btn" data-bs-toggle="modal"
                        data-bs-target="#editQuestionModal">
                        ✏️
                    </button>

                    {{-- Nút xóa --}}
                    <button class="btn-circle btn-sm icon-btn" id="delete-question-btn"
                        data-id-question="{{ $question->id }}">
                        🗑️
                    </button>
                </div>
            @endif

            {{-- Icon thêm câu hỏi --}}
            <button class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2" data-bs-toggle="modal"
                data-bs-target="#addQuestionModal" data-category-id="{{ $category->id }}" data-source="detail">
                <i class="bi bi-plus-circle fs-5"></i> <span>Thêm câu hỏi</span>
            </button>
        </div>

        {{-- Câu hỏi chính --}}
        <div class="question-block">
            <div class="wp-question fl-item flex justify-center items-center my-6">

                {{-- Icon Loa --}}
                <img id="icon-audio-question" class="img-fluid img-loudspeaker play-audio-btn"
                    src="{{ url('public/icon/loudspeaker.png') }}"
                    data-audio="{{ asset('audio/n400/' . $question->audio_path) }}" alt="icon_loudspeaker">

                {{-- Toggle đáp án --}}
                <h5 id="icon-show">
                    <i class="bi bi-toggle-on toggle-icon"></i>
                </h5>

                {{-- Nội dung câu hỏi (ẩn mặc định) --}}
                <p id="n400-question" class="d-block italic text-center mt-2">
                    {{ $question->content ?? '[No question]' }}
                </p>

                {{-- Input nhập câu trả lời + nút điều khiển --}}
                <div class="position-relative w-100" style="max-width: 500px;">
                    {{-- Nút phát âm --}}
                    <button id="speak-btn" class="btn-circle icon-btn speak-btn" type="button" title="Phát âm">
                        🔊
                    </button>

                    {{-- Nút chỉnh sửa --}}
                    <button id="toggle-edit-btn" class="btn-circle icon-btn edit-btn" type="button" title="Chỉnh sửa">
                        ✏️
                    </button>

                    {{-- Nút lưu --}}
                    <button id="save-btn" class="btn-circle icon-btn save-btn d-none" type="button" title="Lưu nội dung">
                        💾
                    </button>

                    {{-- Textarea đáp án --}}
                    <textarea class="form-control input-writing text-lg ps-5 pe-5 py-2 border rounded text-center" name="answer"
                        id="answer" rows="2" data-id-question="{{ $question->id }}" readonly>{{ $question->answers->first()->content ?? '[No Answer]' }}</textarea>
                </div>

                {{-- Điều hướng chuyên mục & câu hỏi --}}
                <div class="d-flex justify-center align-items-center gap-3 mt-5">
                    {{-- Chuyên mục trước --}}
                    <a href="{{ route('n400.category.prev', ['id' => $category->id]) }}"
                        class="btn btn-primary btn-circle shadow-sm">
                        <i class="bi bi-chevron-double-left"></i>
                    </a>

                    {{-- Câu hỏi trước trong chuyên mục --}}
                    <a href="{{ route('n400.category.show', ['id' => $category->id, 'index' => max($index - 1, 0)]) }}"
                        class="btn btn-primary btn-lg shadow-sm">
                        <i class="bi bi-chevron-left"></i>
                    </a>

                    {{-- Câu hỏi tiếp theo trong chuyên mục --}}
                    <a href="{{ route('n400.category.show', ['id' => $category->id, 'index' => min($index + 1, $total - 1)]) }}"
                        class="btn btn-primary btn-lg shadow-sm">
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    {{-- Chuyên mục tiếp theo --}}
                    <a href="{{ route('n400.category.next', ['id' => $category->id]) }}"
                        class="btn btn-primary btn-circle shadow-sm">
                        <i class="bi bi-chevron-double-right"></i>
                    </a>
                </div>

            </div>
        </div>
        {{-- modal form  --}}
        <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm câu hỏi mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-add-question">
                            <input type="hidden" id="modal-category-id">
                            <input type="hidden" id="modal-source">

                            <div class="mb-3">
                                <label>Câu hỏi</label>
                                <textarea class="form-control" id="modal-question" rows="2" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Câu trả lời</label>
                                <textarea class="form-control" id="modal-answer" rows="2" required></textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">💾 Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Sửa Câu Hỏi --}}
        <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chỉnh sửa câu hỏi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-edit-question">
                            <input type="hidden" id="edit-question-id" value="{{ $question->id }}">

                            <div class="mb-3">
                                <label for="edit-question-content" class="form-label">Nội dung câu hỏi</label>
                                <textarea class="form-control" id="edit-question-content" rows="2" required>{{ $question->content }}</textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">💾 Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            /** @type {SpeechSynthesis} */
            $(document).ready(function() {
                // 01. Toggle Quesion
                $('#icon-show').on('click', function(e) {
                    e.preventDefault();
                    const answer = $('#n400-question');
                    answer.toggleClass('d-none d-block');
                    $('#icon-show i').toggleClass('bi-toggle-off bi-toggle-on');
                });

                // 02. Text to speech question
                let voices = [];

                function populateVoices() {
                    voices = window.speechSynthesis.getVoices();
                    // Optional: log danh sách giọng để thử nghiệm
                    console.log("Danh sách giọng:", voices);
                }

                if ('speechSynthesis' in window) {
                    // window.speechSynthesis.onvoiceschanged = populateVoices;
                    // Tự động phát âm thanh
                    window.speechSynthesis.onvoiceschanged = function() {
                        populateVoices();
                        // 🔊 Tự động phát âm câu hỏi khi vừa load
                        setTimeout(() => {
                            $('#icon-audio-question').trigger('click');
                        }, 200);
                    };
                }

                function getVoiceByLangOrName(preferredLang = 'en-US', preferredName = null) {
                    return voices.find(voice =>
                        (preferredName && voice.name.includes(preferredName)) ||
                        (!preferredName && voice.lang === preferredLang)
                    );
                }

                // Event question click
                $('#icon-audio-question').on('click', function() {
                    const text = $('#n400-question').text().trim();

                    if ('speechSynthesis' in window) {
                        const utterance = new SpeechSynthesisUtterance(text);
                        utterance.lang = 'en-US';
                        utterance.rate = 0.8;

                        const selectedVoice = getVoiceByLangOrName('en-US',
                            'Google US English'); // hoặc null nếu chỉ muốn theo lang
                        if (selectedVoice) {
                            utterance.voice = selectedVoice;
                        }

                        window.speechSynthesis.cancel();
                        window.speechSynthesis.speak(utterance);
                    } else {
                        alert("Trình duyệt không hỗ trợ phát âm");
                    }
                });
                // Event answer click
                $('#speak-btn').on('click', function() {
                    const text = $('#answer').text().trim();

                    if ('speechSynthesis' in window) {
                        const utterance = new SpeechSynthesisUtterance(text);
                        utterance.lang = 'en-US';
                        utterance.rate = 0.8;

                        const selectedVoice = getVoiceByLangOrName('en-US',
                            'Google US English'); // hoặc null nếu chỉ muốn theo lang
                        if (selectedVoice) {
                            utterance.voice = selectedVoice;
                        }

                        window.speechSynthesis.cancel();
                        window.speechSynthesis.speak(utterance);
                    } else {
                        alert("Trình duyệt không hỗ trợ phát âm");
                    }

                });
                // 02.[END] -  Text to speech question

                // 03. Toggle chế độ chỉnh sửa
                $('#toggle-edit-btn').on('click', function() {
                    $('#answer').prop('readonly', false).focus().addClass('editable');
                    $('#toggle-edit-btn').addClass('d-none');
                    $('#save-btn').removeClass('d-none');
                })
                // [END] 03. Toggle chế độ chỉnh sửa

                // Gửi AJAX updateAnswer
                $('#save-btn').on('click', function() {
                    const answerText = $('#answer').val().trim();
                    const questionId = $('#answer').data('id-question');

                    if (answerText === '') {
                        alert('Nội dung không được để trống');
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('n400.updateAnswer') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            question_id: questionId,
                            content: answerText,
                        },
                        success: function(res) {
                            if (res.success) {
                                $('#answer').prop('readonly', true).removeClass('editable');
                                $('#toggle-edit-btn').removeClass('d-none');
                                $('#save-btn').addClass('d-none');
                                alert("Lưu câu trả lời thành công");
                            } else {
                                alert('Cập nhật thất bại: ' + res.message)
                            }
                        },
                        error: function(xhr) {
                            alert('Lỗi server: ' + xhr.responseJSON.message);
                        }
                    });

                })
                // [END] - Gửi AJAX updateAnswer

                // AJAX addQuestion
                // Hiển thị modal và điền sẵn category_id + source
                $('#addQuestionModal').on('show.bs.modal', function(event) {
                    const button = $(event.relatedTarget);
                    $('#modal-category-id').val(button.data('category-id'));
                    $('#modal-source').val(button.data('source'));
                    $('#modal-question').val('');
                    $('#modal-answer').val('');
                });

                // Gửi AJAX
                $('#form-add-question').on('submit', function(e) {
                    e.preventDefault();

                    const categoryId = $('#modal-category-id').val();
                    const source = $('#modal-source').val();
                    const question = $('#modal-question').val().trim();
                    const answer = $('#modal-answer').val().trim();

                    // console.log(categoryId);


                    if (!question || !answer) {
                        alert('Vui lòng nhập đầy đủ!');
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('n400.storeQuestion') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            category_id: categoryId,
                            question: question,
                            answer: answer,
                            source: source
                        },
                        success: function(res) {
                            if (res.success) {
                                $('#addQuestionModal').modal('hide');
                                window.location.href = res.redirect_to;
                            }
                        },
                        error: function(xhr) {
                            alert('Lỗi khi thêm: ' + (xhr.responseJSON.message || 'Không rõ lỗi'));
                        }
                    });
                });
                // [END] AJAX addQuestion

                // Xử lý submit modal chỉnh sửa câu hỏi
                $('#form-edit-question').on('submit', function(e) {
                    e.preventDefault();

                    const questionId = $('#edit-question-id').val();
                    const newContent = $('#edit-question-content').val().trim();

                    if (!newContent) {
                        alert('Nội dung câu hỏi không được để trống');
                        return;
                    }

                    $.post('{{ route('n400.updateQuestion') }}', {
                        _token: '{{ csrf_token() }}',
                        question_id: questionId,
                        content: newContent
                    }, function(res) {
                        if (res.success) {
                            $('#editQuestionModal').modal('hide');
                            $('#n400-question').text(newContent);
                            alert('Cập nhật câu hỏi thành công');
                        }
                    }).fail(function(xhr) {
                        alert('Lỗi cập nhật: ' + xhr.responseJSON.message);
                    });
                });

                // [END] - Chỉnh sửa câu hỏi

                // Xóa câu hỏi
                $('#delete-question-btn').on('click', function() {
                    if (!confirm('Bạn có chắc muốn xóa câu hỏi này?')) return;

                    $.ajax({
                        url: '{{ route('n400.deleteQuestion', $question->id) }}',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.success) {
                                alert('Đã xóa câu hỏi');
                                window.location.href = res.redirect_to;
                            }
                        },
                        error: function(xhr) {
                            alert('Lỗi xóa: ' + xhr.responseJSON.message);
                        }
                    });
                });
                // [END] Xóa câu hỏi

            });
        </script>
    @endsection
