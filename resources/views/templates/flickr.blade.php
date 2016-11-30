<?php foreach ($settings->items as $net_data) { ?>
	<div class="col-sm-3 mix <?php echo $network; ?>">
		<div class="nm-<?php echo $network; ?>">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="<?php echo $net_data->media->m; ?>" class="img-responsive">
			    	</div>
					<h6>
						<?php echo $net_data->title; ?>
					</h6>
					
				</div>
			  <div class="panel-footer"><i class="fa fa-flickr"></i> <a href="">Published </a>
				<?php echo $pagescontroller->time_elapsed_string($net_data->published); ?>
			  </div>
			</div>
		</div>
	</div>
<?php } ?>