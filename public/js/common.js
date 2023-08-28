
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     beforeSend: function() {
    //         $("#spinner").show();
    //         $("body").append("<div class='overlay'></div>");
    //     },
    //     success: function(data) {
    //         if (data.success) {
    //             $.growl.success({
    //                 message: data.success
    //             });
    //         }
    //         if (data.error) {
    //             $.growl.error({
    //                 message: data.error
    //             });
    //         }
    //     },
    //     error: function(jqXHR, textStatus, errorThrown) {
    //         console.log(textStatus, errorThrown);
    //         if (errorFunction) {
    //             errorFunction(jqXHR.responseText);
    //         }
    //         if (jqXHR.status === 422) {
    //             var response = JSON.parse(jqXHR.responseText);
    //             var errors = response.errors;
    //             var errorMsgs = '';
    //             for (var key in errors) {
    //                 if (errors.hasOwnProperty(key)) {
    //                     errorMsgs += errors[key][0] + '<br/>';
    //                 }
    //             }
    //             $.growl.error({
    //                 message: errorMsgs
    //             });
    //         }
    //     },
    //     complete: function () {
    //         $("#spinner").hide();
    //         $(".overlay").remove();
    //     },
    // });
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
        debugger;
        $("#spinner").show();
        $("body").append("<div class='overlay'></div>");
    });




