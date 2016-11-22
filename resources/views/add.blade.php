<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add New Stream</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Add New Stream</h3>
            </div>
            <div class="box-body">
                {{ Form::open(array('url' => url('/home'), 'class'=>'form-horizontal')) }}
                    <div class="form-group">
                        {{ Form::label('stream_title', 'Stream Title', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                            {{ Form::text('stream_title', '', ['class' => 'form-control', 'required' => 'required']) }}
                        </div>
                    </div>
                    <div class="social-settings" data-example-id="togglable-tabs">
                        <ul class="nav nav-tabs" id="#social-nav" role="tablist">
                            @foreach ($networks as $network)
                                <li role="presentation" class="@if($loop->first) active @endif">
                                    <a href="#{{$network['id']}}"
                                        role="tab" data-toggle="tooltip"
                                        title="{{$network['label']}}" 
                                        aria-controls="{{$network['label']}}"
                                        aria-expanded="true">
                                        <i class="fa {{$network['class']}}"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" style="padding: 8px 2px;">
                            @foreach ($networks as $network)
                                <div class="tab-pane fade @if($loop->first) active @endif in" role="tabpanel" id="{{$network['id']}}">
                                    <?php 
                                        if(isset($network['fields'])){
                                            foreach ($network['fields'] as $field_data) {
                                                switch ($field_data['type']) {
                                                    case 'text': ?>
                                                        <div class="form-group">
                                                            <?php echo Form::label($field_data['id'], $field_data['title'], ['class' => 'col-sm-2 control-label']) ?>
                                                            <div class="col-sm-10">
                                                                <?php echo Form::text('settings['.$network['id'].']['.$field_data['id'].']', '', ['class' => 'form-control']) ?>
                                                                <div class="help-block"><?php echo $field_data['help']; ?></div>
                                                            </div>
                                                        </div>
                                                        <?php break;
                                                    case 'select': ?>
                                                        <div class="form-group">
                                                            <?php echo Form::label($field_data['id'], $field_data['title'], ['class' => 'col-sm-2 control-label']) ?>
                                                            <div class="col-sm-10">
                                                                <?php echo Form::select('settings['.$network['id'].']['.$field_data['id'].']', $field_data['options'], '' , ['class' => 'form-control']) ?>
                                                                <div class="help-block"><?php echo $field_data['help']; ?></div>
                                                            </div>
                                                        </div>
                                                        <?php break;
                                                    case 'checkbox': ?>
                                                        <div class="form-group">
                                                            <?php echo Form::label($field_data['id'], $field_data['title'], ['class' => 'col-sm-2 control-label']) ?>
                                                            <div class="col-sm-10">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <?php echo Form::checkbox('settings['.$network['id'].']['.$field_data['id'].']', 'yes'); ?>
                                                                        <?php echo $field_data['title'];  ?>
                                                                    </label>
                                                                </div>                                                            
                                                                <div class="help-block"><?php echo $field_data['help']; ?></div>
                                                            </div>
                                                        </div>
                                                        <?php break;
                                                    
                                                    default:
                                                        # code...
                                                        break;
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                            @endforeach                        
                        </div>
                    </div>
                    <hr>
                    {!! Form::submit('Save', array('class' => 'btn btn-success pull-right')) !!}
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>