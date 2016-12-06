<?php foreach ($settings->channel->item as $net_data) { ?>
<div class="col-sm-3 mix <?php echo $network; ?>">
	<div class="nm-<?php echo $network; ?>">
		<div class="panel panel-default">
			<div class="panel-body">
				<div>
					<?php echo $net_data->description; ?>
				</div>
				<h6><?php echo $net_data->title; ?></h6>
			</div>
		  <div class="panel-footer">
		  	<i class="fa fa-pinterest"></i>
		  	<a href="<?php echo $net_data->link; ?>">Pinned </a>
				<?php echo $pagescontroller->time_elapsed_string($net_data->pubDate); ?>
		  	</div>
		</div>
	</div>
</div>
<?php } ?>