<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Backups';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-md-12">
			<div class="box box-info backup-index">
				<div class="box-header">
					<?= Html::a('Take Backup', ['site/backup'], ['class' => 'btn btn-success btn-flat', 'data-method' => 'post']) ?>
				</div>
				<div class="box-body table-responsive">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" style="max-width:100%;word-break:break-word;">
							<thead>
								<tr>
									<th>#</th>
									<th>File Name & Date</th>
									<th class="action-column">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php 
										$files=\yii\helpers\FileHelper::findFiles(\Yii::getAlias('@backend/web/backups'));
										if (isset($files[0])){
											rsort($files);
											foreach($files as $index => $file){
												$name = basename($file);
												$filePath = Url::base().'/../backups/'.$name;
												echo "<tr>";
													echo "<td>".($index+1)."</td>";
													echo "<td>".Html::a($name, $filePath, ['download' => true])."</td>";
													echo "<td>";
														echo Html::a("<i class='fa fa-download'></i>", $filePath, ['download' => true]);
														echo "&nbsp;";
														echo Html::a("<i class='fa fa-trash'></i>", ['delete-backup', 'name' => $name], ['data-confirm' => 'Are you sure you want to delete this file? You will not be able to recover it.', 'data-method' => 'post']);
													echo "</td>";
												echo "</tr>";
											}
										} else {
											echo "<tr>";
												echo "<td colspan='3'>";
													echo "There are no backups taken.";
												echo "</td>";
											echo "</tr>";
										}
									?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>