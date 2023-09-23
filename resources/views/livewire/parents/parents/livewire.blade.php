<div>
    @if($showTable)
        @include('livewire.parents.parents.table')
    @else



    @if (!empty($success))
        <?php toastr($success, 'success'); ?>
    @endif

    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button"
                    class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                <p>{{ trans('parents/add.step_1') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button"
                    class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                <p>{{ trans('parents/add.step_2') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button"
                    class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}" disabled="disabled">3</a>
                <p>{{ trans('parents/add.step_3') }}</p>
            </div>
        </div>
    </div>

    @include('livewire.parents.parents.father')
    @include('livewire.parents.parents.mother')

    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        @if ($currentStep != 3)
            <div style="display: none" class="row setup-content" id="step-3">
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <div class="form-row">
                            <div class="col mt-3 mb-3">
                                <div class="custom-file">
                                    <label for="formFileMultiple" class="form-label">{{ trans('parents/add.attachments') }}</label>
                                    <input type="file" class="form-control" id="formFileMultiple" wire:model="attachments" accept=".pdf,.jpg, .png, image/jpeg, image/png" multiple>
                                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>                              
                                    @error('attachments.*')
                                    <label id="attachments_error" class="error ui red pointing label transition" for="attachments">{{ $message }}</label>                        
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col mt-3 mb-3">
                                <h1>{{ trans('parents/add.sure') }}</h1>
                            </div>
                        </div>

                        <input type="hidden" wire:model="parent_id">

                        <button class="btn btn-danger btn-sm nextBtn btn-lg mt-2 mb-2" type="button"
                                wire:click="back(2)">{{ trans('parents/add.previous') }}</button>
                        <button class="btn btn-success btn-sm btn-lg mt-2 mb-2 mr-2" wire:click="submitForm"
                                type="button">{{ trans('parents/add.confirm') }}
                        </button>
                    </div>
                </div>
            </div>
    </div>

    @endif
</div>  