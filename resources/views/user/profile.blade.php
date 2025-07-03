@extends('layouts.app')

@section('content')
    <!-- Nhúng file CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/profile.css') }}">

    <div class="wp-profile">

        {{-- Hồ sơ người dùng --}}
        <div class="wp-img">
            <img src="{{ $user->avatar ?? asset('public/image/avt_user.jpg') }}" alt="avatar">
            <p class="fullname">{{ $user->name ?? '' }}</p>
        </div>

        {{-- Thông báo --}}
        @if (session('success'))
            <div class="alert-success">
                <div class="icon">
                    <img src="{{ url('public/icon/profile/icon_tick.png') }}" alt="">
                </div>
                <div class="message">Đã xóa dữ liệu</div>
            </div>
        @endif

        {{-- Các lựa chọn --}}
        <div class="settings-box">
            <div class="settings-item">
                <img src="{{ url('public/icon/profile/icon_change_zip.png') }}" class="icon" alt="USA Icon">
                <div class="content">
                    <a href="" class="title">Zip Code của bạn</a>
                    <div class="sub">68014</div>
                </div>
            </div>
            <div class="settings-item">
                <img src="{{ url('public/icon/profile/icon_trash.png') }}" class="icon" alt="Trash Icon">
                <div class="content">
                    <a href="" onclick="confirmDelete(event)" class="title">Xóa dữ
                        liệu đã học</a>
                </div>
                <form id="delete-data-form" action="{{ route('user.deleteLearnedData') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
            </div>
            <div class="settings-item">
                <img src="{{ url('public/icon/profile/icon_connect.png') }}" class="icon" alt="Support Icon">
                <div class="content">
                    <a href="" class="title">Liên hệ/hỗ trợ</a>
                </div>
            </div>
        </div>

        {{-- Các mục phụ --}}
        <div class="link-box">
            <a href="#" class="link-item">
                <span>Về chúng tôi</span>
                <span class="arrow"><i class="bi bi-chevron-right"></i></span>
            </a>
            <a href="#" class="link-item">
                <span>Điều khoản về dịch vụ</span>
                <span class="arrow"><i class="bi bi-chevron-right"></i></span>
            </a>
            <a href="#" class="link-item">
                <span>Chính sách bảo mật</span>
                <span class="arrow"><i class="bi bi-chevron-right"></i></span>
            </a>
        </div>


        {{-- Đăng xuất --}}
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">Đăng xuất</button>
        </form>

    </div>
@endsection

@section('script')
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Ngăn điều hướng khi bấm <a>

            if (confirm("Bạn có chắc chắn muốn xóa toàn bộ dữ liệu đã học? Hành động này không thể hoàn tác.")) {
                document.getElementById('delete-data-form').submit();
            }
        }
    </script>
@endsection
