
//Constant URL


// const URL_POST_REGISTER = 'register';
//Ajax function
    function myAjaxCall(url, method,data, successFunction, errorFunction,successMessage, errorMessage) {
        $.ajax({
            url: url,
            type: method,
            data: data,
            beforeSend: function() {
                $("#spinner").show();
                $("body").append("<div class='overlay'></div>");
            },
            success: function(response) {
                $.growl.success({
                    message: successMessage
                });
                successFunction(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $.growl.error({
                    message: errorMessage
                });
                console.log(textStatus, errorThrown);
                if (errorFunction) {
                    errorFunction(jqXHR.responseText);
                }
                if (jqXHR.status === 422) {
                    var response = JSON.parse(jqXHR.responseText);
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
            },
            complete: function() {
                $("#spinner").hide();
                $(".overlay").remove();
            }
        });
    }


