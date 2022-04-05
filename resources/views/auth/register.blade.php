@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('会員登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-4">
                            <label for="name" class="col-md-3 col-form-label text-md-end">
                                <!-- {{ __('名前') }} -->
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="名前">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="email" class="col-md-3 col-form-label text-md-end">
                                <!-- {{ __('メールアドレス') }} -->
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password" class="col-md-3 col-form-label text-md-end">
                                <!-- {{ __('パスワード') }} -->
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" 　 placeholder="パスワード">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-end">
                                <!-- {{ __('確認用パスワード') }} -->
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="確認用パスワード">
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-3 col-form-label text-md-end">
                            </div>
                            <div class="col-md-6 d-grid gap-2">
                                <button type="submit" class="col-form-label btn btn-primary">
                                    {{ __('会員登録') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row mb-3">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6 text-center mt-4">
                            アカウントをお持ちの方はこちらから
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-3">
                        </div>
                        <a class="nav-link col-md-6 text-center" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection