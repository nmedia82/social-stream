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
                    <tr>
                        <td>A test stream</td>
                        <td>[stream id="1"]</td>
                        <td>5</td>
                        <td>25 July 2015</td>
                        <td>
                            <button class="btn btn-info btn-xs">Edit</button>
                            <button class="btn btn-danger btn-xs">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Another stream</td>
                        <td>[stream id="2"]</td>
                        <td>13</td>
                        <td>26 June 2015</td>
                        <td>
                            <button class="btn btn-info btn-xs">Edit</button>
                            <button class="btn btn-danger btn-xs">Delete</button>
                        </td>
                    </tr>
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
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>