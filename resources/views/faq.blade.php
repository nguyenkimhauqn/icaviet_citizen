@extends('layouts.app')

@section('content')
    <div class="container py-5">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-end mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('civics.results.index') }}"
                    class="btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center"
                    title="Quay về trang chủ" style="width: 48px; height: 48px;">
                    <i class="bi bi-arrow-left-circle-fill fs-3"></i>
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="text-2xl font-bold text-gray-800"> CÂU HỎI THƯỜNG GẶP </h3>
            </div>
        </div>

        <div class="accordion" id="faqAccordion">

            @php
                $faqs = [
                    'Tại sao tôi được yêu cầu nhập mã zip?' =>
                        'Đây là yêu cầu bảo mật của ứng dụng để xác định khu vực.',
                    'Bài kiểm tra có gắn dấu sao là gì?' => 'Là bài kiểm tra chứa các câu hỏi bạn đã đánh dấu sao.',
                    'Câu trả lời yêu thích là gì?' =>
                        'Là các câu đúng khác kèm theo đáp án chính được hiển thị sau khi trả lời đúng.',
                    'Tôi phải đạt được bao nhiêu điểm để vượt qua bài kiểm tra?' =>
                        'Bạn cần ít nhất 60% câu đúng để vượt qua.',
                    'Nội dung hiển thị trong Citizen Now có nguồn gốc từ đâu?' =>
                        'Từ bộ 100 câu hỏi chính thức của Sở Di trú Hoa Kỳ (USCIS).',
                    'Liệu tôi có vượt qua bài kiểm tra quốc tịch nếu tôi sử dụng Ứng dụng này không?' =>
                        'Ứng dụng hỗ trợ luyện tập, không đảm bảo 100% bạn sẽ vượt qua.',
                    'Tôi có thể làm gì nếu phát hiện lỗi trong Ứng dụng?' =>
                        'Vui lòng liên hệ bộ phận hỗ trợ để phản hồi lỗi.',
                ];
            @endphp

            @foreach ($faqs as $question => $answer)
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="heading{{ $loop->index }}">
                        <button class="accordion-button collapsed fw-bold text-primary" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false"
                            aria-controls="collapse{{ $loop->index }}">
                            {{ $question }}
                        </button>
                    </h2>
                    <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {{ $answer }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
