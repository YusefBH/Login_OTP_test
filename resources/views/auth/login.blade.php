@extends('auth.layout')
@section('form')
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form action="{{ route('login.submit', app()->getLocale()) }}" method="POST">
    @csrf
    <h3>{{__('custom.login_page')}}</h3>

    <label for="phone_number">{{ __('custom.phone_number') }}</label>
    <input type="text" id="phone_number" name="phone_number" class="@error('phone_number') is-invalid @enderror">

    @error('phone_number')
    <div>{{ $message }}</div>
    @enderror

    <button>{{ __('custom.login') }}</button>
</form>
@endsection
