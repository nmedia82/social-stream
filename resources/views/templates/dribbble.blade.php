<?php foreach ($settings as $net_data) { ?>
	<div class="col-sm-3 mix <?php echo $network; ?>">
		<div class="nm-<?php echo $network; ?>">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="thumbnail">
			    		<img src="<?php echo $net_data->images->normal; ?>">
			    	</div>
			    	<h6><?php echo $net_data->title; ?></h6>
			    	<p>
			    		<?php echo $net_data->description; ?>
			    	</p>
				</div>
			  	<div class="panel-footer">
			  		<i class="fa fa-dribbble"></i>
			  		<a target="<?php echo $links_target; ?>" href="">Dribbled </a>
			  		<?php echo $pagescontroller->time_elapsed_string($net_data->created_at); ?>
			  	</div>
			</div>
		</div>
	</div>	
<?php } ?>