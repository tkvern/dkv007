@extends('layouts.dashboard')
@section('page_heading','创建活动')
@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-10 col-xs-12">
            <br /><br />
                <form class="form-horizontal" role="form" method="POST" action="/activities/store">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 col-sm-4 control-label text-right">标题</label>

                            <div class="col-md-8 col-sm-8">
                                <input 
                                    id="title" 
                                    type="text" 
                                    class="form-control" 
                                    name="title"
                                    autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 col-sm-4 control-label text-right">描述</label>

                            <div class="col-md-8 col-sm-8">
                                <textarea 
                                    id="description" 
                                    class="form-control" 
                                    name="description"
                                    rows="8"></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
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
@endsection