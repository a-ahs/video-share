@extends('auth-layout')

@section('class-body', 'sing-up-page')

@section('content')

<div id="log-in" class="site-form log-in-form">
      
    <div id="log-in-head">
      <h1>ورود</h1>
      <div id="logo"><a href="{{ route('index') }}"><img src="img/logo.png" alt=""></a></div>
  </div>
  
    <div class="form-output">
      <validation-errors></validation-errors>
      <form action="{{ route('login.store') }}" method="POST">
          @csrf
          <div class="form-group label-floating">
              <label class="control-label">ایمیل</label>
              <input class="form-control" name="email" placeholder="" type="email">
          </div>
          <div class="form-group label-floating">
              <label class="control-label">رمز عبور</label>
              <input class="form-control" name="password" placeholder="" type="password">
          </div>
          
          <div class="remember">
              <div class="checkbox">
                  <label>
                      <input name="remember" type="checkbox">
                          مرا به خاطر بسپار
                  </label>
              </div>
              <a href="#" class="forgot">رمز عبور من را فراموش کرده ام</a>
          </div>
          
          <button class="btn btn-lg btn-primary full-width">ورود</button>

        <div class="or"></div>

          <a href="{{ route('socialite.redirect', 'google') }}" class="btn btn-lg bg-google full-width btn-icon-left"><i class="fa fa-google" aria-hidden="true"></i>ورود با گوگل</a>

          <p>آیا شما یک حساب کاربری ندارید؟ <a href="{{ route('register.create') }}">ثبت نام کنید!</a> </p>
      </form>
  </div>
</div>

@endsection