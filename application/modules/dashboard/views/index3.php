<div class="col-md-4">
  <!-- Info Boxes Style 2 -->
  <div class="info-box bg-red">
   
    <span class="info-box-icon"><i class="ion ion-folder"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">OPEN</span>
      <span class="info-box-number"><?php echo $open ?></span>
      <div class="progress">
        <div class="progress-bar" style="width: 100%"></div>
      </div>
      <span class="progress-description">
       <a href="<?= base_url('meeting/listmom_open') ?>"> Detail
			
			<i class="fa fa-arrow-circle-right"></i>
      </span>
    </div><!-- /.info-box-content -->
	</a>
  </div><!-- /.info-box -->
</div>
<div class="col-md-4">
  <div class="info-box bg-yellow">
  
    <span class="info-box-icon"><i class="ion ion-gear-b"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">DONE</span>
      <span class="info-box-number"><?php echo $done ?></span>
      <div class="progress">
        <div class="progress-bar" style="width: 100%"></div>
      </div>
      <span class="progress-description">
      <a href="<?= base_url('meeting/listmom_done') ?>"> Detail			
			<i class="fa fa-arrow-circle-right"></i>
      </span>
    </div><!-- /.info-box-content -->
	</a>
  </div><!-- /.info-box -->
</div>
<div class="col-md-4">
  <div class="info-box bg-green">
  
    <span class="info-box-icon"><i class="ion ion-clipboard"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">CLOSE</span>
     <span class="info-box-number"><?php echo $close ?></span>
      <div class="progress">
        <div class="progress-bar" style="width: 100%"></div>
      </div>
      <span class="progress-description">
        <a href="<?= base_url('meeting/listmom_close') ?>"> Detail			
			<i class="fa fa-arrow-circle-right"></i>
      </span>
    </div><!-- /.info-box-content -->
	</a>
  </div><!-- /.info-box -->
</div>
<div class="col-md-4">
  <div class="info-box bg-blue">
  
    <span class="info-box-icon"><i class="ion ion-clipboard"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">LATE</span>
     <span class="info-box-number"><?php echo $late ?></span>
      <div class="progress">
        <div class="progress-bar" style="width: 100%"></div>
      </div>
      <span class="progress-description">
        <a href="<?= base_url('meeting/listmom_late') ?>"> Detail			
			<i class="fa fa-arrow-circle-right"></i>
      </span>
    </div><!-- /.info-box-content -->
	</a>
  </div><!-- /.info-box -->
</div>