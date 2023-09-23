<div>
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <h6 class="mb-2" style="color: blue">{{ trans('students/promotions.old') }}</h6>

            <div class="form-row">
                <div class="form-group col mt-2 mb-2">
                    <label for="grade_id">{{ trans('students/promotions.grade') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="grade_id" wire:model="grade_id">
                        <option selected>{{ trans('students/promotions.choose') }}...</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade -> id }}">{{ $grade -> name }}</option>
                        @endforeach
                    </select>
                    @error('grade_id')
                        <label id="grade_id-error" class="error ui red pointing label transition" for="grade_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="classroom_id">{{ trans('students/promotions.classroom') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="classroom_id" wire:ignore wire:model="classroom_id">
                    </select>
                    @error('classroom_id')
                        <label id="classroom_id-error" class="error ui red pointing label transition" for="classroom_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="section_id">{{ trans('students/promotions.section') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="section_id" wire:ignore wire:model="section_id">
                    </select>
                    @error('section_id')
                        <label id="section_id-error" class="error ui red pointing label transition" for="section_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="academic_year">{{ trans('students/promotions.academic_year') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="academic_year" wire:model="academic_year">
                        <option selected>{{ trans('students/promotions.choose') }}...</option>
                        @php
                            $current_year = date("Y");
                        @endphp
                        @for($year = $current_year; $year<=$current_year +1; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    @error('academic_year')
                        <label id="academic_year-error" class="error ui red pointing label transition" for="academic_year">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <h6 class="mt-2 mb-2" style="color: blue">{{ trans('students/promotions.new') }}</h6>

            <div class="form-row">
                <div class="form-group col mt-2 mb-2">
                    <label for="grade_id_new">{{ trans('students/promotions.grade') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="grade_id_new" wire:model="grade_id_new">
                        <option selected>{{ trans('students/promotions.choose') }}...</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade -> id }}">{{ $grade -> name }}</option>
                        @endforeach
                    </select>
                    @error('grade_id_new')
                        <label id="grade_id_new-error" class="error ui red pointing label transition" for="grade_id_new">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="classroom_id_new">{{ trans('students/promotions.classroom') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="classroom_id_new" wire:ignore wire:model="classroom_id_new">
                    </select>
                    @error('classroom_id_new')
                        <label id="classroom_id_new-error" class="error ui red pointing label transition" for="classroom_id_new">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="section_id_new">{{ trans('students/promotions.section') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="section_id_new" wire:ignore wire:model="section_id_new">
                    </select>
                    @error('section_id_new')
                        <label id="section_id_new-error" class="error ui red pointing label transition" for="section_id_new">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="academic_year_new">{{ trans('students/promotions.academic_year') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="academic_year_new" wire:model="academic_year_new">
                        <option selected>{{ trans('students/promotions.choose') }}...</option>
                        @php
                            $current_year = date("Y");
                        @endphp
                        @for($year = $current_year; $year<=$current_year +1; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    @error('academic_year_new')
                        <label id="academic_year_new-error" class="error ui red pointing label transition" for="academic_year_new">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <button class="btn btn-success btn-sm nextBtn btn-lg mt-2 mb-2"
                type="button" wire:click="submitForm">{{ trans('students/promotions.confirm') }}</button>
        </div>
    </div>
</div>
