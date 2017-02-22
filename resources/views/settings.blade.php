<div class="content-wrapper">
	<link rel="stylesheet" href="{{ URL::asset('css/iris.min.css') }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>

    {{ Form::open(array('url' => url('/settings'), 'class'=>'form-horizontal')) }}
    <?php
    	$saved_settings = array();
    	$saved_custom_css = '';

    	foreach ($global_settings as $value) {
    	$saved_settings = json_decode($value->styles, true);
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
					<div class="col-sm-6">
						<div class="form-group">
							<label for="bgcolor" class="col-sm-5 control-label">Background Color</label>
							<div class="col-sm-7">
								<input type="text" class="form-control colorpicker" id="bgcolor" name="styles[bgcolor]" value="<?php echo (isset($saved_settings['bgcolor'])) ? $saved_settings['bgcolor'] : '' ; ?>">
							</div>
						</div>
						    
						@foreach ($networks as $network)
							<div class="form-group">
								<label for="color_{{$network['id']}}" class="col-sm-5 control-label">
									<i class="fa {{$network['class']}}"></i> {{$network['label']}} Color
								</label>
								<div class="col-sm-7">
									<?php
										$colorname = 'color_'.$network['id'];
										$saved_color = (isset($saved_settings[$colorname])) ? $saved_settings[$colorname] : '' ; ?>
									<input type="text" class="form-control colorpicker" id="color_{{$network['id']}}" name="styles[color_{{$network['id']}}]" value="<?php echo $saved_color; ?>">
								</div>
							</div>
						@endforeach						
					</div>
					<div class="col-sm-6">
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
						
					</div>
					<div class="col-sm-12">
						<hr>
						<div class="form-group">
							<label for="custom_css" class="col-sm-2 control-label">Custom CSS</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="custom_css" name="custom_css"><?php echo $saved_custom_css; ?></textarea>
							</div>
						</div>						
					</div>
					<div class="col-sm-12 text-right">
						<div class="nmcolorSelector">
							<div style="background-color: #0000ff"></div>
						</div>
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