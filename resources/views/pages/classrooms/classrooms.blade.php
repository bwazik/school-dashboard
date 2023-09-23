@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('classrooms/classrooms.classrooms_1') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('classrooms/classrooms.classrooms_1') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('layouts/main-sidebar.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('classrooms/classrooms.classrooms_1') }}</li>
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

                    <button type="button" class="button x-small ml-2" data-toggle="modal" data-target="#add_modal">
                        {{ trans('classrooms/classrooms.add_classroom') }}
                    </button>
                    <button type="button" class="button x-small ml-2 " id="delete_all_btn">
                        {{ trans('classrooms/classrooms.delete_selected') }}
                    </button>
                    <form style="display: inline-flex" class="ml-2" action="{{ route('FilterClassrooms') }}" method="POST">
                        @csrf
                        <select class="fancyselect" data-style="btn-info" name="grade_id" required
                                onchange="this.form.submit()">
                            <option value="" selected disabled>{{ trans('classrooms/classrooms.search') }}</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade -> id }}">{{ $grade -> name }}</option>
                            @endforeach
                        </select>
                    </form>    
    
                    <br><br>
                

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th><input name="select_all" id="select_all" type="checkbox"
                                        onclick="CheckAll('box1', this)"></th>
                                <th>#</th>
                                <th>{{ trans('classrooms/classrooms.name') }}</th>
                                <th>{{ trans('classrooms/classrooms.grade_id') }}</th>
                                <th>{{ trans('classrooms/classrooms.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (isset($details))
                                <?php $classrooms = $details; ?>
                            @else
                                <?php $classrooms = $classrooms; ?>
                            @endif   

                            @foreach ($classrooms as $classroom)
                                <tr>
                                    <td><input type="checkbox" value="{{ $classroom->id }}" class="box1"></td>
                                    <td>{{ $classroom->id }}</td>
                                    <td>{{ $classroom->name }}</td>
                                    <td>{{ $classroom->grade->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                            data-target="#edit{{ $classroom->id }}"
                                            title="{{ trans('classrooms/classrooms.edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-md" data-toggle="modal"
                                            data-target="#delete{{ $classroom->id }}"
                                            title="{{ trans('classrooms/classrooms.delete') }}"><i
                                                class="fa fa-trash"></i></button>

                                    </td>
                                </tr>

                                <!-- Start Edit -->
                                <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('classrooms/classrooms.edit_classroom') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form class="row" action="{{ route('EditClassroom') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $classroom->id }}">
                                                    <div class="card-body">
                                                        <div class="repeater">
                                                            <div data-repeater-list="classrooms_list">
                                                                <div data-repeater-item>
                                                                    <div class="row">
                                                                        <div class="col mt-2 mb-2">
                                                                            <label for="name_ar"
                                                                                class="mr-sm-2">{{ trans('classrooms/classrooms.name_ar') }}
                                                                                :</label>
                                                                            <input id="name_ar" class="form-control"
                                                                                value="{{ $classroom->getTranslation('name', 'ar') }}"
                                                                                type="text" name="name_ar"
                                                                                required />
                                                                        </div>
                                                                        <div class="col mt-2 mb-2">
                                                                            <label for="name_en"
                                                                                class="mr-sm-2">{{ trans('classrooms/classrooms.name_en') }}
                                                                                :</label>
                                                                            <input id="name_en" class="form-control"
                                                                                value="{{ $classroom->getTranslation('name', 'en') }}"
                                                                                type="text" name="name_en"
                                                                                required />
                                                                        </div>
                                                                        <div class="col mt-2 mb-2">
                                                                            <label for="grade_id"
                                                                                class="mr-sm-2">{{ trans('classrooms/classrooms.grade_id') }}
                                                                                :</label>
                                                                            <div class="box">
                                                                                <select class="fancyselect"
                                                                                    name="grade_id">
                                                                                    @foreach ($grades as $grade)
                                                                                        <option
                                                                                            value="{{ $grade->id }}"
                                                                                            {{ $grade->id == $classroom->grade_id ? 'selected' : '' }}>
                                                                                            {{ $grade->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('grades/grades.close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-success">{{ trans('grades/grades.submit') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit -->

                                <!-- Start Delete -->
                                <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('classrooms/classrooms.delete_classroom') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('DeleteClassroom') }}" method="POST">
                                                    @csrf
                                                    {{ trans('classrooms/classrooms.delete_warning') }}
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $classroom->id }}">
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <input type="text" disabled
                                                                value="{{ $classroom->getTranslation('name', 'ar') }}, {{ $classroom->getTranslation('name', 'en') }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('classrooms/classrooms.close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{ trans('classrooms/classrooms.submit') }}</button>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete -->

                                <!-- Start Delete Selected -->
                                <div class="modal fade" id="delete_selected" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('classrooms/classrooms.delete_classroom') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('DeleteSelectedClassrooms') }}" method="POST">
                                                    @csrf
                                                    {{ trans('classrooms/classrooms.delete_warning') }}
                                                    <input id="delete_selected_id" type="hidden" name="delete_selected_id"
                                                        class="form-control" value="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('classrooms/classrooms.close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{ trans('classrooms/classrooms.submit') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete Selected-->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Start Add -->
    <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ trans('classrooms/classrooms.add_classroom') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form class="row" action="{{ route('AddClassroom') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="classrooms_list">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="col mt-2 mb-2">
                                                <label for="name_ar"
                                                    class="mr-sm-2">{{ trans('classrooms/classrooms.name_ar') }}
                                                    :</label>
                                                <input id="name_ar" class="form-control" type="text"
                                                    name="name_ar" />
                                            </div>
                                            <div class="col mt-2 mb-2">
                                                <label for="name_en"
                                                    class="mr-sm-2">{{ trans('classrooms/classrooms.name_en') }}
                                                    :</label>
                                                <input id="name_en" class="form-control" type="text"
                                                    name="name_en" />
                                            </div>
                                            <div class="col mt-2 mb-2">
                                                <label for="grade_id"
                                                    class="mr-sm-2">{{ trans('classrooms/classrooms.grade_id') }}
                                                    :</label>
                                                <div class="box">
                                                    <select id="grade_id" class="fancyselect" name="grade_id">
                                                        @foreach ($grades as $grade)
                                                            <option value="{{ $grade->id }}">{{ $grade->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col mt-2 mb-2">
                                                <label for="delete_row"
                                                    class="mr-sm-2">{{ trans('classrooms/classrooms.processes') }}
                                                    :</label>
                                                <input id="delete_row" class="btn btn-danger btn-block"
                                                    data-repeater-delete type="button"
                                                    value="{{ trans('classrooms/classrooms.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                            value="{{ trans('classrooms/classrooms.add_row') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('grades/grades.close') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('grades/grades.submit') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add -->

</div>
<!-- row closed -->

@endsection
@section('js')
@endsection
