<div>
    <a class="button x-small" href="{{ route('AddGraduation') }}">
        {{ trans('students/graduations.students_grauation') }}
    </a>
    <br><br>
    
    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered p-0" style="white-space: nowrap;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('students/graduations.email') }}</th>
                    <th>{{ trans('students/graduations.name') }}</th>
                    <th>{{ trans('students/graduations.grade') }}</th>
                    <th>{{ trans('students/graduations.classroom') }}</th>
                    <th>{{ trans('students/graduations.section') }}</th>
                    <th>{{ trans('students/graduations.academic_year') }}</th>
                    <th>{{ trans('students/graduations.processes') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student -> id }}</td>
                        <td>{{ $student -> email }}</td>
                        <td>{{ $student -> name }}</td>
                        <td>{{ $student -> grade -> name }}</td>
                        <td>{{ $student -> classroom -> name }}</td>
                        <td>{{ $student -> section -> name }}</td>
                        <td>{{ $student -> academic_year }}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#return{{ $student -> id }}" title="{{ trans('students/graduations.return') }}"><i class="fa fa-rotate-left"></i></button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $student -> id }}" title="{{ trans('students/graduations.delete') }}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Start Return -->
                    <div class="modal fade" id="return{{ $student -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ trans('students/graduations.return_student') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ trans('students/graduations.return_warning') }}
                                    <div class="row">
                                        <div class="col mt-2 mb-2">
                                            <input type="text" disabled
                                                value="{{ $student -> getTranslation('name', 'ar') }}, {{ $student -> getTranslation('name', 'en') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('students/graduations.close') }}</button>
                                    <button type="button" wire:click="return({{ $student -> id }})"
                                        class="btn btn-danger" data-dismiss="modal">{{ trans('students/graduations.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Return -->

                    <!-- Start Delete -->
                    <div class="modal fade" id="delete{{ $student -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ trans('students/graduations.delete_student') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ trans('students/graduations.delete_warning') }}
                                    <div class="row">
                                        <div class="col mt-2 mb-2">
                                            <input type="text" disabled
                                                value="{{ $student -> getTranslation('name', 'ar') }}, {{ $student -> getTranslation('name', 'en') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('students/graduations.close') }}</button>
                                    <button type="button" wire:click="delete({{ $student -> id }})"
                                        class="btn btn-danger" data-dismiss="modal">{{ trans('students/graduations.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete -->
                @endforeach
            </tbody>
        </table>
    </div>    
</div>
