<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/1.4.14/jquery.scrollTo.min.js"></script>
<script>
    $("input[type=checkbox]").click(function () {
        $(this).parents("div").next(".sub-options").toggle("fast");
    });

    $("input[name=printing]").click(function () {
        if ($(this).val() == 'Yes') {
            var date = getFirstAvail(20);
            $("#date").val('');
        } else {
            var date = getFirstAvail(10);
        }
        $('.date').datepicker('setStartDate', date);
    });

    $("#add-file").click(function () {
        var text = '\
        <div class="fileinput fileinput-new input-group" data-provides="fileinput">\
        <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>\
        <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="file[]"></span>\
        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>\
        </div>';
        $(text).insertBefore($(this));
    });


    function getFirstAvail(days) {
        var date = new Date();
        i = 0;
        while (i < days) {
            date.setDate(date.getDate() + 1);
            if (date.getDay() != 0 && date.getDay() != 6) {
                i++;
            }
        }
        return date;
    }


    $('.date').datepicker({
        startDate: getFirstAvail(10),
        daysOfWeekDisabled: "0,6",
        autoclose: true,
        todayHighlight: true,
        beforeShowDay: function (date) {
        }
    });

    $("form").submit(function () {
        var error = false;
        //clear all errors
        $(".form-group").removeClass('has-error');
        $("#error-box").hide();
        //check text fields
        var fields = ['name', 'email', 'extension', 'department', 'date', 'quantity', 'proof-to', 'deliver-to', 'project-name'];
        for (key in fields) {
            if (!$("#" + fields[key]).val()) {
                $("#" + fields[key]).parents('.form-group').addClass('has-error');
                error = true;
            }
        }
        //check radios and checkboxs
        var nameFields = ['printing', 'type[]', 'proof-type'];
        for (key in nameFields) {
            if (!$("input[name='" + nameFields[key] + "']:checked").val()) {
                $("input[name='" + nameFields[key] + "']").parents('.form-group').addClass('has-error');
                error = true;
            }
        }
        //check fields that require a file
        var fileFields = ['brochure', 'flyer', 'invitation', 'postcard', 'e-postcard', 'program', 'research-faculty'];
        for (key in fileFields) {
            if ($("#" + fileFields[key] + ":checked").val()) {
                var files = false;
                $("input[name='file[]']").each(function () {
                    if ($(this).val()) {
                        files = true;
                    }
                });
                if (!files) {
                    $("#file-group").addClass('has-error');
                    error = true;
                }
            }
        }


        //check fields that require a creative brief
        if ($("#advertising").prop("checked")) {
            if (!$("#ad-description").val()) {
                $("#ad-description").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ad-goal").val()) {
                $("#ad-goal").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ad-objective").val()) {
                $("#ad-objective").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!($("#ad-prospective-students").prop("checked") || $("#ad-current-students").prop("checked") || $("#ad-alumni").prop("checked") || $("#ad-faculty-staff").prop("checked") || $("#ad-donors-friends").prop("checked") || $("#ad-donors-friends").prop("checked"))) {
                $("#advertising").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!$("#ad-recipient-thoughts").val()) {
                $("#ad-recipient-thoughts").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ad-call-to-action").val()) {
                $("#ad-call-to-action").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ad-project-outcomes").val()) {
                $("#ad-project-outcomes").closest('.form-group').addClass('has-error');
                error = true;
            }
        }        
        if ($("#popup").prop("checked")) {
            if (!$("#pu-description").val()) {
                $("#pu-description").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pu-goal").val()) {
                $("#pu-goal").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pu-objective").val()) {
                $("#pu-objective").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!($("#pu-prospective-students").prop("checked") || $("#pu-current-students").prop("checked") || $("#pu-alumni").prop("checked") || $("#pu-faculty-staff").prop("checked") || $("#pu-donors-friends").prop("checked") || $("#pu-donors-friends").prop("checked"))) {
                $("#popup").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!$("#pu-recipient-thoughts").val()) {
                $("#pu-recipient-thoughts").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pu-call-to-action").val()) {
                $("#pu-call-to-action").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pu-project-outcomes").val()) {
                $("#pu-project-outcomes").closest('.form-group').addClass('has-error');
                error = true;
            }
        }
        if ($("#brochure").prop("checked")) {
            if (!$("#br-description").val()) {
                $("#br-description").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#br-goal").val()) {
                $("#br-goal").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#br-objective").val()) {
                $("#br-objective").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!($("#br-prospective-students").prop("checked") || $("#br-current-students").prop("checked") || $("#br-alumni").prop("checked") || $("#br-faculty-staff").prop("checked") || $("#br-donors-friends").prop("checked") || $("#br-donors-friends").prop("checked"))) {
                $("#brochure").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!$("#br-recipient-thoughts").val()) {
                $("#br-recipient-thoughts").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#br-call-to-action").val()) {
                $("#br-call-to-action").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#br-project-outcomes").val()) {
                $("#br-project-outcomes").closest('.form-group').addClass('has-error');
                error = true;
            }
        }
        if ($("#e-postcard").prop("checked")) {
            if (!$("#ep-description").val()) {
                $("#ep-description").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ep-goal").val()) {
                $("#ep-goal").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ep-objective").val()) {
                $("#ep-objective").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!($("#ep-prospective-students").prop("checked") || $("#ep-current-students").prop("checked") || $("#ep-alumni").prop("checked") || $("#ep-faculty-staff").prop("checked") || $("#ep-donors-friends").prop("checked") || $("#ep-donors-friends").prop("checked"))) {
                $("#e-postcard").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!$("#ep-recipient-thoughts").val()) {
                $("#ep-recipient-thoughts").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ep-call-to-action").val()) {
                $("#ep-call-to-action").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ep-project-outcomes").val()) {
                $("#ep-project-outcomes").closest('.form-group').addClass('has-error');
                error = true;
            }
        }
        if ($("#email-graphic").prop("checked")) {
            if (!$("#eg-description").val()) {
                $("#eg-description").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#eg-goal").val()) {
                $("#eg-goal").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#eg-objective").val()) {
                $("#eg-objective").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!($("#eg-prospective-students").prop("checked") || $("#eg-current-students").prop("checked") || $("#eg-alumni").prop("checked") || $("#eg-faculty-staff").prop("checked") || $("#eg-donors-friends").prop("checked") || $("#eg-donors-friends").prop("checked"))) {
                $("#email-graphic").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!$("#eg-recipient-thoughts").val()) {
                $("#ad-recipient-thoughts").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#eg-call-to-action").val()) {
                $("#ad-call-to-action").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#eg-project-outcomes").val()) {
                $("#eg-project-outcomes").closest('.form-group').addClass('has-error');
                error = true;
            }
        }
        if ($("#invitation").prop("checked")) {
            if (!$("#in-description").val()) {
                $("#in-description").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#in-goal").val()) {
                $("#in-goal").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#in-objective").val()) {
                $("#in-objective").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!($("#in-prospective-students").prop("checked") || $("#in-current-students").prop("checked") || $("#in-alumni").prop("checked") || $("#in-faculty-staff").prop("checked") || $("#in-donors-friends").prop("checked") || $("#in-donors-friends").prop("checked"))) {
                $("#invitation").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!$("#in-recipient-thoughts").val()) {
                $("#in-recipient-thoughts").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#in-call-to-action").val()) {
                $("#in-call-to-action").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#in-project-outcomes").val()) {
                $("#in-project-outcomes").closest('.form-group').addClass('has-error');
                error = true;
            }
        }
        if ($("#program").prop("checked")) {
            if (!$("#pr-description").val()) {
                $("#pr-description").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pr-goal").val()) {
                $("#pr-goal").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pr-objective").val()) {
                $("#pr-objective").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!($("#pr-prospective-students").prop("checked") || $("#pr-current-students").prop("checked") || $("#pr-alumni").prop("checked") || $("#pr-faculty-staff").prop("checked") || $("#pr-donors-friends").prop("checked") || $("#pr-donors-friends").prop("checked"))) {
                $("#program").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!$("#pr-recipient-thoughts").val()) {
                $("#pr-recipient-thoughts").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pr-call-to-action").val()) {
                $("#pr-call-to-action").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pr-project-outcomes").val()) {
                $("#pr-project-outcomes").closest('.form-group').addClass('has-error');
                error = true;
            }
        }
        if ($("#publicity").prop("checked")) {
            if (!$("#pu-description").val()) {
                $("#pu-description").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pu-goal").val()) {
                $("#pu-goal").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pu-objective").val()) {
                $("#pu-objective").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!($("#pu-prospective-students").prop("checked") || $("#pu-current-students").prop("checked") || $("#pu-alumni").prop("checked") || $("#pu-faculty-staff").prop("checked") || $("#pu-donors-friends").prop("checked") || $("#pu-donors-friends").prop("checked"))) {
                $("#publicity").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!$("#pu-recipient-thoughts").val()) {
                $("#pu-recipient-thoughts").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pu-call-to-action").val()) {
                $("#pu-call-to-action").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#pu-project-outcomes").val()) {
                $("#pu-project-outcomes").closest('.form-group').addClass('has-error');
                error = true;
            }
        }
        if ($("#project-other").prop("checked")) {
            if (!$("#ot-description").val()) {
                $("#ot-description").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ot-goal").val()) {
                $("#ot-goal").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ot-objective").val()) {
                $("#ot-objective").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!($("#ot-prospective-students").prop("checked") || $("#ot-current-students").prop("checked") || $("#ot-alumni").prop("checked") || $("#ot-faculty-staff").prop("checked") || $("#ot-donors-friends").prop("checked") || $("#ot-donors-friends").prop("checked"))) {
                $("#project-other").closest('.form-group').addClass('has-error');
                error = true;
            }

            if (!$("#ot-recipient-thoughts").val()) {
                $("#ot-recipient-thoughts").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ot-call-to-action").val()) {
                $("#ot-call-to-action").closest('.form-group').addClass('has-error');
                error = true;
            }
            if (!$("#ot-project-outcomes").val()) {
                $("#ot-project-outcomes").closest('.form-group').addClass('has-error');
                error = true;
            }
        }

        //nested fields
        if ($("#advertising").prop("checked")) {
            if (!($("#advertising-print").prop("checked") || $("#advertising-online").prop("checked"))) {
                $("#advertising-print").closest('.form-group').addClass('has-error');
                error = true;
            } else {
                if ($("#advertising-print").prop("checked")) {
                    if (!$("input[name='advertising-print-color']:checked").val()) {
                        $("input[name='advertising-print-color']").closest('.form-group').addClass('has-error');
                        error = true;
                    }
                    if (!$("#advertising-print-size").val()) {
                        $("#advertising-print-size").closest('.form-group').addClass('has-error');
                        error = true;
                    }
                }
                if ($("#advertising-online").prop("checked")) {
                    if (!$("input[name='advertising-online-color']:checked").val()) {
                        $("input[name='advertising-online-color']").closest('.form-group').addClass('has-error');
                        error = true;
                    }
                    if (!$("#advertising-online-size").val()) {
                        $("#advertising-online-size").closest('.form-group').addClass('has-error');
                        error = true;
                    }
                }
            }
        }
        if ($("#email-graphic").prop("checked")) {
            if (!$("#email-graphic-size").val()) {
                $("#email-graphic-size").closest('.form-group').addClass('has-error');
            }
            if (!$("#email-graphic-type").val()) {
                $("#email-graphic-type").closest('.form-group').addClass('has-error');
            }
            if (!$("#email-graphic-text").val()) {
                $("#email-graphic-size").closest('.form-group').addClass('has-error');
            }
        }
        if ($("#led").prop("checked")) {
            if (!$("#led-1").val()) {
                $("#led-1").closest('.form-group').addClass('has-error');
            }
        }
        if ($("#banner").prop("checked")) {
            if (!$("#banner-size").val()) {
                $("#banner-size").closest('.form-group').addClass('has-error');
            }
            if (!$("#banner-text").val()) {
                $("#banner-text").closest('.form-group').addClass('has-error');
            }
        }
        if ($("#other").prop("checked")) {
            if (!$("#other-text").val()) {
                $("#other-text").closest('.form-group').addClass('has-error');
            }
        }
        if ($("#publicity").prop("checked")) {
            if (!$("#publicity-what").val()) {
                $("#publicity-what").closest('.form-group').addClass('has-error');
            }
            if (!$("#publicity-why").val()) {
                $("#publicity-why").closest('.form-group').addClass('has-error');
            }
        }
        if ($("#research").prop("checked")) {
            if (!$("#research-faculty:checked").val()) {
                $("#research-faculty").closest('.form-group').addClass('has-error');
            } else if (!$("#research-size").val()) {
                $("#research-size").closest('.form-group').addClass('has-error');
            }
            if ($("#research-student:checked").val()) {
                $("#research-student").closest('.form-group').addClass('has-error');
            }
        }
        //check file sizes
        /*$("input[name='file[]']").each(function () {
         if ($(this).val()) {
         alert($(this)[0].files[0].size);
         }
         });*/
        if ($(".form-group").hasClass('has-error')) {
            $("#error-box").show();
            $("body").scrollTo("#error-box");
            return false;
        }
    });

</script>