<div>
    <div class="tab nav-border">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-02-tab" data-toggle="tab" href="#home-02" role="tab" aria-controls="home-02"
                    aria-selected="true">{{ trans('parents/parents.parent_informations') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active show" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab" aria-controls="profile-02"
                    aria-selected="false">{{ trans('parents/parents.parent_attachments') }}</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade" id="home-02" role="tabpanel" aria-labelledby="home-02-tab">
                <table class="table table-striped table-hover" style="text-align:center">
                    <tbody>
                        <tr>
                            <th scope="row">{{ trans('parents/parents.email') }}</th>
                            <td>{{ $parent -> email }}</td>
                            <th scope="row"> - </th>
                            <td> - </td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('parents/parents.father_name') }}</th>
                            <td>{{ $parent -> father_name }}</td>
                            <th scope="row">{{ trans('parents/parents.mother_name') }}</th>
                            <td>{{ $parent -> mother_name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('parents/parents.father_national_id') }}</th>
                            <td>{{ $parent -> father_national_id }}</td>
                            <th scope="row">{{ trans('parents/parents.mother_national_id') }}</th>
                            <td>{{ $parent -> mother_national_id }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('parents/parents.father_passport_id') }}</th>
                            <td>{{ $parent -> father_passport_id }}</td>
                            <th scope="row">{{ trans('parents/parents.mother_passport_id') }}</th>
                            <td>{{ $parent -> mother_passport_id }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('parents/parents.father_phone') }}</th>
                            <td>{{ $parent -> father_phone }}</td>
                            <th scope="row">{{ trans('parents/parents.mother_phone') }}</th>
                            <td>{{ $parent -> mother_phone }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('parents/parents.father_job') }}</th>
                            <td>{{ $parent -> father_job }}</td>
                            <th scope="row">{{ trans('parents/parents.mother_job') }}</th>
                            <td>{{ $parent -> mother_job }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('parents/parents.father_nationality') }}</th>
                            <td>{{ $parent -> nationality_f -> name }}</td>
                            <th scope="row">{{ trans('parents/parents.mother_nationality') }}</th>
                            <td>{{ $parent -> nationality_m -> name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('parents/parents.father_blood_type') }}</th>
                            <td>{{ $parent -> blood_f -> name }}</td>
                            <th scope="row">{{ trans('parents/parents.mother_blood_type') }}</th>
                            <td>{{ $parent -> blood_m -> name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('parents/parents.father_religion') }}</th>
                            <td>{{ $parent -> religion_f -> name }}</td>
                            <th scope="row">{{ trans('parents/parents.mother_religion') }}</th>
                            <td>{{ $parent -> religion_m -> name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">{{ trans('parents/parents.father_address') }}</th>
                            <td>{{ $parent -> father_address }}</td>
                            <th scope="row">{{ trans('parents/parents.mother_address') }}</th>
                            <td>{{ $parent -> mother_address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade active show" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="col">
                            <div class="form-group custom-file">
                                <label  wire:ignore for="attachments" class="custom-file-label">{{ trans('parents/parents.parent_attachments') }}: [jpeg , jpg , png] <i class="text-danger" id="attachments_names"></i></label>
                                <input type="file" id="attachments" class="custom-file-input" accept="image/jpg, image/jpeg, image/png" wire:model="attachments" onchange="javascript:updateList()" multiple>
                                @error('attachments.*')
                                    <label id="attachments-error" class="error ui red pointing label transition" for="attachments">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="col" style="text-align: center;">
                            <button class="btn btn-success nextBtn btn-md"
                            type="button" wire:click="submitForm">{{ trans('parents/parents.submit') }}</button>
                        </div>
                    </div>
                    <br>
                    <table class="table center-aligned-table mb-0 table table-hover" style="text-align:center">
                        <thead>
                        <tr class="table-secondary">
                            <th scope="col">#</th>
                            <th scope="col">{{ trans('parents/parents.file_name') }}</th>
                            <th scope="col">{{ trans('parents/parents.created_at') }}</th>
                            <th scope="col">{{ trans('parents/parents.processes') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($parent -> images as $attachment)
                            <tr style='text-align:center; vertical-align:middle'>
                                <td>{{ $attachment -> id }}</td>
                                <td>{{ $attachment -> file_name }}</td>
                                <td>{{ $attachment -> created_at -> diffForHumans() }}</td>
                                <td colspan="2">
                                    <button type="button" class="btn btn-outline-info btn-sm"
                                        wire:click="download('{{ $attachment -> file_name }}')">
                                        {{ trans('parents/parents.download') }}
                                    </button>

                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $attachment -> id }}"
                                            title="{{ trans('parents/parents.delete_attachment') }}">{{ trans('parents/parents.delete') }}
                                    </button>
                                </td>
                            </tr>
                            <!-- Start Delete -->
                            <div class="modal fade" id="delete{{ $attachment -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ trans('parents/parents.delete_attachment') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ trans('parents/parents.delete_warning') }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('parents/parents.close') }}</button>
                                            <button type="button" wire:click="delete('{{ $attachment -> id }}', '{{ $attachment -> file_name }}')"
                                                class="btn btn-danger" data-dismiss="modal">{{ trans('parents/parents.submit') }}</button>
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
