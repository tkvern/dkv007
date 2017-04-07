@extends('layouts.plane')

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <br /><br /><br />
            @section ('login_panel_title','量子云 用户登录')
            @section ('login_panel_body')
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <fieldset>
                        <div class="form-group{{ $errors->has('account') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input
                                    id="account"
                                    type="text"
                                    class="form-control"
                                    name="account"
                                    value="{{ old('account') }}"
                                    placeholder="用户名或邮箱"
                                    required autofocus>

                                @if ($errors->has('account'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('account') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input
                                    id="password" 
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="密码"
                                    required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-xs-6">
                                <input
                                    id="captcha"
                                    type="text"
                                    class="form-control"
                                    name="captcha"
                                    placeholder="验证码"
                                    required>
                                @if ($errors->has('captcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <img class="control-label col-md-5 col-xs-5" src="{{ captcha_src() }}" alt="captcha" id="captcha_img" />
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->

                        <div class="form-group">
                            <div class="col-md-12">

                                <a class="btn btn-link forget-password" href="{{ route('password.request') }}">
                                    忘记密码?
                                </a>
                                <button type="submit" class="btn btn-md btn-primary btn-block">
                                    登录
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            @endsection
            @include('widgets.panel', array('as'=>'login', 'header'=>true))
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#captcha_img').on('click', function() {
            this.src = '{{ captcha_src() }}' + Math.random();
        });
    </script>
@endsection
