<div>
    <a class="button x-small" href="{{ route('AddPromotion') }}">
        {{ trans('students/promotions.students_promotion') }}
    </a>
    <br><br>
    
    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered p-0" style="white-space: nowrap;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('students/promotions.student') }}</th>
                    <th class="alert-danger">{{ trans('students/promotions.from_grade') }}</th>
                    <th class="alert-danger">{{ trans('students/promotions.from_classroom') }}</th>
                    <th class="alert-danger">{{ trans('students/promotions.from_section') }}</th>
                    <th class="alert-danger">{{ trans('students/promotions.from_academic_year') }}</th>
                    <th class="alert-success">{{ trans('students/promotions.to_grade') }}</th>
                    <th class="alert-success">{{ trans('students/promotions.to_classroom') }}</th>
                    <th class="alert-success">{{ trans('students/promotions.to_section') }}</th>
                    <th class="alert-success">{{ trans('students/promotions.to_academic_year') }}</th>
                    <th>{{ trans('students/promotions.processes') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promotions as $promotion)
                    <tr>
                        <td>{{ $promotion -> id }}</td>
                        <td>{{ $promotion -> student -> name }}</td>
                        <td>{{ $promotion -> f_grade -> name }}</td>
                        <td>{{ $promotion -> f_classroom -> name }}</td>
                        <td>{{ $promotion -> f_section -> name }}</td>
                        <td>{{ $promotion -> from_academic_year }}</td>
                        <td>{{ $promotion -> t_grade -> name }}</td>
                        <td>{{ $promotion -> t_classroom -> name }}</td>
                        <td>{{ $promotion -> t_section -> name }}</td>
                        <td>{{ $promotion -> to_academic_year }}</td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reversion{{ $promotion -> id }}" title="{{ trans('students/promotions.reversion') }}"><i class="fa fa-rotate-left"></i></button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#graduate{{ $promotion -> id }}" title="{{ trans('students/promotions.graduation') }}"><i class="fa-solid fa-graduation-cap"></i></button>
                        </td>
                    </tr>
                    <!-- Start Reversion -->
                    <div class="modal fade" id="reversion{{ $promotion -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ trans('students/promotions.reverse_promotion') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ trans('students/promotions.reverse_warning') }}
                                    <div class="row">
                                        <div class="col mt-2 mb-2">
                                            <input type="text" disabled
                                                value="{{ $promotion -> student -> getTranslation('name', 'ar') }}, {{ $promotion -> student -> getTranslation('name', 'en') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('students/promotions.close') }}</button>
                                    <button type="button" wire:click="reverse({{ $promotion -> id }})"
                                        class="btn btn-danger" data-dismiss="modal">{{ trans('students/promotions.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete -->

                    <!-- Start Graduate -->
                    <div class="modal fade" id="graduate{{ $promotion -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ trans('students/graduations.graduate_student') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ trans('students/graduations.graduate_warning') }}
                                    <div class="row">
                                        <div class="col mt-2 mb-2">
                                            <input type="text" disabled
                                                value="{{ $promotion -> student -> getTranslation('name', 'ar') }}, {{ $promotion -> student -> getTranslation('name', 'en') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('students/graduations.close') }}</button>
                                    <button type="button" wire:click="graduate({{ $promotion -> student_id }})"
                                        class="btn btn-danger" data-dismiss="modal">{{ trans('students/graduations.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Graduate -->                    
                @endforeach
            </tbody>
        </table>
    </div>    
</div>
