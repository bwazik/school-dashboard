<div>
    @if($showTable)
        @include('livewire.students.students.table')
    @else
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <h6 class="mb-2" style="color: blue">{{ trans('students/add.personal_informations') }}</h6>

            <div class="form-row">
                <div class="col mt-2 mb-2">
                    <label for="email">{{ trans('students/add.email') }}</label>
                    <input type="email" id="email" wire:model="email" class="form-control">
                    @error('email')
                        <label id="email-error" class="error ui red pointing label transition" for="email">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col mt-2 mb-2">
                    <label for="password">{{ trans('students/add.password') }}</label>
                    <input type="password" id="password" wire:model="password" class="form-control">
                    @error('password')
                        <label id="password-error" class="error ui red pointing label transition" for="password">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col mt-2 mb-2">
                    <label for="name_ar">{{ trans('students/add.name_ar') }}</label>
                    <input type="text" id="name_ar" wire:model="name_ar" class="form-control">
                    @error('name_ar')
                        <label id="name_ar-error" class="error ui red pointing label transition" for="name_ar">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col mt-2 mb-2">
                    <label for="name_en">{{ trans('students/add.name_en') }}</label>
                    <input type="text" id="name_en" wire:model="name_en" class="form-control">
                    @error('name_en')
                        <label id="name_en-error" class="error ui red pointing label transition" for="name_en">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col mt-2 mb-2">
                    <label for="birthday">{{ trans('students/add.birthday') }}</label>
                    <div class='input-group date'>
                        <input class="form-control" type="date" id="birthday" wire:model="birthday" data-date-format="yyyy-mm-dd">
                    </div>
                    @error('birthday')
                        <label id="birthday-error" class="error ui red pointing label transition" for="birthday">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col mt-2 mb-2">
                    <label for="gender_id">{{ trans('students/add.gender') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="gender_id" wire:model="gender_id">
                        <option selected>{{ trans('students/add.choose') }}...</option>
                        @foreach ($genders as $gender)
                            <option value="{{ $gender -> id }}">{{ $gender -> name }}
                            </option>
                        @endforeach
                    </select>
                    @error('gender_id')
                        <label id="gender_id-error" class="error ui red pointing label transition" for="gender_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="nationality">{{ trans('students/add.nationality') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="nationality" wire:model="nationality">
                        <option selected>{{ trans('students/add.choose') }}...</option>
                        @foreach ($nationalities as $nationality)
                            <option value="{{ $nationality -> id }}">{{ $nationality -> name }}
                            </option>
                        @endforeach
                    </select>
                    @error('nationality')
                        <label id="nationality-error" class="error ui red pointing label transition" for="nationality">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="blood_type">{{ trans('students/add.blood_type') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="blood_type" wire:model="blood_type">
                        <option selected>{{ trans('students/add.choose') }}...</option>
                        @foreach ($blood_types as $blood_type)
                            <option value="{{ $blood_type -> id }}">{{ $blood_type -> name }}
                            </option>
                        @endforeach
                    </select>
                    @error('blood_type')
                        <label id="blood_type-error" class="error ui red pointing label transition" for="blood_type">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <h6 class="mt-2 mb-2" style="color: blue">{{ trans('students/add.student_informations') }}</h6>

            <div class="form-row">
                <div class="form-group col mt-2 mb-2">
                    <label for="grade_id">{{ trans('students/add.grade') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="grade_id" wire:model="grade_id">
                        <option selected>{{ trans('students/add.choose') }}...</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade -> id }}">{{ $grade -> name }}</option>
                        @endforeach
                    </select>
                    @error('grade_id')
                        <label id="grade_id-error" class="error ui red pointing label transition" for="grade_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="classroom_id">{{ trans('students/add.classroom') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="classroom_id" wire:ignore wire:model="classroom_id">
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom -> id }}">{{ $classroom -> name }}</option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <label id="classroom_id-error" class="error ui red pointing label transition" for="classroom_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="section_id">{{ trans('students/add.section') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="section_id" wire:ignore wire:model="section_id">
                        @foreach ($sections as $section)
                            <option value="{{ $section -> id }}">{{ $section -> name }}</option>
                        @endforeach
                    </select>
                    @error('section_id')
                        <label id="section_id-error" class="error ui red pointing label transition" for="section_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="parent_id">{{ trans('students/add.parent') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="parent_id" wire:model="parent_id">
                        <option selected>{{ trans('students/add.choose') }}...</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent -> id }}">{{ $parent -> father_name }} - {{ $parent -> mother_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <label id="parent_id-error" class="error ui red pointing label transition" for="parent_id">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="academic_year">{{ trans('students/add.academic_year') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="academic_year" wire:model="academic_year">
                        <option selected>{{ trans('students/add.choose') }}...</option>
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
            <input type="hidden" wire:model="student_id">
            <button class="btn btn-success btn-sm nextBtn btn-lg mt-2 mb-2"
                type="button" wire:click="submitForm">{{ trans('students/add.confirm') }}</button>
        </div>
    </div>
    @endif
</div>
