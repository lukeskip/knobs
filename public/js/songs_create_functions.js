Dropzone.autoDiscover = false;
$(document).ready(function () {
    $("#upload-files").dropzone({
        url: "/upload/mp3",
        autoProcessQueue: true,
        uploadMultiple: false,
        maxFilezise: 15,
        maxFiles: 1,
        acceptedFiles: ".mp3",
        success: function (file, response) {
            $("#song_file").val(response.file);
        },

        init: function () {
            this.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        },
    });

    $("#fields").validate({
        ignore: ".ignore",
        rules: {
            link: {
                required: function (element) {
                    return $("#song_file").val() == "";
                },
            },
            song_file: {
                required: function (element) {
                    return $("#link").val() == "";
                },
            },
        },
        invalidHandler: function (form, validator) {
            show_message(
                "error",
                "¡Error!",
                "Tienes que llenar todos los campos señalados"
            );

            //validator.errorMap is an object mapping input names -> error messages
            for (var i in validator.errorMap) {
                console.log(i, ":", validator.errorMap[i]);
            }
        },
        submitHandler: function (form) {
            register();
        },
    });

    $("body").on("click", ".submit", function (e) {
        e.preventDefault();
        $("#fields").submit();
    });

    // $("body").on('click', '.select', function(e) {
    // 	e.preventDefault();
    // 	target = $(this).closest('.profile');
    // 	console.log(target);
    // 	$('.profile').each(function(){
    // 		$(this).removeClass('selected');
    // 	});

    // 	$('.profile-selection').val(target.data('id'));
    // 	target.addClass('selected');

    // });

    function register() {
        conection("POST", $("#fields").serialize(), "/songs", true).then(
            function (data) {
                if (data.success) {
                    show_message(
                        "success",
                        "¡Listo!",
                        "Tu canción fue registrada",
                        data.redirect
                    );
                } else {
                    show_message("error", "Error!", data.message);
                }
            }
        );
    }
});
