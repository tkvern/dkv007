@extends('layouts.dashboard')
@section('page_heading','修改属性')
@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-10 col-xs-12">
            <br /><br />
                <form class="form-horizontal" role="form" method="POST" action="{{ $image->path() }}/update">
                    {{ csrf_field() }}
                    <input type="hidden" name="activity_no" value="{{$image->activity_no}}">
                    <fieldset>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 col-sm-4 control-label text-right">标题</label>

                            <div class="col-md-8 col-sm-8">
                                <input 
                                    id="title" 
                                    type="text" 
                                    class="form-control" 
                                    name="title" 
                                    value="{{ old('title', $image->title) }}"
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
                                    rows="8">{{ old('description', $image->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-4 col-sm-4 control-label text-right">序号</label>

                            <div class="col-md-8 col-sm-8">
                                <input 
                                    id="number" 
                                    type="number"
                                    min="0"
                                    class="form-control" 
                                    name="number" 
                                    value="{{ old('number', $image->number) }}"
                                    autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 col-sm-4 control-label text-right">开启</label>

                            <div class="col-md-8 col-sm-8">

                              @if ($image->public == 0)
                                <label class="radio-inline">
                                  <input type="radio" name="public" id="inlineRadio1" value="0" checked> 否
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="public" id="inlineRadio2" value="1" > 是
                                </label>
                              @elseif ($image->public == 1)
                                <label class="radio-inline">
                                  <input type="radio" name="public" id="inlineRadio1" value="0"> 否
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="public" id="inlineRadio2" value="1" checked> 是
                                </label>
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

@section('script')
    <script>
        $("#inlineRadio{{$image->size_no}}").attr('checked', true);
    </script>
@stop