@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('grades/grades.grades_1') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('grades/grades.grades_1') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('layouts/main-sidebar.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('grades/grades.grades_1') }}</li>
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

                <button type="button" class="button x-small" data-toggle="modal" data-target="#add_modal">
                    {{ trans('grades/grades.add_grade') }}
                </button>
                <button type="button" class="button x-small ml-2" id="delete_all_btn">
                    {{ trans('grades/grades.delete_selected') }}
                </button>
                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th><input name="select_all" id="select_all" type="checkbox"
                                        onclick="CheckAll('box1', this)"></th>
                                <th>#</th>
                                <th>{{ trans('grades/grades.name') }}</th>
                                <th>{{ trans('grades/grades.note') }}</th>
                                <th>{{ trans('grades/grades.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td><input type="checkbox" value="{{ $grade->id }}" class="box1"></td>
                                    <td>{{ $grade->id }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->note }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                            data-target="#edit{{ $grade->id }}"
                                            title="{{ trans('grades/grades.edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-md" data-toggle="modal"
                                            data-target="#delete{{ $grade->id }}"
                                            title="{{ trans('grades/grades.delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Start Edit -->
                                <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('grades/grades.edit_grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('EditGrade') }}" method="POST">
                                                    @csrf
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $grade->id }}">
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <label for="name_ar"
                                                                class="mr-sm-2">{{ trans('grades/grades.name_ar') }}
                                                                :</label>
                                                            <input id="name_ar" type="text" name="name_ar"
                                                                value="{{ $grade->getTranslation('name', 'ar') }}"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col mt-2 mb-2">
                                                            <label for="name_en"
                                                                class="mr-sm-2">{{ trans('grades/grades.name_en') }}
                                                                :</label>
                                                            <input id="name_en" type="text" class="form-control"
                                                                value="{{ $grade->getTranslation('name', 'en') }}"
                                                                name="name_en" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-2 mb-2">
                                                        <label for="note">{{ trans('grades/grades.note') }}
                                                            :</label>
                                                        <textarea rows="8" style="resize:none;" class="form-control" name="note" id="note">{{ $grade->note }}</textarea>
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
                                <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('grades/grades.delete_grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('DeleteGrade') }}" method="POST">
                                                    @csrf
                                                    {{ trans('grades/grades.delete_warning') }}
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $grade->id }}">
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <input type="text" disabled
                                                                value="{{ $grade->getTranslation('name', 'ar') }}, {{ $grade->getTranslation('name', 'en') }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('grades/grades.close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{ trans('grades/grades.submit') }}</button>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete -->

                                <!-- Start Delete Selected -->
                                <div class="modal fade" id="delete_selected" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('grades/grades.delete_grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('DeleteSelectedGrades') }}"
                                                    method="POST">
                                                    @csrf
                                                    {{ trans('grades/grades.delete_warning') }}
                                                    <input id="delete_selected_id" type="hidden"
                                                        name="delete_selected_id" class="form-control"
                                                        value="{{ $grade->id }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('grades/grades.close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{ trans('grades/grades.submit') }}</button>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ trans('grades/grades.add_grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('AddGrade') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col mt-2 mb-2">
                                <label for="name_ar" class="mr-sm-2">{{ trans('grades/grades.name_ar') }}
                                    :</label>
                                <input id="name_ar" type="text" name="name_ar" class="form-control" required>
                            </div>
                            <div class="col mt-2 mb-2">
                                <label for="name_en" class="mr-sm-2">{{ trans('grades/grades.name_en') }}
                                    :</label>
                                <input id="name_en" type="text" class="form-control" name="name_en" required>
                            </div>
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <label for="note">{{ trans('grades/grades.note') }}
                                :</label>
                            <textarea rows="8" style="resize:none;" class="form-control" name="note" id="note"></textarea>
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
