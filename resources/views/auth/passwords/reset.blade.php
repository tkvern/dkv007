@extends('layouts.plane')

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <br /><br /><br />
            @section ('reset_panel_title','量子云 重置密码')
            @section ('reset_panel_body')
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form role="form" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <fieldset>
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input
                                id="email"
                                type="email"
                                class="form-control"
                                name="email"
                                value="{{ $email or old('email') }}"
                                placeholder="邮箱地址"
                                required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input
                                id="password"
                                type="password"
                                class="form-control"
                                name="password"
                                placeholder="新密码"
                                required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input
                                id="password-confirm"
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                placeholder="确认新密码"
                                required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                重置密码
                            </button>
                        </div>
                    </fieldset>
                </form>
            @endsection
            @include('widgets.panel', array('as'=>'reset', 'header'=>true))
        </div>
    </div>
</div>
@endsection
