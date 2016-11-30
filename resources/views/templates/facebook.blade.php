<?php foreach ($settings->data as $net_data) { ?>
	<div class="col-sm-3 mix <?php echo $network; ?>">
		<div class="nm-<?php echo $network; ?>">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php if (isset($net_data->picture)) { ?>
						<div class="thumbnail">
							<img src="<?php echo $net_data->picture; ?>" class="img-responsive">
						</div>
					<?php } ?>
					<?php echo (isset($net_data->name)) ? '<b>'.$net_data->name.'</b>' : '' ; ?>
					<p class="text-justify">
						<?php echo (isset($net_data->message)) ? $net_data->message : '' ; ?>
						<?php echo (isset($net_data->description)) ? $net_data->description : '' ; ?>
					</p>
					</div>
				<div class="panel-footer">
					<i class="fa fa-facebook"></i>
					<a href="<?php echo (isset($net_data->link)) ? $net_data->link : '' ; ?>">Posted </a>
					<?php echo $pagescontroller->time_elapsed_string($net_data->created_time); ?>
				</div>
			</div>
		</div>
	</div>	
<?php } ?>
