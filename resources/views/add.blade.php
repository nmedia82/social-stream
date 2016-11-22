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
        <?php
            $socialNetworks = array(
                array(
                    'label' => 'Facebook',
                    'id' => 'facebook',
                    'class' => 'fa-facebook-official',
                ),
                array(
                    'label' => 'Twitter',
                    'id' => 'twitter',
                    'class' => 'fa-twitter',
                ),
                array(
                    'label' => 'Google+',
                    'id' => 'googleplus',
                    'class' => 'fa-google-plus',
                ),
                array(
                    'label' => 'RSS',
                    'id' => 'rss',
                    'class' => 'fa-rss',
                ),
                array(
                    'label' => 'Flickr',
                    'id' => 'flickr',
                    'class' => 'fa-flickr',
                ),
                array(
                    'label' => 'Delicious',
                    'id' => 'delicious',
                    'class' => 'fa-delicious',
                ),
                array(
                    'label' => 'YouTube',
                    'id' => 'youtube',
                    'class' => 'fa-youtube',
                ),
                array(
                    'label' => 'Pinterest',
                    'id' => 'pinterest',
                    'class' => 'fa-pinterest-p',
                ),
                array(
                    'label' => 'Last.FM',
                    'id' => 'lastfm',
                    'class' => 'fa-lastfm',
                ),
                array(
                    'label' => 'Dribble',
                    'id' => 'dribble',
                    'class' => 'fa-dribbble',
                ),
                array(
                    'label' => 'Vimeo',
                    'id' => 'vimeo',
                    'class' => 'fa-vimeo',
                ),
                array(
                    'label' => 'Stumbleupon',
                    'id' => 'stumbleupon',
                    'class' => 'fa-stumbleupon',
                ),
                array(
                    'label' => 'Deviantart',
                    'id' => 'deviantart',
                    'class' => 'fa-deviantart',
                ),
                array(
                    'label' => 'Tumblr',
                    'id' => 'tumblr',
                    'class' => 'fa-tumblr',
                ),
                array(
                    'label' => 'Instagram',
                    'id' => 'instagram',
                    'class' => 'fa-instagram',
                ),
            );
        ?>
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
                            {{ Form::text('stream_title', '', ['class' => 'form-control']) }}
                        </div>
                    </div>                    
                    <div class="social-settings" data-example-id="togglable-tabs">
                        <ul class="nav nav-tabs" id="#social-nav" role="tablist">
                            @foreach ($socialNetworks as $network)
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
                            @foreach ($socialNetworks as $network)
                                <div class="tab-pane fade @if($loop->first) active @endif in" role="tabpanel" id="{{$network['id']}}">
                                    Fields for {{$network['label']}}
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