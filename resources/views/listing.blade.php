<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">All Streams</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Social Streams</h3>
            </div>
            <div class="box-body">
                @if( count($all_streams) > 0)
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Stream Title</th>
                            <th>Shortcode</th>
                            <th>Social Networks</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_streams as $stream)
                        <tr>
                            <td>{{ $stream->name }}</td>
                            <td>[stream id="{{ $stream->id }}"]</td>
                            <td>
                                <?php
                                    $data_obj = json_decode($stream->settings);
                                    echo count((array)$data_obj);
                                ?>
                            </td>
                            <td>{{ $stream->created_at }}</td>
                            <td>
                                {!! Form::open(['url' => ['/home', $stream->id], 'method'=>'DELETE']) !!}
                                    <button class="btn btn-danger btn-xs">Delete</button>
                                {!! Form::close() !!}
                                <button class="btn btn-info btn-xs">Edit</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Stream Title</th>
                            <th>Shortcode</th>
                            <th>Social Networks</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>