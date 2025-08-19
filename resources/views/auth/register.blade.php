@extends('auth.layout')
@section('form')
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form class ="long_form" action="#" method="POST">
    @csrf
    <h3>{{__('custom.register_page')}}</h3>

    <span>
        <label for="name">{{ __('custom.name') }}</label>
        <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror">

        @error('name')
        <div>{{ $message }}</div>
        @enderror
    </span>
    <span>
        <label for="last_name">{{ __('custom.last_name') }}</label>
        <input type="text" id="last_name" name="last_name" class="@error('last_name') is-invalid @enderror">

        @error('last_name')
        <div>{{ $message }}</div>
        @enderror
    </span>
    <span>
        <label for="national_code">{{ __('custom.national_code') }}</label>
        <input type="text" id="national_code" name="national_code" class="@error('national_code') is-invalid @enderror">

        @error('national_code')
        <div>{{ $message }}</div>
        @enderror
    </span>
    <span>
        <label for="password">{{ __('custom.password') }}</label>
        <input type="text" id="password" name="password" class="@error('password') is-invalid @enderror">

        @error('password')
        <div>{{ $message }}</div>
        @enderror
    </span>
    <span>
        <label for="confirm_password">{{ __('custom.confirm_password') }}</label>
        <input type="text" id="confirm_password" name="confirm_password" class="@error('confirm_password') is-invalid @enderror">

        @error('confirm_password')
        <div>{{ $message }}</div>
        @enderror
    </span>
    <button>{{ __('custom.register') }}</button>
</form>
@endsection
