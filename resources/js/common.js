


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        cache: false
    });

    $(document).on("ajaxStop", function(){
        $("#spinner").hide();
        $(".overlay").remove();
    });

    $(document).on("ajaxStart", function(){
        $("#spinner").show();
        $("body").append("<div class='overlay'></div>");
    });

    $(document).on("ajaxSuccess", function(event, xhr, settings){
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
            $.growl.success({
                message: response.success
            });
        }
        if (response.error) {
            console.log(response.error);
            $.growl.error({
                message: response.error
            });
        }
    });

    $(document).on("ajaxError", function(event, jqXHR, ajaxSettings, thrownError){
        if (jqXHR.status !== 422) {
            $.growl.error({
                message: 'An error occurred, please try again !'
            });
        }
        if (jqXHR.status === 422) {
            try {
              var response = JSON.parse(jqXHR.responseText);
              console.log(response);
            } catch(e) {
              console.log("Error parsing response:", e);
              return;
            }
            var errors = response.errors;
            var errorMsgs = '';
            for (var key in errors) {
                if (errors.hasOwnProperty(key)) {
                    errorMsgs += errors[key][0] + '<br/>';
                }
            }
            $.growl.error({
                message: errorMsgs
            });
        }
    });
