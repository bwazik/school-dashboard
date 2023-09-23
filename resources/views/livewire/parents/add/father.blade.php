@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.email') }}</label>
                        <input type="email" id="email" wire:model="email"  class="form-control">
                        @error('email')
                        <label id="email-error" class="error ui red pointing label transition" for="email">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.password') }}</label>
                        <input type="password" id="password" wire:model="password" class="form-control" >
                        @error('password')
                        <label id="password-error" class="error ui red pointing label transition" for="password">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.father_name_ar') }}</label>
                        <input type="text" id="father_name_ar" wire:model="father_name_ar" class="form-control" >
                        @error('father_name_ar')
                        <label id="father_name_ar_error" class="error ui red pointing label transition" for="father_name_ar">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.father_name_en') }}</label>
                        <input type="text" id="father_name_en" wire:model="father_name_en" class="form-control" >
                        @error('father_name_en')
                        <label id="father_name_en_error" class="error ui red pointing label transition" for="father_name_en">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3 mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.father_job_ar') }}</label>
                        <input type="text" id="father_job_ar" wire:model="father_job_ar" class="form-control">
                        @error('father_job_ar')
                        <label id="father_job_ar_error" class="error ui red pointing label transition" for="father_job_ar">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.father_job_en') }}</label>
                        <input type="text" id="father_job_en" wire:model="father_job_en" class="form-control">
                        @error('father_job_en')
                        <label id="father_job_en_error" class="error ui red pointing label transition" for="father_job_en">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.father_national_id') }}</label>
                        <input type="text" id="father_national_id" wire:model="father_national_id" class="form-control">
                        @error('father_national_id')
                        <label id="father_national_id_error" class="error ui red pointing label transition" for="father_national_id">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.father_passport_id') }}</label>
                        <input type="text" id="father_passport_id" wire:model="father_passport_id" class="form-control">
                        @error('father_passport_id')
                        <label id="father_passport_id_error" class="error ui red pointing label transition" for="father_passport_id">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.father_phone') }}</label>
                        <input type="text" id="father_phone" wire:model="father_phone" class="form-control">
                        @error('father_phone')
                        <label id="father_phone_error" class="error ui red pointing label transition" for="father_phone">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mt-2 mb-2">
                        <label for="inputCity">{{ trans('parents/add.father_nationality') }}</label>
                        <select class="custom-select my-1 mr-sm-2" id="father_nationality" wire:model="father_nationality">
                            <option selected>{{ trans('parents/add.choose') }}...</option>
                            @foreach($nationalities as $nationality)
                                <option value="{{$nationality -> id}}">{{$nationality -> name}}</option>
                            @endforeach
                        </select>
                        @error('father_nationality')
                        <label id="father_nationality_error" class="error ui red pointing label transition" for="father_nationality">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group col mt-2 mb-2">
                        <label for="inputState">{{ trans('parents/add.father_blood_type') }}</label>
                        <select class="custom-select my-1 mr-sm-2" id="father_blood_type" wire:model="father_blood_type">
                            <option selected>{{ trans('parents/add.choose') }}...</option>
                            @foreach($bloods as $blood)
                                <option value="{{$blood -> id}}">{{$blood -> name}}</option>
                            @endforeach
                        </select>
                        @error('father_blood_type')
                        <label id="father_blood_type_error" class="error ui red pointing label transition" for="father_blood_type">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group col mt-2 mb-2">
                        <label for="inputZip">{{ trans('parents/add.father_religion') }}</label>
                        <select class="custom-select my-1 mr-sm-2" id="father_religion" wire:model="father_religion">
                            <option selected>{{ trans('parents/add.choose') }}...</option>
                            @foreach($religions as $religion)
                                <option value="{{$religion -> id}}">{{$religion -> name}}</option>
                            @endforeach
                        </select>
                        @error('father_religion')
                        <label id="father_religion_error" class="error ui red pointing label transition" for="father_religion">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col mt-2 mb-2">
                        <label for="exampleFormControlTextarea1">{{ trans('parents/add.father_address') }}</label>
                        <textarea rows="5" style="resize:none;" class="form-control" id="father_address" wire:model="father_address" id="exampleFormControlTextarea1"></textarea>
                        @error('father_address')
                        <label id="father_address_error" class="error ui red pointing label transition" for="father_address">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-success btn-sm nextBtn btn-lg mt-2 mb-2" wire:click="firstStepSubmit"
                        type="button">{{ trans('parents/add.next') }}
                </button>
            </div>
        </div>
    </div>
