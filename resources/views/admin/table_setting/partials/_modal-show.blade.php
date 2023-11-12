<div class="modal fade" id="show-qr" tabindex="-1" role="dialog" aria-labelledby="ModalRole" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Show QR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 d-flex">
                    <img src="{{ asset('storage/qr_codes/' . $table->qr)  }}" alt="" width="100%">
                </div>
            </div>
        </div>
    </div>
</div>
