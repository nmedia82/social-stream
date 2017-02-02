<?php
/**
 * Laravel Installer
 * 
 **/

include_once dirname(__FILE__) . '/classInstaller.php';

if (!class_exists('NM_LV_Installer')) {
	die('You have already installed the project');
} else {
	$installer = new NM_LV_Installer();
	$requirements = $installer->check_requirements();
	$permissions = $installer->check_permissions();
}
?>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<div class="container">
	<br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Laravel Application Installer
				</div>
				<div class="panel-body">
					<!-- Requirements -->
					<div class="requirements-wrap">
						<h2 class="page-header text-center">Requirements</h2>
						<?php foreach ($requirements as $id => $data) { ?>
							<div class="alert alert-xs alert-<?php echo ($data['status']) ? 'success' : 'danger' ; ?>">
								<strong><?php echo $data['label']; ?></strong>
								<?php echo ($data['status']) ? $data['message'] : '' ; ?>
								<span class="pull-right">
									<span class="glyphicon glyphicon-<?php echo ($data['status']) ? 'ok' : 'remove' ; ?>"></span>
								</span>
							</div>
						<?php } ?>
						<hr>
						<p class="text-center">
							<button class="next btn btn-primary">Next</button>
						</p>
					</div>

					<!-- Permissions -->
					<div class="permissions-wrap">
						<h2 class="page-header text-center">Permissions</h2>

						<?php foreach ($permissions as $id => $data) { ?>
							<div class="alert alert-xs alert-<?php echo ($data['status']) ? 'success' : 'danger' ; ?>">
								<strong><?php echo $data['label']; ?></strong>
								<div class="label label-<?php echo ($data['status']) ? 'success' : 'danger' ; ?>">
									<?php echo $data['message']; ?>
								</div>
								<span class="pull-right">
									<span class="glyphicon glyphicon-<?php echo ($data['status']) ? 'ok' : 'remove' ; ?>"></span>
								</span>
							</div>
						<?php } ?>
						<hr>
						<p class="text-center">
							<button class="next btn btn-primary">Next</button>
						</p>
					</div>

					<!-- Permissions -->
					<div class="database-wrap">
						<h2 class="page-header text-center">Database Configurations</h2>
						<div class="form-group">
						    <label>Host Name</label>
						    <input type="text" name="host_name" class="form-control host-name">
						</div>
						<div class="form-group">
						    <label>Database Name</label>
						    <input type="text" name="db_name" class="form-control database-name">
						</div>
						<div class="form-group">
						    <label>Database User</label>
						    <input type="text" name="db_user" class="form-control database-user">
						</div>
						<div class="form-group">
						    <label>Database User Password</label>
						    <input type="text" name="db_pass" class="form-control database-pass">
						</div>
						<p class="text-danger resp-msg">
							Please test before installation
						</p>
						<hr>
						<p class="text-center">
							<button class="next btn btn-info test-connection">Test Connection</button>
							<button class="next btn btn-primary install-app" disabled>Run the Install</button>
						</p>
					</div>

				</div>
				
			</div>
		</div>
	</div>
</div>


<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

<script type="text/javascript">
    jQuery(function($) {
        $('.permissions-wrap').hide();
        $('.database-wrap').hide();
        $('.requirements-wrap .next').click(function(event) {
        	event.preventDefault();
        	$('.requirements-wrap').hide();
        	$('.permissions-wrap').show();
        });
        $('.permissions-wrap .next').click(function(event) {
        	event.preventDefault();
        	$('.permissions-wrap').hide();
        	$('.database-wrap').show();
        });
        $('.test-connection').click(function(event) {
        	event.preventDefault();
        	var data = {
        		db: $('.database-name').val(),
        		user: $('.database-user').val(),
        		pass: $('.database-pass').val(),
        		host: $('.host-name').val(),
        		action: 'test',
        	}
        	$.post('do-ajax.php', data, function(resp) {
        		if(resp == 'success'){
        			$('.resp-msg').html('Successfull! Now you can install application');
        			$('.resp-msg').removeClass('text-danger').addClass('text-success');
        			$('.install-app').prop('disabled', false);
        		} else {
        			$('.resp-msg').html(resp);
        			$('.resp-msg').removeClass('text-success').addClass('text-danger');
        		}
        	});
        });
        $('.install-app').click(function(event) {
        	event.preventDefault();
        	var data = {
        		db: $('.database-name').val(),
        		user: $('.database-user').val(),
        		pass: $('.database-pass').val(),
        		host: $('.host-name').val(),
        		action: 'install',
        	}
        	$.post('do-ajax.php', data, function(resp) {
        		$('.resp-msg').html(resp);
        	});
        });
    });
</script>