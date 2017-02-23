<div class="content-wrapper">
	<link rel="stylesheet" href="{{ URL::asset('css/iris.min.css') }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>

    {{ Form::open(array('url' => url('/settings'), 'class'=>'form-horizontal')) }}
    <?php
    	$saved_settings = array();
    	$saved_options = array();
    	$saved_custom_css = '';

    	foreach ($global_settings as $value) {
    	$saved_settings = json_decode($value->styles, true);
    	$saved_options = json_decode($value->general_settings, true);
    	$saved_custom_css = $value->css;
    	
    }
    ?>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Settings</h3>
            </div>
            <div class="box-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-3">
								<div class="nmcolorSelector" id="backgroundcolor">
									<div style="background-color: #<?php echo (isset($saved_settings['bgcolor'])) ? $saved_settings['bgcolor'] : '' ; ?>"></div>
									<input type="hidden" class="form-control" id="bgcolor" name="styles[bgcolor]" value="<?php echo (isset($saved_settings['bgcolor'])) ? $saved_settings['bgcolor'] : '' ; ?>">
								</div>
								<label style="float: left;margin-top: 7px;margin-left: 11px;">Background</label>
							</div>
								
							@foreach ($networks as $network)
								<div class="col-sm-3">
									<?php
										$colorname = 'color_'.$network['id'];
										$saved_color = (isset($saved_settings[$colorname])) ? $saved_settings[$colorname] : '' ; ?>
									<div class="nmcolorSelector" id="<?php echo $colorname; ?>">
										<div style="background-color: #<?php echo $saved_color; ?>"></div>
										<input type="text" class="form-control colorpicker" id="color_{{$network['id']}}" name="styles[color_{{$network['id']}}]" value="<?php echo $saved_color; ?>">
									</div>
									<label style="float: left;margin-top: 7px;margin-left: 11px;">{{$network['label']}}</label>
								</div>
							@endforeach
						    
						</div>
					</div>
					<div class="clearfix"></div>
					<br><br>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-5 control-label">Controls</label>
							<div class="col-sm-7">
								<div class="checkbox">
									<label><input type="checkbox" name="settings[filter_networks]" <?php echo (isset($saved_options['filter_networks'])) ? 'checked' : '' ; ?>> Enable </label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="topbar_align" class="col-sm-5 control-label">Top Bar Alignment</label>
							<div class="col-sm-7">
								<?php $selected_topbar_align = (isset($saved_options['topbar_align'])) ? $saved_options['topbar_align'] : '' ; ?>
								<select class="form-control" id="topbar_align" name="settings[topbar_align]">
									<option value="center" <?php echo ($selected_topbar_align == 'center') ? 'selected' : '' ; ?>>Center</option>
									<option value="left" <?php echo ($selected_topbar_align == 'left') ? 'selected' : '' ; ?>>Left</option>
									<option value="right" <?php echo ($selected_topbar_align == 'right') ? 'selected' : '' ; ?>>Right</option>
								</select>								
							</div>
						</div>

						<div class="form-group">
							<label for="topbar" class="col-sm-5 control-label">Top Bar Color</label>
							<div class="col-sm-7">
								<?php $selected_topbar = (isset($saved_settings['topbar'])) ? $saved_settings['topbar'] : '' ; ?>
								<select class="form-control" id="topbar" name="styles[topbar]">
									<option value="primary" <?php echo ($selected_topbar == 'primary') ? 'selected' : '' ; ?>>Blue</option>
									<option value="info" <?php echo ($selected_topbar == 'info') ? 'selected' : '' ; ?>>Sky</option>
									<option value="warning" <?php echo ($selected_topbar == 'warning') ? 'selected' : '' ; ?>>Orange</option>
									<option value="danger" <?php echo ($selected_topbar == 'danger') ? 'selected' : '' ; ?>>Red</option>
									<option value="success" <?php echo ($selected_topbar == 'success') ? 'selected' : '' ; ?>>Green</option>
									<option value="default" <?php echo ($selected_topbar == 'default') ? 'selected' : '' ; ?>>Default</option>
								</select>								
							</div>
						</div>

						
						<div class="form-group">
							<label for="orderby" class="col-sm-5 control-label">Order</label>
							<div class="col-sm-7">
								<?php $selected_orderby = (isset($saved_options['orderby'])) ? $saved_options['orderby'] : '' ; ?>
								<select class="form-control" id="orderby" name="settings[orderby]">
									<option value="asc_date" <?php echo ($selected_orderby == 'asc_date') ? 'selected' : '' ; ?>>Ascending Date</option>
									<option value="desc_date" <?php echo ($selected_orderby == 'desc_date') ? 'selected' : '' ; ?>>Descending Date</option>
									<option value="random" <?php echo ($selected_orderby == 'random') ? 'selected' : '' ; ?>>Random</option>
								</select>								
							</div>
						</div>
						

						<div class="form-group">
							<label for="height" class="col-sm-5 control-label">Height <small>(Leave Blank for Auto)</small></label>
							<div class="col-sm-7">
								<?php $selected_height = (isset($saved_options['height'])) ? $saved_options['height'] : '' ; ?>
								<input type="text" class="form-control" id="height" name="settings[height]" value="<?php echo $selected_height; ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="height" class="col-sm-5 control-label">Results <small>(Leave Blank for All)</small></label>
							<div class="col-sm-7">
								<?php $selected_results = (isset($saved_options['results'])) ? $saved_options['results'] : '' ; ?>
								<input type="number" class="form-control" id="results" name="settings[results]" value="<?php echo $selected_results; ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label for="orderby" class="col-sm-5 control-label">Links Target</label>
							<div class="col-sm-7">
								<?php $selected_links = (isset($saved_options['links'])) ? $saved_options['links'] : '' ; ?>
								<select class="form-control" id="links" name="settings[links]">
									<option value="_blank" <?php echo ($selected_links == '_blank') ? 'selected' : '' ; ?>>New Window</option>
									<option value="_self" <?php echo ($selected_links == '_self') ? 'selected' : '' ; ?>>Same Window</option>
									<option value="_parent" <?php echo ($selected_links == '_parent') ? 'selected' : '' ; ?>>Parent Frameset</option>
									<option value="_top" <?php echo ($selected_links == '_top') ? 'selected' : '' ; ?>>Full Body of the Window</option>
								</select>								
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="custom_css" class="col-sm-4 control-label">Custom CSS</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="custom_css" name="custom_css"><?php echo $saved_custom_css; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-sm-12 text-right">
						<input type="submit" class="btn btn-lg btn-success" value="Save Changes">
					</div>
				</div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    {!! Form::close() !!}                
</div>