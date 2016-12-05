<?php foreach ($settings->items as $net_data) { ?>
<div class="col-sm-3 mix <?php echo $network; ?>">
	<div class="nm-<?php echo $network; ?>">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="thumbnail">
		    		<img src="<?php echo $net_data->snippet->thumbnails->default->url; ?>" class="img-responsive">
		    	</div>
				<h6><b><?php echo $net_data->snippet->title; ?></b></h6>
			</div>
		  <div class="panel-footer">
		  	<i class="fa fa-youtube"></i>
		  	<a href="#">Uploaded </a><?php echo $pagescontroller->time_elapsed_string($net_data->snippet->publishedAt); ?>
		  </div>
		</div>
	</div>
</div>
<?php } ?>