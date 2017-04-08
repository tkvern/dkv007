@extends('layouts.dashboard')
@section('page_heading','密码管理')
@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-10 col-xs-12">
            <br /><br />
                <form class="form-horizontal" role="form" method="POST">
                    {{ csrf_field() }}
                    <fieldset>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>原密码</label>

                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="old_password"
                                    type="password"
                                    class="form-control"
                                    name="old_password"
                                    placeholder="请输入原密码"
                                    required>

                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>新密码</label>

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
                            <label for="password_confirmation" class="col-md-4 col-sm-4 control-label text-right"><span class="text-danger">*</span>确认密码</label>
                            <div class="col-md-8 col-sm-8">
                                <input
                                    id="password_confirmation"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    placeholder="请确认登录密码"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8 col-md-offset-4 col-sm-offset-4">
                                <button type="submit" class="btn btn-md btn-primary btn-block">
                                    提交
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
