<a class="button x-small" href="{{ route('AddTeacher') }}">
    {{ trans('teachers/teachers.add_teacher') }}
</a>
<button type="button" class="button x-small ml-2" id="delete_all_btn">
    {{ trans('teachers/teachers.delete_selected') }}
</button>
<br><br>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered p-0" style="white-space: nowrap;">
        <thead>
            <tr>
                <th><input name="select_all" id="select_all" type="checkbox" onclick="CheckAll('box1', this)"></th>
                <th>#</th>
                <th>{{ trans('teachers/teachers.email') }}</th>
                <th>{{ trans('teachers/teachers.name') }}</th>
                <th>{{ trans('teachers/teachers.specialization') }}</th>
                <th>{{ trans('teachers/teachers.gender') }}</th>
                <th>{{ trans('teachers/teachers.joining_date') }}</th>
                <th>{{ trans('teachers/teachers.address') }}</th>
                <th>{{ trans('teachers/teachers.processes') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr>
                    <td><input type="checkbox" value="{{ $teacher -> id }}" class="box1"></td>
                    <td>{{ $teacher -> id }}</td>
                    <td>{{ $teacher -> email }}</td>
                    <td>{{ $teacher -> name }}</td>
                    <td>{{ $teacher -> specialization -> name }}</td>
                    <td>{{ $teacher -> gender -> name }}</td>
                    <td>{{ $teacher -> joining_date }}</td>
                    <td>{{ $teacher -> address }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-md" wire:click="edit({{ $teacher -> id }})" title="{{ trans('teachers/teachers.edit') }}"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#delete{{ $teacher -> id }}" title="{{ trans('teachers/teachers.delete') }}"><i class="fa fa-trash"></i></button>
                        <a href="{{ Route('TeacherAttachments', $teacher -> id) }}" class="btn btn-warning btn-md" role="button" aria-pressed="true" title="{{ trans('teachers/teachers.edit') }}"><i class="far fa-eye"></i></a>
                    </td>
                </tr>

                <!-- Start Delete -->
                <div class="modal fade" id="delete{{ $teacher -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ trans('teachers/teachers.delete_teacher') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ trans('teachers/teachers.delete_warning') }}
                                <div class="row">
                                    <div class="col mt-2 mb-2">
                                        <input type="text" disabled
                                            value="{{ $teacher->getTranslation('name', 'ar') }}, {{ $teacher->getTranslation('name', 'en') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('teachers/teachers.close') }}</button>
                                <button type="button" wire:click="delete({{ $teacher -> id }})"
                                    class="btn btn-danger" data-dismiss="modal">{{ trans('teachers/teachers.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Delete -->
            @endforeach
        </tbody>
    </table>
</div>
