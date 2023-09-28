<script>

    // check for error message in session
    @if (session()->has('error'))
        var errorMessage = '{{ session('error') }}';
        $.growl.error({
            message: errorMessage
        });
    @endif

    // loop through and output all errors passed to the view
    @if ($errors->any())
        var errorMessages = {!! json_encode($errors->all()) !!};
        var errorMessage = '';
        errorMessages.forEach(function(error) {
            errorMessage += '<span>' + error + '</span><br>';
        });
        $.growl.error({
            message: errorMessage
        });
    @endif

    // check for success message in session
    @if (session()->has('success'))
        var successMessage = '{{ session('success') }}';
        $.growl.success({
            message: successMessage
        });
    @endif
</script>
