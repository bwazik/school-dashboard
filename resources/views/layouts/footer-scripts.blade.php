<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path = '{{ asset('assets/js') }}/';
</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')

<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
</script>

<script type="text/javascript">
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }

    $(function() {
        $("#delete_all_btn").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_selected').modal('show')
                $('input[id="delete_selected_id"]').val(selected);
            }
        });
    });
</script>

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

<script>
    $(document).ready(function () {
        $('#grade_id').on('change', function () {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "{{ URL::to('students/classrooms') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#classroom_id').empty();
                        $('#classroom_id').append('<option selected>{{ trans('students/add.choose') }}...</option>');
                        $.each(data, function (key, value) {
                            $('#classroom_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#classroom_id').on('change', function () {
            var classroom_id = $(this).val();
            if (classroom_id) {
                $.ajax({
                    url: "{{ URL::to('students/sections') }}/" + classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#section_id').empty();
                        $('#section_id').append('<option selected>{{ trans('students/add.choose') }}...</option>');
                        $.each(data, function (key, value) {
                            $('#section_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#grade_id_new').on('change', function () {
            var grade_id_new = $(this).val();
            if (grade_id_new) {
                $.ajax({
                    url: "{{ URL::to('students/classrooms') }}/" + grade_id_new,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#classroom_id_new').empty();
                        $('#classroom_id_new').append('<option selected>{{ trans('students/add.choose') }}...</option>');
                        $.each(data, function (key, value) {
                            $('#classroom_id_new').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#classroom_id_new').on('change', function () {
            var classroom_id_new = $(this).val();
            if (classroom_id_new) {
                $.ajax({
                    url: "{{ URL::to('students/sections') }}/" + classroom_id_new,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#section_id_new').empty();
                        $('#section_id_new').append('<option selected>{{ trans('students/add.choose') }}...</option>');
                        $.each(data, function (key, value) {
                            $('#section_id_new').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>