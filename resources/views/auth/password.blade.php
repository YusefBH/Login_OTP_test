@extends('auth.layout')
@section('form')
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form action="{{ route('login.password.submit', app()->getLocale()) }}" method="POST">
    @csrf
    <h3>{{__('custom.login_page')}}</h3>

    <label for="password">{{ __('custom.password') }}</label>
    <input type="text" id="password" name="password" class="@error('password') is-invalid @enderror">

    @error('password')
    <div>{{ $message }}</div>
    @enderror

    <button>{{ __('custom.login') }}</button>
</form>
@endsection
