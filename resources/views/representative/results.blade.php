@extends('layouts.app')

@section('content')
<div class="container text-center">

    <h2 class="mt-4 text-uppercase text-secondary">ĐẠI DIỆN CỦA BẠN</h2>
    <p class="text-muted fs-5">Trạng thái {{ $state }}<br><span class="fw-bold fs-4">{{ $zip }}</span><br><span class=""> Thủ phủ: {{ $capital }}</span></p>

    {{-- Đại diện Hạ viện --}}
    <div class="card my-3 p-3 shadow-sm">
        <h5 class="text-uppercase fw-bold text-primary">ĐẠI DIỆN CỦA BẠN</h5>
        <a href="https://www.house.gov" target="_blank">www.house.gov</a>
        @if($representative)
            <div class="d-flex align-items-center mt-2">
                <img src="{{ $representative['photo_origin_url'] ?? 'https://via.placeholder.com/80' }}" alt="Rep" class="rounded shadow-sm" width="80" height="80">
                <div class="ms-3 text-start">
                    <h6 class="mb-1">{{ $representative['first_name'] }} {{ $representative['last_name'] }}</h6>
                    <p class="mb-0 text-muted">{{ $representative['party'] }}</p>
                </div>
            </div>
        @else
            <p>Không tìm thấy.</p>
        @endif
    </div>

    {{-- Thượng nghị sĩ --}}
    <div class="card my-3 p-3 shadow-sm">
        <h5 class="text-uppercase fw-bold text-primary">THƯỢNG NGHỊ SĨ CỦA BẠN</h5>
        <a href="https://www.senate.gov" target="_blank">www.senate.gov</a>
        @forelse($senators as $senator)
            <div class="d-flex align-items-center mt-2">
                <img src="{{ $senator['photo_origin_url'] ?? 'https://via.placeholder.com/80' }}" alt="Senator" class="rounded shadow-sm" width="80" height="80">
                <div class="ms-3 text-start">
                    <h6 class="mb-1">{{ $senator['first_name'] }} {{ $senator['last_name'] }}</h6>
                    <p class="mb-0 text-muted">{{ $senator['party'] }}</p>
                </div>
            </div>
        @empty
            <p>Không tìm thấy.</p>
        @endforelse
    </div>

    {{-- Thống đốc --}}
    <div class="card my-3 p-3 shadow-sm">
        <h5 class="text-uppercase fw-bold text-primary">THỐNG ĐỐC CỦA BẠN</h5>
        @if($governor)
            <div class="d-flex align-items-center mt-2">
                <img src="{{ $governor['photo_origin_url'] ?? 'https://via.placeholder.com/80' }}" alt="Governor" class="rounded shadow-sm" width="80" height="80">
                <div class="ms-3 text-start">
                    <h6 class="mb-1">{{ $governor['first_name'] }} {{ $governor['last_name'] }}</h6>
                    <p class="mb-0 text-muted">{{ $governor['party'] }}</p>
                </div>
            </div>
        @else
            <p>Không tìm thấy.</p>
        @endif
    </div>

    <a href="" class="btn btn-primary mt-4">🔁 KIỂM TRA CẬP NHẬT</a>

</div>
@endsection
