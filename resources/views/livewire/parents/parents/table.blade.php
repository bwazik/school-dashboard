<a class="button x-small" href="{{ route('AddParent') }}">
    {{ trans('parents/parents.add_parent') }}
</a>

<button class="button x-small ml-2" id="delete_all_btn">
    {{ trans('parents/parents.delete_selected') }}
</button>
<br><br>
<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered p-0" style="white-space: nowrap;">
        <thead>
            <tr>
                <th><input name="select_all" id="select_all" type="checkbox"
                        onclick="CheckAll('box1', this)"></th>
                <th>#</th>
                <th>{{ trans('parents/add.email') }}</th>
                <th>{{ trans('parents/parents.father_name') }}</th>
                <th>{{ trans('parents/add.father_national_id') }}</th>
                <th>{{ trans('parents/add.father_passport_id') }}</th>
                <th>{{ trans('parents/add.father_phone') }}</th>
                <th>{{ trans('parents/parents.father_job') }}</th>
                <th>{{ trans('parents/parents.processes') }}</th>
                </tr>
        </thead>
        <tbody>
            @foreach ($parents as $parent)
                <tr>
                    <td><input type="checkbox" value="{{ $parent -> id }}" class="box1"></td>
                    <td>{{ $parent -> id }}</td>
                    <td>{{ $parent -> email }}</td>
                    <td>{{ $parent -> father_name }}</td>
                    <td>{{ $parent -> father_national_id }}</td>
                    <td>{{ $parent -> father_passport_id }}</td>
                    <td>{{ $parent -> father_phone }}</td>
                    <td>{{ $parent -> father_job }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-md" wire:click="edit({{ $parent -> id }})" title="{{ trans('parents/parents.edit') }}"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#delete{{ $parent -> id }}" title="{{ trans('parents/parents.delete') }}"><i class="fa fa-trash"></i></button>
                        <a href="{{ Route('ParentAttachments', $parent -> id) }}" class="btn btn-warning btn-md" role="button" aria-pressed="true" title="{{ trans('parents/parents.edit') }}"><i class="far fa-eye"></i></a>
                    </td>
                </tr>
                <!-- Start Delete -->
                <div class="modal fade" id="delete{{ $parent -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ trans('parents/parents.delete_parent') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ trans('parents/parents.delete_warning') }}
                                <div class="row">
                                    <div class="col mt-2 mb-2">
                                        <input type="text" disabled
                                            value="{{ $parent->getTranslation('father_name', 'ar') }}, {{ $parent->getTranslation('father_name', 'en') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('parents/parents.close') }}</button>
                                <button type="submit" wire:click="delete({{ $parent -> id }})"
                                    class="btn btn-danger" data-dismiss="modal">{{ trans('parents/parents.submit') }}</button>
                            </div>
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
                                {{ trans('parents/parents.delete_parent') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                {{ trans('parents/parents.delete_warning') }}
                                <input id="delete_selected_id" type="hidden"
                                    value="{{ $parent -> id }}"
                                    wire:model="delete_selected_id" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('parents/parents.close') }}</button>
                            <button type="submit" wire:click="delete_selected"
                                class="btn btn-danger" data-dismiss="modal">{{ trans('parents/parents.submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Delete Selected-->
            @endforeach
        </tbody>
    </table>
</div>
