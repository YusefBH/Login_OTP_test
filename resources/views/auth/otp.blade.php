@extends('auth.layout')
@section('form')
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form action="{{ route('register.otp.verify', app()->getLocale()) }}" method="POST">
    @csrf
    <h3>{{__('custom.register_page')}}</h3>

    <label for="otp">{{ __('custom.otp') }}</label>
    <input type="text" id="otp" name="otp" class="@error('otp') is-invalid @enderror">

    @error('otp')
    <div>{{ $message }}</div>
    @enderror

    <button>{{ __('custom.register') }}</button>
</form>
@endsection
