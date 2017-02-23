<?php foreach ($settings->response->posts as $net_data) { ?>
	<div class="col-sm-3 mix <?php echo $network; ?>">
		<div class="nm-<?php echo $network; ?>">
			<div class="panel panel-default">
				<div class="panel-body">
					<p class="text-justify">
			  			<?php echo (isset($net_data->caption)) ? $net_data->caption : '' ; ?>	
					</p>
				</div>
			  <div class="panel-footer">
			  	<i class="fa fa-tumblr"></i>
			  	<a href="" target="<?php echo $links_target; ?>">Tumblr</a>
			  	<?php echo $pagescontroller->time_elapsed_string($net_data->date) ; ?>
			  </div>
			</div>
		</div>
	</div>
<?php } ?>