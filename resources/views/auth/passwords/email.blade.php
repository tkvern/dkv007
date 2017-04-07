@extends('layouts.plane')

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <br /><br /><br />
            @section ('reset_panel_title','量子云 忘记密码')
            @section ('reset_panel_body')
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
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
                                    发送重置链接
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            @endsection
            @include('widgets.panel', array('as'=>'reset', 'header'=>true))
        </div>
    </div>
</div>
@endsection
