<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Tambah Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="potongan">Nama Member</label>
                        <input type="text" class="form-control" id="nama" name="discount_name"
                            placeholder="Nama Member" required>
                    </div>
                    <div class="form-group">
                        <label for="potongan">Alamat</label>
                        <input type="text" class="form-control" id="potongan" name="discount_value"
                            placeholder="Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="potongan">No Telepon</label>
                        <input type="text" class="form-control" id="potongan" name="discount_value"
                            placeholder="No Telepon" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
