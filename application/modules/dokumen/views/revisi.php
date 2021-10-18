<form id="revisi">
	<input type="hidden" name="id" value="<?= $row->id; ?>">
	<input type="hidden" name="table" value="<?= $table; ?>">
	<h4 for="">Alasan Revisi</h4>
	<textarea name="keterangan" id="msg" class="form-control" cols="30" rows="5" placeholder="Tulis alasan & keterangan revisi dokumen"></textarea>
</form>
<div class="mt-5">
	<button type="button" class="btn btn-success" id="save_revisi"><i class="fa fa-save"></i>Save</button>
</div>