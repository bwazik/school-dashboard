@extends('layouts.master')
@section('css')
    @livewireStyles
    <style>
        .nice-select{
            width : 100% !important;
        }
        .nice-select.open .list{
            width: 100% !important;
        }
    </style>
@section('title')
    {{ trans('fees/add.fees_add') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('fees/add.fees_add') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('layouts/main-sidebar.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('fees/add.fees_add') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <livewire:fees.add-fee />
            </div>
        </div>
    </div>
</div>
<!-- row closed -->

@endsection
@section('js')
    @livewireScripts
@endsection
