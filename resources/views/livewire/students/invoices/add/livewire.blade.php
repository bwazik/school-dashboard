<div>
    <div class="col-xs-12">
        <div class="col-md-12">
            <div class="form-row">
                <div class="card-body">
                    <div class="repeater">
                        <div data-repeater-list="invoices_list">
                            <div data-repeater-item>
                                <div class="row">
                                    <div class="col mt-2 mb-2">
                                        <label for="student" class="mr-sm-2">{{ trans('invoices/add.student') }}:</label>
                                        <div class="box">
                                            <select id="student" class="fancyselect" wire:model="student">
                                                <option value="{{ $student -> id }}">{{ $student -> name }}</option>
                                            </select>
                                            @error('student')
                                            <label id="student-error" class="error ui red pointing label transition" for="student">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col mt-2 mb-2">
                                        <label for="type" class="mr-sm-2">{{ trans('invoices/add.type') }}:</label>
                                        <div class="box">
                                            <select id="type" class="fancyselect" wire:model="type">
                                                <option selected>{{ trans('invoices/add.choose') }}...</option>
                                                @foreach ($fees as $fee)
                                                    <option value="{{ $fee -> id }}">{{ $fee -> name }}</option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                            <label id="type-error" class="error ui red pointing label transition" for="type">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col mt-2 mb-2">
                                        <label for="amount" class="mr-sm-2">{{ trans('invoices/add.amount') }}:</label>
                                        <div class="box">
                                            <select id="amount" class="fancyselect" wire:model="amount">
                                                <option selected>{{ trans('invoices/add.choose') }}...</option>
                                                @foreach ($fees as $fee)
                                                    <option value="{{ $fee -> id }}">{{ $fee -> amount }}</option>
                                                @endforeach
                                            </select>
                                            @error('amount')
                                            <label id="amount-error" class="error ui red pointing label transition" for="amount">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col mt-2 mb-2">
                                        <label for="note" class="mr-sm-2">{{ trans('invoices/add.note') }} :</label>
                                        <div class="box">
                                            <input type="text" id="note" wire:model="note" class="form-control">
                                            @error('note')
                                            <label id="note-error" class="error ui red pointing label transition" for="note">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col mt-2 mb-2">
                                        <label for="delete_row" class="mr-sm-2">{{ trans('invoices/add.processes') }} :</label>
                                        <div class="box">
                                            <input id="delete_row" class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('invoices/add.delete_row') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-12">
                                <input class="button" data-repeater-create type="button" 
                                    value="{{ trans('invoices/add.add_row') }}" />
                            </div>
                        </div>
                        <br>
                        <input type="hidden" wire:model="grade_id">
                        <input type="hidden" wire:model="classroom_id">

                        <button class="btn btn-success btn-sm nextBtn btn-lg mt-2 mb-2"
                        type="button" wire:click="submitForm">{{ trans('invoices/add.confirm') }}</button>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
