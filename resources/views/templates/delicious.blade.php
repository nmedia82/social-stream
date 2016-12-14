<?php foreach ($settings as $net_data) { ?>
	<div class="col-sm-3 mix <?php echo $network; ?>">
		<div class="nm-<?php echo $network; ?>">
			<div class="panel panel-default">
				<div class="panel-body">
					<p class="text-justify">
						<?php echo (isset($net_data->d)) ? $net_data->d : '' ; ?>
					</p>
					</div>
				<div class="panel-footer">
					<i class="fa fa-delicious"></i>
					<a href="<?php echo (isset($net_data->u)) ? $net_data->u : '' ; ?>">Posted </a>
					<?php echo $pagescontroller->time_elapsed_string($net_data->dt); ?>
				</div>
			</div>
		</div>
	</div>	
<?php } ?>
