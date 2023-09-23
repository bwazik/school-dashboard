<div>
    @if($showTable)
        @include('livewire.fees.fees.table')
    @else
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <div class="form-row">
                <div class="form-group col mt-2 mb-2">
                    <label for="name_ar">{{ trans('fees/add.name_ar') }}</label>
                    <input type="text" id="name_ar" wire:model="name_ar" class="form-control">
                    @error('name_ar')
                        <label id="name_ar-error" class="error ui red pointing label transition" for="name_ar">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="name_en">{{ trans('fees/add.name_en') }}</label>
                    <input type="text" id="name_en" wire:model="name_en" class="form-control">
                    @error('name_en')
                        <label id="name_en-error" class="error ui red pointing label transition" for="name_en">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="amount">{{ trans('fees/add.amount') }}</label>
                    <input type="number" id="name_en" wire:model="amount" class="form-control">
                    @error('amount')
                        <label id="amount-error" class="error ui red pointing label transition" for="amount">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col mt-2 mb-2">
                    <label for="grade_id">{{ trans('fees/add.grade') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="grade_id" wire:model="grade_id">
                        <option selected>{{ trans('fees/add.choose') }}...</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade -> id }}">{{ $grade -> name }}</option>
                        @endforeach
                    </select>
                    @error('grade_id')
                        <label id="grade_id-error" class="error ui red pointing label transition" for="grade_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="classroom_id">{{ trans('fees/add.classroom') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="classroom_id" wire:ignore wire:model="classroom_id">
                    </select>
                    @error('classroom_id')
                        <label id="classroom_id-error" class="error ui red pointing label transition" for="classroom_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="year">{{ trans('fees/add.year') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="year" wire:model="year">
                        <option selected>{{ trans('fees/add.choose') }}...</option>
                        @php
                            $current_year = date("Y");
                        @endphp
                        @for($year = $current_year; $year<=$current_year +1; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    @error('year')
                        <label id="year-error" class="error ui red pointing label transition" for="year">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <div class="form-group mt-2 mb-2">
                <label for="note">{{ trans('fees/add.note') }}</label>
                <textarea rows="5" style="resize:none;" class="form-control" id="note" wire:model="note"></textarea>
                @error('note')
                    <label id="note-error" class="error ui red pointing label transition" for="note">{{ $message }}</label>
                @enderror
            </div>
            <input type="hidden" wire:model="fee_id">
            <button class="btn btn-success btn-sm nextBtn btn-lg mt-2 mb-2"
                type="button" wire:click="submitForm">{{ trans('fees/add.confirm') }}</button>
        </div>
    </div>
    @endif
</div>
