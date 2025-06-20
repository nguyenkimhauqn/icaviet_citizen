@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white flex items-center justify-center px-4 py-8 mt-4">
        <div class="w-full max-w-sm">
            {{-- Tiêu đề --}}
            <h4 class="text-center">
                Nhập ZIP code nơi ở của bạn
            </h4>

            {{-- Form nhập mã ZIP --}}
            <form method="POST" action="{{ route('getRepresentative') }}" class="text-center">
                @csrf
                <div class="box-input">
                    <input type="text" name="zip" maxlength="5" inputmode="numeric" pattern="\d{5}" required
                        class="zip-input fs-3 form-control text-center text-xl font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                        placeholder="" />
                </div>

                @error('zip')
                    <p class="fs-5 text-red-600 text-sm mb-3 text-danger">{{ $message . '!' }}</p>
                @enderror
                {{-- Mô tả --}}
                <p class="text-center text-sm text-gray-700 leading-relaxed mb-6">
                    ZIP Code sẽ được sử dụng để tra cứu Thượng nghị sĩ (<strong class="font-semibold italic">U.S.
                        Senators</strong>),
                    Dân biểu của Hạ viện (<strong class="font-semibold italic">U.S. Representative</strong>),
                    Thống đốc (<strong class="font-semibold italic">Governor</strong>) và thủ phủ của tiểu bang
                    (<strong class="font-semibold italic">State Capital</strong>) trong khu vực bạn sống nhằm phục vụ cho
                    mục
                    đích học tập.
                </p>

                <button type="submit" class="btn btn-primary d-inline-flex align-items-center justify-content-center"
                    id="submitBtn">
                    <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"
                        id="spinner"></span>
                    <span id="btnText">Tiếp theo</span>
                </button>
            </form>
        </div>
    </div>
    <style>
        .wp-content {
            margin: 0 auto;
            padding: 0 16px;
            max-width: 440px;
            box-sizing: border-box;
        }

        h4 {
            font-size: 22px !important;
            text-transform: uppercase;
            margin-top: 50px;
        }

        .box-input {
            margin: 20px 5px;
        }

        .zip-input {
            max-width: 332px;
            height: 59px;
            display: block;
            margin: 0 auto;
            align-items: center;
            background-color: #F8F7FB;
        }

        strong.italic {
            font-style: italic;
            font-weight: 600;
        }

        .btn-primary {
            padding: 15px 40px;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // alert(1);
            $(document).on('click', '#submitBtn', function() {
                $('#spinner').removeClass('d-none');
                $('#btnText').text('Đang xử lý...');
            });
        });
    </script>
@endsection
