@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('sections/sections.sections_1') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('sections/sections.sections_1') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('layouts/main-sidebar.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('sections/sections.sections_1') }}</li>
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

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <?php flash()->addError($error); ?>
                    @endforeach
                @endif

                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('sections/sections.grade_id') }}</th>
                                <th>{{ trans('sections/sections.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td>{{ $grade -> id }}</td>
                                    <td>{{ $grade -> name }}</td>
                                    <td>
                                        <a href="{{ route('GradewithSections', $grade -> id) }}" class="btn btn-outline-info"
                                            title="{{ trans('sections/sections.show') }}">{{ trans('sections/sections.show') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->

@endsection
@section('js')
@endsection
