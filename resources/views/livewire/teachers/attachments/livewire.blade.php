<div>
    <div class="tab nav-border">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-02-tab" data-toggle="tab" href="#home-02" role="tab" aria-controls="home-02"
                    aria-selected="true">{{ trans('teachers/teachers.teacher_informations') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active show" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab" aria-controls="profile-02"
                    aria-selected="false">{{ trans('teachers/teachers.teacher_attachments') }}</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade" id="home-02" role="tabpanel" aria-labelledby="home-02-tab">
                <table class="table table-striped table-hover" style="text-align:center">
                    <tbody>
                        <tr>
                            <th scope="row">{{ trans('teachers/teachers.name') }}</th>
                            <td>{{ $teacher -> name }}</td>
                            <th scope="row">{{ trans('teachers/teachers.email') }}</th>
                            <td>{{ $teacher -> email }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('teachers/teachers.gender') }}</th>
                            <td>{{ $teacher -> gender -> name }}</td>
                            <th scope="row">{{ trans('teachers/teachers.specialization') }}</th>
                            <td>{{ $teacher -> specialization -> name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('teachers/teachers.joining_date') }}</th>
                            <td>{{ $teacher -> joining_date }}</td>
                            <th scope="row">{{ trans('teachers/teachers.address') }}</th>
                            <td>{{ $teacher -> address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade active show" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="col">
                            <div class="form-group custom-file">
                                <label  wire:ignore for="attachments" class="custom-file-label">{{ trans('teachers/teachers.teacher_attachments') }}: [jpeg , jpg , png] <i class="text-danger" id="attachments_names"></i></label>
                                <input type="file" id="attachments" class="custom-file-input" accept="image/jpg, image/jpeg, image/png" wire:model="attachments" onchange="javascript:updateList()" multiple>
                                @error('attachments.*')
                                    <label id="attachments-error" class="error ui red pointing label transition" for="attachments">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="col" style="text-align: center;">
                            <button class="btn btn-success nextBtn btn-md"
                            type="button" wire:click="submitForm">{{ trans('teachers/teachers.submit') }}</button>
                        </div>
                    </div>
                    <br>
                    <table class="table center-aligned-table mb-0 table table-hover" style="text-align:center">
                        <thead>
                        <tr class="table-secondary">
                            <th scope="col">#</th>
                            <th scope="col">{{ trans('teachers/teachers.file_name') }}</th>
                            <th scope="col">{{ trans('teachers/teachers.created_at') }}</th>
                            <th scope="col">{{ trans('teachers/teachers.processes') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teacher -> images as $attachment)
                            <tr style='text-align:center; vertical-align:middle'>
                                <td>{{ $attachment -> id }}</td>
                                <td>{{ $attachment -> file_name }}</td>
                                <td>{{ $attachment -> created_at -> diffForHumans() }}</td>
                                <td colspan="2">
                                    <button type="button" class="btn btn-outline-info btn-sm"
                                        wire:click="download('{{ $attachment -> file_name }}')">
                                        {{ trans('teachers/teachers.download') }}
                                    </button>

                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $attachment -> id }}"
                                            title="{{ trans('teachers/teachers.delete_attachment') }}">{{ trans('teachers/teachers.delete') }}
                                    </button>
                                </td>
                            </tr>
                            <!-- Start Delete -->
                            <div class="modal fade" id="delete{{ $attachment -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ trans('teachers/teachers.delete_attachment') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ trans('teachers/teachers.delete_warning') }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('teachers/teachers.close') }}</button>
                                            <button type="button" wire:click="delete('{{ $attachment -> id }}', '{{ $attachment -> file_name }}')"
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
            </div>
        </div>
    </div>
</div>
