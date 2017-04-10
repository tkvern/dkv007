@extends('layouts.dashboard')
@section('page_heading','订单')
@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12">
                    @section ('stable_panel_title','订单列表')
                    @section ('stable_panel_body')
                        <div class="table-responsive">
                            @include('widgets.table', array('class'=>'table-bordered table-striped'))
                        </div>
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'stable'))
            </div>
        </div>
    </div>
@stop
