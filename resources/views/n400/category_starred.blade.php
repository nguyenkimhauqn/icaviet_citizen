@extends('layouts.base-test')

@push('styles')
    <link rel="stylesheet" href="{{ asset('public/css/n400.css') }}">
@endpush

@section('content')
    {{-- Header --}}
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}"><img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" /></a>
            <h1 class="header-title">
                N-400 & NÓI (GẮN SAO)<br>
            </h1>
        </div>
    </div>
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Body --}}
    <ul class="list-group mt-2">
        @foreach ($categories as $category)
            <li class="category-item">
                <div class="row align-items-center">
                    <div class="col-10 col-md-6">
                        <a class="text-decoration-none text-dark font-sm"
                            href="{{ route('n400.category.starred', $category->id) }}">
                            {{ $category->title_en }}
                            <p class="font-sm-italic">{{ $category->title_vn }}</p>
                        </a>
                    </div>
                    <div class="col-2 col-md-6 text-end">
                        {{-- Nút chuyển đến chuyên mục --}}
                        <a href="{{ route('n400.category.starred', $category->id) }}" class="btn">
                            <img src="{{ asset('public/icon/n400/arrow-right-light.svg') }}" alt="Arrow">
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
