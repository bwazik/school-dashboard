@extends('layouts.master')
@section('css')
<style>
.nice-select{
    width : 100% !important;
}
.nice-select.open .list{
    width: 100% !important;
}
</style>
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

                <button type="button" class="button x-small ml-2" data-toggle="modal" data-target="#add_modal">
                    {{ trans('sections/sections.add_section') }}
                </button>
                <button type="button" class="button x-small ml-2 " id="delete_all_btn">
                    {{ trans('sections/sections.delete_selected') }}
                </button>
                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th><input name="select_all" id="select_all" type="checkbox"
                                        onclick="CheckAll('box1', this)"></th>
                                <th>#</th>
                                <th>{{ trans('sections/sections.name') }}</th>
                                <th>{{ trans('sections/sections.grade_id') }}</th>
                                <th>{{ trans('sections/sections.classroom_id') }}</th>
                                <th>{{ trans('sections/sections.status') }}</th>
                                <th>{{ trans('sections/sections.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td><input type="checkbox" value="{{ $section->id }}" class="box1"></td>
                                    <td>{{ $section -> id }}</td>
                                    <td>{{ $section -> name }}</td>
                                    <td>{{ $section -> grade -> name }}</td>
                                    <td>{{ $section -> classroom -> name }}</td>
                                    <td>
                                        @if ($section -> status === 1)
                                        <label
                                            class="badge badge-success">{{ trans('sections/sections.active_true') }}</label>
                                        @else
                                        <label
                                            class="badge badge-danger">{{ trans('sections/sections.active_false') }}</label>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                            data-target="#edit{{ $section->id }}"
                                            title="{{ trans('sections/sections.edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-md" data-toggle="modal"
                                            data-target="#delete{{ $section->id }}"
                                            title="{{ trans('sections/sections.delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <!-- Start Edit -->
                                <div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('sections/sections.edit_section') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('EditSection') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $section->id }}">
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <label for="name_ar"
                                                                class="mr-sm-2">{{ trans('sections/sections.name_ar') }}
                                                                :</label>
                                                            <input id="name_ar" class="form-control"
                                                                value="{{ $section->getTranslation('name', 'ar') }}"
                                                                type="text" name="name_ar"
                                                                required />
                                                        </div>
                                                        <div class="col mt-2 mb-2">
                                                            <label for="name_en"
                                                                class="mr-sm-2">{{ trans('sections/sections.name_en') }}
                                                                :</label>
                                                            <input id="name_en" class="form-control"
                                                                value="{{ $section->getTranslation('name', 'en') }}"
                                                                type="text" name="name_en"
                                                                required />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <label for="grade_id"
                                                                class="mr-sm-2">{{ trans('sections/sections.grade_id') }}
                                                                :</label>
                                                            <div class="box">
                                                                <select id="grade_id" class="fancyselect" name="grade_id">
                                                                        <option selected value="{{ $grade -> id }}">{{ $grade -> name }}</option>
                                                                </select>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <label for="classroom_id"
                                                                class="mr-sm-2">{{ trans('sections/sections.classroom_id') }}
                                                                :</label>
                                                            <div class="box">
                                                                <select id="classroom_id" class="fancyselect" name="classroom_id">
                                                                    @foreach ($classrooms as $classroom)
                                                                        <option
                                                                        {{ $classroom -> id == $section -> classroom_id ? 'selected' : '' }}
                                                                        value="{{ $classroom -> id }}">
                                                                        {{ $classroom -> name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <label for="current_teachers"
                                                                class="mr-sm-2">{{ trans('sections/sections.current_teachers') }}
                                                                :</label>
                                                            <div class="box">
                                                                <select id="current_teachers" class="fancyselect">
                                                                    @foreach($section -> teachers as $teacher)
                                                                    <option selected disabled value="{{ $teacher['id'] }}">{{ $teacher['name'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <label for="teachers"
                                                                class="mr-sm-2">{{ trans('sections/sections.teachers') }}
                                                                :</label>
                                                            <div class="box">
                                                                <select id="teachers" class="form-control" name="teachers[]" multiple>
                                                                    @foreach($section -> teachers as $teacher)
                                                                    <option hidden selected value="{{ $teacher['id'] }}">{{ $teacher['name'] }}</option>
                                                                    @endforeach
                                                                    @foreach($teachers as $teacher)
                                                                        <option value="{{ $teacher -> id }}">{{ $teacher -> name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <label for="status"
                                                                class="mr-sm-2">{{ trans('sections/sections.status') }}
                                                                :</label>
                                                            <div class="box">
                                                                <select id="status" class="fancyselect" name="status">
                                                                    <option value="1" {{ $section -> status == 1 ? 'selected' : '' }} >{{ trans('sections/sections.active_true') }}</option>
                                                                    <option value="0" {{ $section -> status == 0 ? 'selected' : '' }} >{{ trans('sections/sections.active_false') }}</option>
                                                                </select>
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
                                <div class="modal fade" id="delete{{ $section->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('sections/sections.delete_section') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('DeleteSection') }}" method="POST">
                                                    @csrf
                                                    {{ trans('sections/sections.delete_warning') }}
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $section->id }}">
                                                    <div class="row">
                                                        <div class="col mt-2 mb-2">
                                                            <input type="text" disabled
                                                                value="{{ $section->getTranslation('name', 'ar') }}, {{ $section->getTranslation('name', 'en') }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('sections/sections.close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{ trans('sections/sections.submit') }}</button>
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
                                                    {{ trans('sections/sections.delete_section') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('DeleteSelectedSections') }}" method="POST">
                                                    @csrf
                                                    {{ trans('sections/sections.delete_warning') }}
                                                    <input id="delete_selected_id" type="hidden"
                                                        name="delete_selected_id" class="form-control"
                                                        value="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('sections/sections.close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{ trans('sections/sections.submit') }}</button>
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
                        {{ trans('sections/sections.add_section') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('AddSection') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col mt-2 mb-2">
                                <label for="name_ar" class="mr-sm-2">{{ trans('sections/sections.name_ar') }}
                                    :</label>
                                <input id="name_ar" type="text" name="name_ar" class="form-control" required>
                            </div>
                            <div class="col mt-2 mb-2">
                                <label for="name_en" class="mr-sm-2">{{ trans('sections/sections.name_en') }}
                                    :</label>
                                <input id="name_en" type="text" class="form-control" name="name_en" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2 mb-2">
                                <label for="grade_id"
                                    class="mr-sm-2">{{ trans('sections/sections.grade_id') }}
                                    :</label>
                                <div class="box">
                                    <select id="grade_id" class="fancyselect" name="grade_id">
                                            <option selected value="{{ $grade -> id }}">{{ $grade -> name }}</option>
                                    </select>
                                </div>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col mt-2 mb-2">
                                <label for="classroom_id"
                                    class="mr-sm-2">{{ trans('sections/sections.classroom_id') }}
                                    :</label>
                                <div class="box">
                                    <select id="classroom_id" class="fancyselect" name="classroom_id">
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom -> id }}">{{ $classroom -> name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col mt-2 mb-2">
                                <label for="teachers"
                                    class="mr-sm-2">{{ trans('sections/sections.teachers') }}
                                    :</label>
                                <div class="box">
                                    <select id="teachers" class="form-control" name="teachers[]" multiple>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher -> id }}">{{ $teacher -> name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col mt-2 mb-2">
                                <label for="status"
                                    class="mr-sm-2">{{ trans('sections/sections.status') }}
                                    :</label>
                                <div class="box">
                                    <select id="status" class="fancyselect" name="status">
                                        <option value="1" >{{ trans('sections/sections.active_true') }}</option>
                                        <option value="0" >{{ trans('sections/sections.active_false') }}</option>
                                    </select>
                                </div>
                            </div>    
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('sections/sections.close') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('sections/sections.submit') }}</button>
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
