//Constant value
const POS_API = 'https://backendinfo.mobileorder.club/api/client/store';
const POS_API_AUTH = 'https://backendinfo.mobileorder.club/api/client/customer';

//Constant URL
const URL_GET_CATEGORY = 'category';
const URL_GET_PRODUCT = 'category/product';
const URL_GET_BUSINESS_HOURS = 'businesshours';
const URL_GET_PRODUCT_DETAIL = 'product/detail/';
const URL_GET_HISTORY = 'order/history';
const URL_ORDER = 'order';

const URL_POST_REGISTER = 'register';
const URL_POST_LOGIN = 'auth';
const URL_POST_FORGOT_PASSWORD = 'forgotpassword';
const URL_POST_CHANGE_PASSWORD = 'changepasswordforgot';
const URL_GET_LOGOUT = 'logout';
const URL_GET_PROFILE = 'profile';
const URL_POST_UPDATE_PROFILE = 'profile';
const URL_POST_RESET_PASSWORD = 'changepassword';



// const URL_POST_REGISTER = 'register';
//Ajax function
function myAjaxCall(url, data, method, headers, successFunction, errorFunction) {
    var $spinnerOverlay = $('<div>').addClass('spinner-overlay');
    var $spinner = $('<div>').addClass('spinner');
    $('body').append($spinnerOverlay, $spinner);
    $.ajax({
        url: url,
        type: method,
        data: data,
        headers: headers,
        success: function(response) {
            successFunction(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            if (errorFunction) {
                errorFunction(jqXHR.responseText);
            }
        },
        complete: function() {
            $spinnerOverlay.remove();
            $spinner.remove();
        }
    });
}

