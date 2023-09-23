<a class="button x-small" href="{{ route('AddStudent') }}">
    {{ trans('students/students.add_student') }}
</a>
<button type="button" class="button x-small ml-2" id="delete_all_btn">
    {{ trans('students/students.delete_selected') }}
</button>
<br><br>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered p-0" style="white-space: nowrap;">
        <thead>
            <tr>
                <th><input name="select_all" id="select_all" type="checkbox" onclick="CheckAll('box1', this)"></th>
                <th>#</th>
                <th>{{ trans('students/students.email') }}</th>
                <th>{{ trans('students/students.name') }}</th>
                <th>{{ trans('students/students.grade') }}</th>
                <th>{{ trans('students/students.classroom') }}</th>
                <th>{{ trans('students/students.section') }}</th>
                <th>{{ trans('students/students.parent') }}</th>
                <th>{{ trans('students/students.processes') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td><input type="checkbox" value="{{ $student -> id }}" class="box1"></td>
                    <td>{{ $student -> id }}</td>
                    <td>{{ $student -> email }}</td>
                    <td>{{ $student -> name }}</td>
                    <td>{{ $student -> grade -> name }}</td>
                    <td>{{ $student -> classroom -> name }}</td>
                    <td>{{ $student -> section -> name }}</td>
                    <td>{{ $student -> myParent -> father_name }} - {{ $student -> myParent -> mother_name }}</td>
                    <td>
                        <div class="dropdown show">
                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ trans('students/students.processes') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="padding: 0.5rem 0.5rem;">
                                <button type="button" class="btn btn-info btn-md" wire:click="edit({{ $student -> id }})" title="{{ trans('students/students.edit') }}"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#delete{{ $student -> id }}" title="{{ trans('students/students.delete') }}"><i class="fa fa-trash"></i></button>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#graduate{{ $student -> id }}" title="{{ trans('students/promotions.graduation') }}"><i class="fa-solid fa-graduation-cap"></i></button>
                                <a href="{{ Route('AddInvoice', $student -> id) }}" class="btn btn-dark btn-md" role="button" aria-pressed="true" title="{{ trans('students/students.student_attachments') }}"><i class="fa fa-receipt"></i></a>
                                <a href="{{ Route('StudentAttachments', $student -> id) }}" class="btn btn-warning btn-md" role="button" aria-pressed="true" title="{{ trans('students/students.student_attachments') }}"><i class="far fa-eye"></i></a>
                            </div>
                        </div>

                    </td>
                </tr>
                <!-- Start Delete -->
                <div class="modal fade" id="delete{{ $student -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ trans('students/students.delete_student') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ trans('students/students.delete_warning') }}
                                <div class="row">
                                    <div class="col mt-2 mb-2">
                                        <input type="text" disabled
                                            value="{{ $student->getTranslation('name', 'ar') }}, {{ $student->getTranslation('name', 'en') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('students/students.close') }}</button>
                                <button type="button" wire:click="delete({{ $student -> id }})"
                                    class="btn btn-danger" data-dismiss="modal">{{ trans('students/students.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Delete -->

                <!-- Start Graduate -->
                <div class="modal fade" id="graduate{{ $student -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ trans('students/graduations.graduate_student') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ trans('students/graduations.graduate_warning') }}
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
                                <button type="button" wire:click="graduate({{ $student -> id }})"
                                    class="btn btn-danger" data-dismiss="modal">{{ trans('students/graduations.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Graduate -->
            @endforeach
        </tbody>
    </table>
</div>
