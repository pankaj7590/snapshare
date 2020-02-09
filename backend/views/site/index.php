<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="row">
	<div class="col-md-12">
		<?php if(Yii::$app->user->identity->isSuperAdmin()){?>
		<div class="box">
            <div class="box-header with-border">
				<h3 class="box-title">User Quota</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="row">
					<?php foreach($users as $user){?>
						<div class="col-md-3">
						  <div class="progress-group">
							<span class="progress-text"><?= $user->username;?></span>
							<span class="progress-number"><b><?= $user->usedQuota?></b>/<?= $user->disk_quota;?></span>
							<div class="progress sm">
							  <div class="progress-bar progress-bar-aqua" style="width: <?= ($user->getUsedQuota(true)*100/$user->disk_quota);?>%"></div>
							</div>
						  </div>
						</div>
						<!-- /.col -->
					<?php }?>
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header"><span class="description-percentage text-green"><i class="fa fa-users"></i> 34</span></h5>
                    <span class="description-text">Users</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header"><span class="description-percentage text-yellow"><i class="fa fa-camera"></i> 100</span></h5>
                    <span class="description-text">Albums</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header"><span class="description-percentage text-green"><i class="fa fa-image"></i> 40000</span></h5>
                    <span class="description-text">Files</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <h5 class="description-header"><span class="description-percentage text-red"><i class="fa fa-pie-chart"></i> 50gb</span></h5>
                    <span class="description-text">Memory</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
		<?php }else{?>
		<div class="box">
            <div class="box-header with-border">
				<h3 class="box-title">User Quota</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="row">
					<?php foreach($users as $user){?>
						<div class="col-md-3">
						  <div class="progress-group">
							<span class="progress-text"><?= $user->username;?></span>
							<span class="progress-number"><b><?= $user->usedQuota?></b>/<?= $user->disk_quota;?></span>
							<div class="progress sm">
							  <div class="progress-bar progress-bar-aqua" style="width: <?= ($user->getUsedQuota(true)*100/$user->disk_quota);?>%"></div>
							</div>
						  </div>
						</div>
						<!-- /.col -->
					<?php }?>
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header"><span class="description-percentage text-green"><i class="fa fa-users"></i> 34</span></h5>
                    <span class="description-text">Users</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header"><span class="description-percentage text-yellow"><i class="fa fa-camera"></i> 100</span></h5>
                    <span class="description-text">Albums</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header"><span class="description-percentage text-green"><i class="fa fa-image"></i> 40000</span></h5>
                    <span class="description-text">Files</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <h5 class="description-header"><span class="description-percentage text-red"><i class="fa fa-pie-chart"></i> 50gb</span></h5>
                    <span class="description-text">Memory</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
		<?php }?>
        </div>
        <!-- /.col -->
      </div>