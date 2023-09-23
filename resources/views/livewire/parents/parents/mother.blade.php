@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.mother_name_ar') }}</label>
                        <input type="text" id="mother_name_ar" wire:model="mother_name_ar" class="form-control" >
                        @error('mother_name_ar')
                        <label id="mother_name_ar_error" class="error ui red pointing label transition" for="mother_name_ar">{{ $message }}</label>                        
                        @enderror
                    </div>
                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.mother_name_en') }}</label>
                        <input type="text" id="mother_name_en" wire:model="mother_name_en" class="form-control" >
                        @error('mother_name_en')
                        <label id="mother_name_en_error" class="error ui red pointing label transition" for="mother_name_en">{{ $message }}</label>                        
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3 mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.mother_job_ar') }}</label>
                        <input type="text" id="mother_job_ar" wire:model="mother_job_ar" class="form-control">
                        @error('mother_job_ar')
                        <label id="mother_job_ar_error" class="error ui red pointing label transition" for="mother_job_ar">{{ $message }}</label>                        
                        @enderror
                    </div>
                    <div class="col-md-3 mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.mother_job_en') }}</label>
                        <input type="text" id="mother_job_en" wire:model="mother_job_en" class="form-control">
                        @error('mother_job_en')
                        <label id="mother_job_en_error" class="error ui red pointing label transition" for="mother_job_en">{{ $message }}</label>                        
                        @enderror
                    </div>

                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.mother_national_id') }}</label>
                        <input type="text" id="mother_national_id" wire:model="mother_national_id" class="form-control">
                        @error('mother_national_id')
                        <label id="mother_national_id_error" class="error ui red pointing label transition" for="mother_national_id">{{ $message }}</label>                        
                        @enderror
                    </div>
                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.mother_passport_id') }}</label>
                        <input type="text" id="mother_passport_id" wire:model="mother_passport_id" class="form-control">
                        @error('mother_passport_id')
                        <label id="mother_passport_id_error" class="error ui red pointing label transition" for="mother_passport_id">{{ $message }}</label>                        
                        @enderror
                    </div>

                    <div class="col mt-2 mb-2">
                        <label for="title">{{ trans('parents/add.mother_phone') }}</label>
                        <input type="text" id="mother_phone" wire:model="mother_phone" class="form-control">
                        @error('mother_phone')
                        <label id="mother_phone_error" class="error ui red pointing label transition" for="mother_phone">{{ $message }}</label>                        
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mt-2 mb-2">
                        <label for="inputCity">{{ trans('parents/add.mother_nationality') }}</label>
                        <select class="custom-select my-1 mr-sm-2" id="mother_nationality" wire:model="mother_nationality">
                            <option selected>{{ trans('parents/add.choose') }}...</option>
                            @foreach($nationalities as $nationality)
                                <option value="{{$nationality -> id}}">{{$nationality -> name}}</option>
                            @endforeach
                        </select>
                        @error('mother_nationality')
                        <label id="mother_nationality_error" class="error ui red pointing label transition" for="mother_nationality">{{ $message }}</label>                        
                        @enderror
                    </div>
                    <div class="form-group col mt-2 mb-2">
                        <label for="inputState">{{ trans('parents/add.mother_blood_type') }}</label>
                        <select class="custom-select my-1 mr-sm-2" id="mother_blood_type" wire:model="mother_blood_type">
                            <option selected>{{ trans('parents/add.choose') }}...</option>
                            @foreach($bloods as $blood)
                                <option value="{{$blood -> id}}">{{$blood -> name}}</option>
                            @endforeach
                        </select>
                        @error('mother_blood_type')
                        <label id="mother_blood_type_error" class="error ui red pointing label transition" for="mother_blood_type">{{ $message }}</label>                        
                        @enderror
                    </div>
                    <div class="form-group col mt-2 mb-2">
                        <label for="inputZip">{{ trans('parents/add.mother_religion') }}</label>
                        <select class="custom-select my-1 mr-sm-2" id="mother_religion" wire:model="mother_religion">
                            <option selected>{{ trans('parents/add.choose') }}...</option>
                            @foreach($religions as $religion)
                                <option value="{{$religion -> id}}">{{$religion -> name}}</option>
                            @endforeach
                        </select>
                        @error('mother_religion')
                        <label id="mother_religion_error" class="error ui red pointing label transition" for="mother_religion">{{ $message }}</label>                        
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col mt-2 mb-2">
                        <label for="exampleFormControlTextarea1">{{ trans('parents/add.mother_address') }}</label>
                        <textarea rows="5" style="resize:none;" class="form-control" id="mother_address" wire:model="mother_address" id="exampleFormControlTextarea1"></textarea>
                        @error('mother_address')
                        <label id="mother_address_error" class="error ui red pointing label transition" for="mother_address">{{ $message }}</label>                        
                        @enderror
                    </div>
                </div>

                <button class="btn btn-danger btn-sm nextBtn btn-lg mt-2 mb-2" type="button" wire:click="back(1)">
                    {{ trans('parents/add.previous') }}
                </button>

                <button class="btn btn-success btn-sm nextBtn btn-lg mt-2 mb-2" type="button"
                        wire:click="secondStepSubmit">{{ trans('parents/add.next') }}
                </button>

            </div>
        </div>
    </div>