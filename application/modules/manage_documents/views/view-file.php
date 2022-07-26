<div class="text-center">
	<div style="width:92%;height:400px;background-color: red;position: absolute;opacity: 0;"></div>
	<iframe style="pointer-events:visibleStroke;" onclick="cek(e)" oncontextmenu="cek(r)" src="<?= base_url("directory/$parent_name/$file->file_name"); ?>#toolbar=0&navpanes=0" frameborder="0" width="100%" height="400px"></iframe>
	<!-- <iframe style="pointer-events:visibleStroke;" src="<?= base_url($this->uri->segment(1) . "/viewfile/$parent_name/$file->file_name"); ?>#toolbar=0&navpanes=0" frameborder="0" width="100%" height="400px"></iframe> -->
</div>

<script>
	function cek(e) {
		console.log(e);
		alert(e);
	}
</script>