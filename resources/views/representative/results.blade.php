@extends('layouts.app')

@section('content')
    <div class="container text-center">

        <h3 class="titleState fs-2"> {{ $state }}<br><span class="fw-bold fs-4">{{ $zip }}</span></h3>

        {{-- Đại diện Hạ viện --}}
        <div class="card-box my-3 p-3">
            <h5 class=" text-primary"> <strong> Representative </strong> (Dân biểu) </h5>
            <a class="link-website" href="https://www.house.gov" target="_blank">www.house.gov</a>
            @if ($representative)
                <div class="d-flex align-items-center mt-2">
                    <img src="{{ $representative['photo_origin_url'] ?? 'https://via.placeholder.com/80' }}" alt="Rep"
                        class="rounded shadow-sm" width="100" height="100">
                    <div class="ms-3 text-start align-items-start">
                        <h6 class="mb-1">{{ $representative['first_name'] }} {{ $representative['last_name'] }}</h6>
                        <p class="mb-0">{{ $representative['party'] }}</p>
                        <p class="mb-0 fst-italic">
                            {{ Str::contains($representative['party'], 'Republican') ? '(Đảng Cộng hòa)' : '(Đảng Dân chủ)' }}
                        </p>
                    </div>
                </div>
            @else
                <p>Không tìm thấy.</p>
            @endif
        </div>

        {{-- Thượng nghị sĩ --}}
        <div class="card-box my-3 p-3">
            <h5 class="text-primary"> <strong> Senators </strong> (Thượng nghị sĩ) </h5>
            <a class="link-website" href="https://www.senate.gov" target="_blank">www.senate.gov</a>
            @forelse($senators as $senator)
                <div class="d-flex align-items-center mt-2">
                    <img src="{{ $senator['photo_origin_url'] ?? 'https://via.placeholder.com/80' }}" alt="Senator"
                        class="rounded shadow-sm" width="100" height="100">
                    <div class="ms-3 text-start">
                        <h6 class="mb-1">{{ $senator['first_name'] }} {{ $senator['last_name'] }}</h6>
                        <p class="mb-0">{{ $senator['party'] }}</p>
                        <p class="mb-0 fst-italic">
                            {{ Str::contains($senator['party'], 'Republican') ? '(Đảng Cộng hòa)' : '(Đảng Dân chủ)' }}
                        </p>
                    </div>
                </div>
            @empty
                <p>Không tìm thấy.</p>
            @endforelse
        </div>

        {{-- Thống đốc --}}
        <div class="card-box my-3 p-3">
            <h5 class="text-primary"> <strong> Governor </strong> (Thống đốc)</h5>
            <a class="link-website" href="https://www.nga.org/governors" target="_blank">www.nga.org/governors</a>
            @if ($governor)
                <div class="d-flex align-items-center mt-2">
                    <img src="{{ $governor['photo_origin_url'] ?? 'https://via.placeholder.com/80' }}" alt="Governor"
                        class="rounded shadow-sm" width="100" height="100">
                    <div class="ms-3 text-start">
                        <h6 class="mb-1">{{ $governor['first_name'] }} {{ $governor['last_name'] }}</h6>
                        <p class="mb-0">{{ $governor['party'] }}</p>
                        <p class="mb-0 fst-italic">
                            {{ Str::contains($senator['party'], 'Republican') ? '(Đảng Cộng hòa)' : '(Đảng Dân chủ)' }}
                        </p>
                    </div>
                </div>
            @else
                <p>Không tìm thấy.</p>
            @endif
        </div>

        <a href="{{ route('home') }}" class="btn btn-primary">Tiếp theo </a>

    </div>
    <style>
        .wp-content {
            background-color: #F5F4FAE5;
        }

        .titleState {
            padding-top: 40px;
            text-transform: uppercase;
        }

        .card-box {
            background-color: #FFFFFF;
            border: solid 1px #FFFFFF;
            border-radius: 12px;
            box-shadow: 0px 4px 5px rgba(0, 0, 0, 0.05);
        }

        a.btn.btn-primary {
            font-weight: bold; /* hoặc: 600, 700 */
            padding: 15px 40px;
            padding: 15px 40px;
            margin-top: 40px;
            margin-bottom: 50px;
        }

        .text-primary,
        .link-website {
            color: #1247BB !important;
        }

        h6 {
            font-weight: 800;
        }
    </style>
@endsection
