@extends('auth-layout')

@section('content')

<div id="log-in" class="site-form log-in-form">
    
    @include('errors.messages')
    <div id="log-in-head">
        <h1>تاییدیه ایمیل</h1>
        <div id="logo"><a href="{{ route('index') }}"><img src="img/logo.png" alt=""></a></div>
    </div>

    <div class="mb-4 text-sm text-gray-600" style="padding: 10px">
        با تشکر از ثبت نام شما،جهت استفاده از تمامی امکانات سایت نیاز میباشد که
        ایمیل خود را تایید کنید.
    </div>
    <div class="form-output">
        <x-validations-errors></x-validations-errors>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-lg btn-primary full-width">ارسال ایمیل تاییدیه</button>
        </form>
    </div>
</div>
@endsection