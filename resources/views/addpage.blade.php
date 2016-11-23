<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add New Page</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Add New Page</h3>
            </div>
            <div class="box-body">
                {{ Form::open(array('url' => url('/add-page'), 'class'=>'form-horizontal')) }}
                    <div class="form-group">
                        {{ Form::label('page_title', 'Page Title', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::text('page_title', '', ['class' => 'form-control', 'required' => 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('page_stream', 'Select Stream', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                        	<select name="page_stream" id="page_stream" class="form-control">                    		
		                        @if( count($all_streams) > 0)
		                          @foreach ($all_streams as $stream)
		                          	<option value="{{ $stream->id }}">{{ $stream->name }}</option>
		                          @endforeach
		                        @endif
                        	</select>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('page_contents', 'Page Contents', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                        	<textarea name="page_contents" id="page_contents" class="form-control rich-editor"></textarea>
                        </div>
                    </div>
                    <hr>
                    {!! Form::submit('Create Page', array('class' => 'btn btn-success pull-right')) !!}
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>