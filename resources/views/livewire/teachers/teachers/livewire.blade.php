<div>
    @if($showTable)
        @include('livewire.teachers.teachers.table')
    @else
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <div class="form-row">
                <div class="col mt-2 mb-2">
                    <label for="email">{{ trans('teachers/add.email') }}</label>
                    <input type="email" id="email" wire:model="email" class="form-control">
                    @error('email')
                        <label id="email-error" class="error ui red pointing label transition" for="email">{{ $message }}</label>                        
                    @enderror
                </div>
                <div class="col mt-2 mb-2">
                    <label for="password">{{ trans('teachers/add.password') }}</label>
                    <input type="password" id="password" wire:model="password" class="form-control">
                    @error('password')
                        <label id="password-error" class="error ui red pointing label transition" for="password">{{ $message }}</label>                       
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col mt-2 mb-2">
                    <label for="name_ar">{{ trans('teachers/add.name_ar') }}</label>
                    <input type="text" id="name_ar" wire:model="name_ar" class="form-control">
                    @error('name_ar')
                        <label id="name_ar-error" class="error ui red pointing label transition" for="name_ar">{{ $message }}</label>                       
                    @enderror
                </div>
                <div class="col mt-2 mb-2">
                    <label for="name_en">{{ trans('teachers/add.name_en') }}</label>
                    <input type="text" id="name_en" wire:model="name_en" class="form-control">
                    @error('name_en')
                        <label id="name_en-error" class="error ui red pointing label transition" for="name_en">{{ $message }}</label>                       
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col mt-2 mb-2">
                    <label for="specialization_id">{{ trans('teachers/add.specialization') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="specialization_id" wire:model="specialization_id">
                        <option selected>{{ trans('teachers/add.choose') }}...</option>
                        @foreach ($specializations as $specialization)
                            <option value="{{ $specialization -> id }}">{{ $specialization -> name }}
                            </option>
                        @endforeach
                    </select>
                    @error('specialization_id')
                        <label id="specialization_id-error" class="error ui red pointing label transition" for="specialization_id">{{ $message }}</label>                       
                    @enderror
                </div>
                <div class="form-group col mt-2 mb-2">
                    <label for="gender_id">{{ trans('teachers/add.gender') }}</label>
                    <select class="custom-select my-1 mr-sm-2" id="gender_id" wire:model="gender_id">
                        <option selected>{{ trans('teachers/add.choose') }}...</option>
                        @foreach ($genders as $gender)
                            <option value="{{ $gender -> id }}">{{ $gender -> name }}</option>
                        @endforeach
                    </select>
                    @error('gender_id')
                        <label id="gender_id-error" class="error ui red pointing label transition" for="gender_id">{{ $message }}</label>                       
                    @enderror
                </div>
            </div>

            <div class="form-row"> 
                <div class="col mt-2 mb-2">
                    <label for="datepicker-action">{{ trans('teachers/add.joining_date') }}</label>
                    <div class='input-group date'>
                        <input class="form-control" type="date"
                            wire:model="joining_date">
                    </div>
                    @error('joining_date')
                        <label id="joining_date-error" class="error ui red pointing label transition" for="joining_date">{{ $message }}</label>                       
                    @enderror
                </div>
            </div>

            <div class="form-group mt-2 mb-2">
                <label for="address">{{ trans('teachers/add.address') }}</label>
                <textarea rows="5" style="resize:none;" class="form-control" id="address" wire:model="address"></textarea>
                @error('address')
                    <label id="address-error" class="error ui red pointing label transition" for="address">{{ $message }}</label>                       
                @enderror
            </div>
            <input type="hidden" wire:model="teacher_id">
            <button class="btn btn-success btn-sm nextBtn btn-lg mt-2 mb-2"
                type="button" wire:click="submitForm">{{ trans('teachers/add.confirm') }}</button>
        </div>
    </div>
    @endif
</div>
