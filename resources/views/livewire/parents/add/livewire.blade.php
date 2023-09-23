<div>

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

@include('livewire.parents.add.father')
@include('livewire.parents.add.mother')

<div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
    @if ($currentStep != 3)
        <div style="display: none" class="row setup-content" id="step-3">
            @endif
            <div class="col-xs-12">
                <div class="col-md-12">
                    <br>
                    <div class="form-row">
                        <div class="col mt-3 mb-3">
                            <div class="form-group custom-file">
                                <label  wire:ignore for="attachments" class="custom-file-label">{{ trans('parents/parents.parent_attachments') }}: [jpeg , jpg , png] <i class="text-danger" id="attachments_names"></i></label>
                                <input type="file" id="attachments" class="custom-file-input" accept="image/jpg, image/jpeg, image/png" wire:model="attachments" onchange="javascript:updateList()" multiple>
                                @error('attachments.*')
                                    <label id="attachments-error" class="error ui red pointing label transition" for="attachments">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mt-3 mb-3">
                            <h1>{{ trans('parents/add.sure') }}</h1>
                        </div>
                    </div>
                    <button class="btn btn-danger btn-sm nextBtn btn-lg mt-2 mb-2" type="button"
                            wire:click="back(2)">{{ trans('parents/add.previous') }}</button>
                    <button class="btn btn-success btn-sm btn-lg mt-2 mb-2 mr-2" wire:click="submitForm"
                            type="button">{{ trans('parents/add.confirm') }}
                    </button>
                </div>
            </div>
        </div>
</div>

<script>
    updateList = function() {
        var output1 = document.getElementById('attachments_names');
        output1.innerHTML =  '';

        var input = document.getElementById('attachments');
        var output = document.getElementById('attachments_names');

        for (var i = 0; i < input.files.length; ++i) {
            output.innerHTML +=  input.files.item(i).name + '   -   ';
        }
    }
</script>
