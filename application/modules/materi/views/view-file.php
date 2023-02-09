<div class="text-center">
	<div style="width:92%;;background-color: red;position: absolute;opacity: 0;"></div>
	<iframe style="pointer-events:visibleStroke;" onclick="cek(e)" oncontextmenu="cek(r)" src="<?= base_url("directory/MATERI/$file->company_id/$file->document"); ?>#toolbar=0&navpanes=0" frameborder="0" width="100%" height="450"></iframe>
</div>

<script>
	function cek(e) {
		console.log(e);
		alert(e);
	}
</script>