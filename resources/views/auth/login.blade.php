@extends('auth.layout')
@section('form')
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form action = "#" method = "POST">
    <h3>{{__('custom.login_page')}}</h3>

    <label for="username">{{ __('custom.phone_number') }}</label>
    <input type="text" id="username">

    <button>{{ __('custom.login') }}</button>
</form>
@endsection
