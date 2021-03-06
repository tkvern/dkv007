@extends('layouts.plane')

@section('body')
<div class="container">
    <div class="row register">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <br /><br /><br />
            @section ('register_panel_title','量子云 用户注册')
            @section ('register_panel_body')
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>用户名</label>

                            <div class="col-md-8 col-sm-8">
                                <input 
                                    id="username" 
                                    type="text" 
                                    class="form-control" 
                                    name="username" 
                                    value="{{ old('username') }}"
                                    placeholder="请输入英文，区分大小写"
                                    required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>邮箱</label>

                            <div class="col-md-8 col-sm-8">
                                <input 
                                    id="email" 
                                    type="email" 
                                    class="form-control" 
                                    name="email" 
                                    value="{{ old('email') }}"
                                    placeholder="请输入正确的邮箱地址"
                                    required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="account_type" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>账号类型</label>
                            <div class="col-md-8 col-sm-8">
                                <select id="account_type" class="form-control" name="account_type">
                                    <option value="company">企业</option>
                                    <option value="person">个人</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>名称</label>
                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="个人或企业真实名称"
                                    required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone_number" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>联系电话</label>
                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="phone_number"
                                    type="text"
                                    class="form-control"
                                    name="phone_number"
                                    value="{{ old('phone_number') }}"
                                    placeholder="请输入大陆电话号，其他用户不可见"
                                    required>
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="country" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>国家</label>
                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="country"
                                    type="text"
                                    class="form-control"
                                    name="country"
                                    value="{{ old('country') }}"
                                    placeholder="例:中国"
                                    required>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="region" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>地区</label>
                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="region"
                                    type="text"
                                    class="form-control"
                                    name="region"
                                    value="{{ old('region') }}"
                                    placeholder="填写省、市、区等"
                                    required>
                                @if ($errors->has('region'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>地址</label>
                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="address"
                                    type="text"
                                    class="form-control"
                                    name="address"
                                    value="{{ old('address') }}"
                                    placeholder="填写街道、门牌号、楼层房间号等信息"
                                    required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>密码</label>

                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="请设置登录密码"
                                    required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>确认密码</label>
                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    placeholder="请确认登录密码"
                                    required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <label for="captcha" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>验证码</label>

                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="captcha"
                                    type="text"
                                    class="form-control"
                                    name="captcha"
                                    placeholder="请输入验证码"
                                    required
                                    autocomplete="off">

                                @if ($errors->has('captcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-sm-8 col-md-offset-4 col-sm-offset-4">
                                <img src="{{ captcha_src() }}" alt="captcha" id="captcha_img" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-sm-8 col-md-offset-4 col-sm-offset-4">
                                <button type="submit" class="btn btn-md btn-primary btn-block">
                                    注册
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            
            @endsection
            @include('widgets.panel', array('as'=>'register', 'header'=>true))
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