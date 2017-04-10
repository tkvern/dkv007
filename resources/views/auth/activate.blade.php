@extends('layouts.plane')

@section('body')
    <div class="container">
        <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <br /><br /><br />
            @section ('reset_panel_title','量子云 账号激活')
            @section ('reset_panel_body')
                @if (Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ session('flash_message') }}
                    </div>
                @endif

                @if (Session::has('flash_error_message'))
                    <div class="alert alert-error">
                        {{ session('flash_error_message') }}
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ route('user.activate_email') }}">
                    {{ csrf_field() }}

                    <fieldset>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="邮箱地址"
                                    required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-md btn-primary btn-block">
                                    发送激活邮件
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            @endsection
            @include('widgets.panel', array('as'=>'reset', 'header'=>true))
        </div>
    </div>
@endsection
