{{-- modal add role --}}
<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="ModalRole" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalRole">Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" class="col-12 col-md-12 p-0 m-0">
                    @csrf
                    <div class="col col-12 col-md-12">Name Role</div>
                    <div class="col col-12 col-lg-12 mt-2">
                        <input class="form-control w-100" name="name" id="name" type="text"
                            value="{{ old('name') }}">
                        <p class="w-100 error text-danger">{{ $errors->first('name') }}</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" id="submitForm" data-id="#" class="btn btn-primary waves-effect">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
