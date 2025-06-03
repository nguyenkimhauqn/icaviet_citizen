@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-3">🔍 Nhập mã ZIP của bạn</h2>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first('zip') }}</div>
    @endif

    <form method="POST" action="{{ route('getRepresentative') }}">
        @csrf
        <input type="text" name="zip" maxlength="5" class="form-control w-25 mb-3" placeholder="Ví dụ: 90001">
        <button type="submit" class="btn btn-primary">Xem đại diện</button>
    </form>
</div>
@endsection
