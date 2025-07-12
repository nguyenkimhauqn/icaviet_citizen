@extends('layouts.base-test')

@section('title', 'Kết quả bài thi thử')

@section('content')
    <h3 class="result-title">Mock Test</h3>
    <h1 class="result-subtitle">KẾT QUẢ BÀI THI THỬ</h1>

    <div class="accordion custom-accordion" id="resultsAccordion">
        @foreach ($results as $index => $result)
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <div class="d-flex align-items-center">
                                @php
                                    switch ($result['slug']) {
                                        case 'civics':
                                            $icon = 'public/icon/mockTests/civics.svg';
                                            break;
                                        case 'reading':
                                            $icon = 'public/icon/mockTests/reading.svg';
                                            break;
                                        case 'writing':
                                            $icon = 'public/icon/mockTests/writing.svg';
                                            break;
                                        case 'n400':
                                            $icon = 'public/icon/mockTests/n400.svg';
                                            break;
                                        default:
                                            $icon = 'public/icon/mockTests/default.svg';
                                    }
                                @endphp

                                <img src="{{ asset($icon) }}" style="width: 32px;" alt="{{ $result['title'] }}">
                                <div class="ms-3">
                                    <div class="test-title">{!! $result['title'] !!}</div>
                                    @if ($result['slug'] !== 'n400')
                                        <div class="test-subtitle">({!! $result['vietnamese_title'] !!})</div>
                                    @endif
                                </div>
                            </div>
                            @if ($result['slug'] !== 'n400')
                                <span class="badge result-badge {{ $result['is_passed'] ? 'bg-success' : 'bg-danger' }}">
                                    {{ $result['is_passed'] ? 'Đạt' : 'Chưa Đạt' }}
                                </span>
                                <span class="mx-2 font-md {{ $result['is_passed'] ? 'text-success' : 'text-danger' }}">
                                    {{ $result['correct'] }}/{{ $result['total'] }}
                                </span>
                            @else
                                <span class="mx-2 font-md">{{ $result['total'] }}/{{ $result['total'] }}</span>
                            @endif

                        </div>
                    </button>
                </h2>
                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                    aria-labelledby="heading{{ $index }}" data-bs-parent="#resultsAccordion">
                    <div class="accordion-body">
                        @if (!empty($result['details']))
                            @foreach ($result['details'] as $i => $detail)
                                <div class="p-3 border rounded mb-3 bg-light">
                                    <div class="font-sm question-box">
                                        {!! $detail['question'] !!}
                                        @if ($detail['vietnamese_question'])
                                            <p class="font-very-sm-italic mb-1">Dịch: {!! $detail['vietnamese_question'] !!}</p>
                                        @endif
                                    </div>

                                    <div class="answer-box">
                                        @php
                                            $dynamicAnswer = $detail['correct_answer'];
                                            if (
                                                isset($detail['question_id']) &&
                                                in_array($detail['question_id'], [20, 23, 43, 44]) &&
                                                isset($representativeData)
                                            ) {
                                                switch ($detail['question_id']) {
                                                    case 20:
                                                        $senators = $representativeData->senators ?? [];
                                                        if (is_array($senators) && count($senators) > 0) {
                                                            $dynamicAnswer =
                                                                $senators[0]['first_name'] .
                                                                ' ' .
                                                                $senators[0]['last_name'];
                                                        }
                                                        break;
                                                    case 23:
                                                        $rep = $representativeData->representative ?? null;
                                                        if (is_array($rep)) {
                                                            $dynamicAnswer =
                                                                $rep['first_name'] . ' ' . $rep['last_name'];
                                                        }
                                                        break;
                                                    case 43:
                                                        $gov = $representativeData->governor ?? null;
                                                        if (is_array($gov)) {
                                                            $dynamicAnswer =
                                                                $gov['first_name'] . ' ' . $gov['last_name'];
                                                        }
                                                        break;
                                                    case 44:
                                                        $dynamicAnswer =
                                                            $representativeData->capital ?? $detail['correct_answer'];
                                                        break;
                                                }
                                            }
                                        @endphp

                                        @if ($detail['is_correct'])
                                            <div class="d-flex align-items-center gap-2 font-sm">
                                                <img src="{{ asset('public/icon/mockTests/success.svg') }}" alt="Success">
                                                <p class="text-success m-0">
                                                    {{ $dynamicAnswer }}
                                                    {{-- @if ($detail['question_id'] == 20)
                                                        <br><a href="https://senate.gov" target="_blank">Tra cứu tại
                                                            senate.gov</a>
                                                    @elseif ($detail['question_id'] == 23)
                                                        <br><a href="https://house.gov" target="_blank">Tra cứu tại
                                                            house.gov</a>
                                                    @elseif ($detail['question_id'] == 43)
                                                        <br><a href="https://usa.gov/state-governor" target="_blank">Tra cứu
                                                            tại usa.gov/state-governor</a>
                                                    @endif
                                                </p> --}}
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center gap-2 mb-2 font-sm">
                                                <img src="{{ asset('public/icon/mockTests/error.svg') }}" alt="Error">
                                                <p class="text-danger m-0">{{ $detail['user_answer'] }}</p>
                                            </div>

                                            <div class="d-flex align-items-center gap-2 font-sm">
                                                <img src="{{ asset('public/icon/mockTests/success.svg') }}" alt="Success">
                                                <p class="text-success m-0">
                                                    {{ $dynamicAnswer }}
                                                    @if ($detail['question_id'] == 20)
                                                        <br><a href="https://senate.gov" target="_blank">Tra cứu tại
                                                            senate.gov</a>
                                                    @elseif ($detail['question_id'] == 23)
                                                        <br><a href="https://house.gov" target="_blank">Tra cứu tại
                                                            house.gov</a>
                                                    @elseif ($detail['question_id'] == 43)
                                                        <br><a href="https://usa.gov/state-governor" target="_blank">Tra cứu
                                                            tại usa.gov/state-governor</a>
                                                    @endif
                                                </p>
                                            </div>
                                        @endif

                                        @if ($detail['vietnamese_correct_answer'])
                                            <p class="font-very-sm-italic">Dịch:
                                                {{ $detail['vietnamese_correct_answer'] }}
                                            </p>
                                        @endif
                                        @if ($detail['pronunciation_suggest_answer'])
                                            <p class="font-sm"><strong>Phát âm dễ nhớ: </strong>
                                                {{ $detail['pronunciation_suggest_answer'] }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-muted">Không có câu hỏi nào trong phần thi này.</div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="test-footer">
        <div class="text-center mt-5">
            <a href="{{ route('mock-test.list') }}" class="btn btn-normal px-5 py-2">
                Tiếp tục làm bài thi thử
            </a>
            <div class="mt-2">
                <a class="text-decoration-none font-md home-link" href="{{ route('home') }}">Về trang chủ</a>
            </div>
        </div>
    </div>
@endsection
