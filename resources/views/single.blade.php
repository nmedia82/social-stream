<div class="row">
	<?php if (isset($saved_options['filter_networks'])) { ?>
		<div class="col-md-12 text-<?php echo (isset($saved_options['topbar_align'])) ? $saved_options['topbar_align'] : 'center' ; ?>">
			<br>
			<div class="btn-group" role="group" aria-label="...">
			   <button class="btn btn-<?php echo (isset($saved_settings['topbar'])) ? $saved_settings['topbar'] : 'primary' ; ?> filter" data-toggle="tooltip" title="All Feeds" data-filter="*">All</button>
				<?php foreach ($social_data as $network => $settings) { ?>
				   <button class="btn btn-<?php echo (isset($saved_settings['topbar'])) ? $saved_settings['topbar'] : 'primary' ; ?> filter" data-filter=".<?php echo $network; ?>"><i class="fa fa-<?php echo $network; ?>"></i></button>
				<?php } ?>
			</div>
		</div>
		
	<?php } ?>
</div>
<br><br>
<div class="row" id="sortable-columns">
	<?php
	$links_target = (isset($saved_options['links'])) ? $saved_options['links'] : '' ;
	foreach ($social_data as $network => $settings) { ?>
		@include('templates/'.$network)
	<?php } ?>

</div>
<?php
	// echo '<pre>';
	// var_dump($social_data['twitter']);
	// echo '</pre>';
?>

<div class="contents">
	{!! $page_contents !!}
</div>