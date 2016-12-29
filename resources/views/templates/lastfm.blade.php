<?php
if (isset($settings->recenttracks->track)) {
	foreach ($settings->recenttracks->track as $net_data) { ?>
		<div class="col-sm-3 mix <?php echo $network; ?>">
			<div class="nm-<?php echo $network; ?>">
				<div class="panel panel-default">
					<div class="panel-body">
						<a href="#">
							<span class="fa fa-headphones">
								<b><?php echo $net_data->name; ?></b>
							</span>
						</a>
					</div>
				  <div class="panel-footer">
				  	<i class="fa fa-lastfm"></i>
				  	<a href="">lestened to </a>
				  		<?php echo $net_data->date->{'#text'}; ?>
				  </div>
				</div>
			</div>
		</div>
<?php 	
	}
} ?>
