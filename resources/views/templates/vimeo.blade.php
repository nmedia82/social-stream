<?php foreach ($settings->data as $net_data) { ?>
<div class="col-sm-3 mix <?php echo $network; ?>">
	<div class="nm-<?php echo $network; ?>">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="thumbnail">
		    		<img src="<?php echo $net_data->clip->pictures->sizes[2]->link; ?>" class="img-responsive">
		    	</div>
		    	<h6><?php echo $net_data->clip->name; ?></h6>
		    	<p>
		    		<?php echo $net_data->clip->description; ?>
		    	</p>
			</div>
		  <div class="panel-footer"><i class="fa fa-vimeo"></i>
		  <a target="<?php echo $links_target; ?>" href="<?php echo $net_data->clip->link; ?>">Created</a>
		  
			<?php echo $pagescontroller->time_elapsed_string($net_data->clip->created_time); ?>
		  </div>
		</div>
	</div>
</div>
<?php } ?>