@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('/public/css/n400.css') }}">

    <div class="container max-w-2xl mx-auto px-4 py-6">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-end mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}"
                    class="btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center"
                    title="Quay về trang chủ" style="width: 48px; height: 48px;">
                    <i class="bi bi-arrow-left-circle-fill fs-3"></i>
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="text-2xl font-bold text-gray-800"> PHỎNG VẤN & N400</h3>
            </div>
        </div>
        {{-- Body --}}
        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-10 col-md-6">
                            <a class="text-dark text-decoration-none"
                                href="{{ route('n400.category.show', $category->id) }}">
                                <strong>{{ $loop->iteration }}. {{ $category->title_en }}</strong>
                                <span class="text-muted">({{ $category->questions_count }})</span>
                            </a>
                        </div>
                        <div class="col-2 col-md-6 text-end">
                            {{-- Nút + để thêm câu hỏi --}}
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addQuestionModal" data-category-id="{{ $category->id }}"
                                data-source="list">
                                <i class="bi bi-plus"></i>
                            </button>

                            {{-- Nút chuyển đến chuyên mục --}}
                            <a href="{{ route('n400.category.show', $category->id) }}"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // 04. AJAX addQuestion
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
        });
    </script>
@endsection
