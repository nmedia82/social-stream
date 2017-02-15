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
    <?php foreach ($global_settings as $value) {
    	var_dump($value->styles);
    } ?>
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
								<input type="text" class="form-control colorpicker" id="bgcolor" name="styles[bgcolor]">
							</div>
						</div>
						    
						@foreach ($networks as $network)
							<div class="form-group">
								<label for="color_{{$network['id']}}" class="col-sm-5 control-label">
									<i class="fa {{$network['class']}}"></i> {{$network['label']}} Color
								</label>
								<div class="col-sm-7">
									<input type="text" class="form-control colorpicker" id="color_{{$network['id']}}" name="styles[color_{{$network['id']}}]">
								</div>
							</div>
						@endforeach						
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="topbar" class="col-sm-5 control-label">Top Bar Color</label>
							<div class="col-sm-7">
								<select class="form-control" id="topbar" name="styles[topbar]">
									<option value="primary">Blue</option>
									<option value="info">Sky</option>
									<option value="warning">Orange</option>
									<option value="danger">Red</option>
									<option value="success">Green</option>
									<option value="default">Default</option>
								</select>								
							</div>
						</div>
						
					</div>
				</div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Custom CSS</h3>
            </div>
            <div class="box-body">
				<div class="form-group">
					<label for="custom_css" class="col-sm-2 control-label">Custom CSS</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="custom_css" name="custom_css"></textarea>
					</div>
				</div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>

    <section class="content">
		<input type="submit" class="btn btn-lg btn-success" value="Save Changes">
    </section>
    {!! Form::close() !!}                
</div>