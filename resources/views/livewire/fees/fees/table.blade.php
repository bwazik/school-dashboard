<a class="button x-small" href="{{ route('AddFee') }}">
    {{ trans('fees/fees.add_fee') }}
</a>
<button type="button" class="button x-small ml-2" id="delete_all_btn">
    {{ trans('fees/fees.delete_selected') }}
</button>
<br><br>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered p-0" style="white-space: nowrap;">
        <thead>
            <tr>
                <th><input name="select_all" id="select_all" type="checkbox" onclick="CheckAll('box1', this)"></th>
                <th>#</th>
                <th>{{ trans('fees/fees.name') }}</th>
                <th>{{ trans('fees/fees.amount') }}</th>
                <th>{{ trans('fees/fees.grade') }}</th>
                <th>{{ trans('fees/fees.classroom') }}</th>
                <th>{{ trans('fees/fees.year') }}</th>
                <th>{{ trans('fees/fees.type') }}</th>
                <th>{{ trans('fees/fees.note') }}</th>
                <th>{{ trans('fees/fees.processes') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fees as $fee)
                <tr>
                    <td><input type="checkbox" value="{{ $fee -> id }}" class="box1"></td>
                    <td>{{ $fee -> id }}</td>
                    <td>{{ $fee -> name }}</td>
                    <td>{{ $fee -> amount }}</td>
                    <td>{{ $fee -> grade -> name }}</td>
                    <td>{{ $fee -> classroom -> name }}</td>
                    <td>{{ $fee -> year }}</td>
                    <td>
                        @if($fee -> type == 1)
                            {{ trans('fees/fees.type1') }}
                        @elseif($fee -> type == 2)
                            {{ trans('fees/fees.type2') }}
                        @elseif($fee -> type == 3)
                            {{ trans('fees/fees.type2') }}
                        @else
                            {{ trans('fees/fees.type') }}
                        @endif
                    </td>
                    <td>{{ $fee -> note ?? '-' }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-md" wire:click="edit({{ $fee -> id }})" title="{{ trans('fees/fees.edit') }}"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#delete{{ $fee -> id }}" title="{{ trans('fees/fees.delete') }}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>

                <!-- Start Delete -->
                <div class="modal fade" id="delete{{ $fee -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ trans('fees/fees.delete_fee') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ trans('fees/fees.delete_warning') }}
                                <div class="row">
                                    <div class="col mt-2 mb-2">
                                        <input type="text" disabled
                                            value="{{ $fee->getTranslation('name', 'ar') }}, {{ $fee->getTranslation('name', 'en') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('fees/fees.close') }}</button>
                                <button type="button" wire:click="delete({{ $fee -> id }})"
                                    class="btn btn-danger" data-dismiss="modal">{{ trans('fees/fees.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Delete -->
            @endforeach
        </tbody>
    </table>
</div>
