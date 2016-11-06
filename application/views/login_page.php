<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to CodeIgniter</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/bootstrap/css/bootstrap.css"?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/dist/css/AdminLTE.css"?>">
		<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()."asset/bootstrap/js/bootstrap.js"?>"> -->

		<style type="text/css">
			.loginbox{
				margin: 180px auto;
				width: 450px;
				position: relative;
				border-radius: 15px;
				background: #ffffff;
			}
			body{
				background-color: rgb(209, 209, 209);
			}
		</style>
	</head>

	<body>
		<div id="container">
			<div class="box box-info loginbox">
		        <div class="box-header with-border">
		          <h3 class="box-title">Login Form</h3>
		        </div>
		        <!-- /.box-header -->
		        <!-- form start -->
		        <?php
		        	if(isset($_POST['sign_in'])){
		        		// $username = $this->input->post('username');
		        		// $password = $this->input->post('password');
		        		$this->db_model->getLoginData(
		        			$this->input->post('username'), 
		        			$this->input->post('password')
	        			);

		        		// if($username == 'admin' && $password=='admin'){
		        		// 	header('location:'.base_url().'admin');
		        		// }
		        	}
		        ?>
		        <form class="form-horizontal" method="POST" action="">
		          <div class="box-body">
		            <div class="form-group">
		              <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

		              <div class="col-sm-10">
		                <input type="text" class="form-control" name="username" placeholder="Username">
		              </div>
		            </div>
		            <div class="form-group">
		              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

		              <div class="col-sm-10">
		                <input type="password" class="form-control" name="password" placeholder="Password">
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="col-sm-offset-2 col-sm-10">
		                <div class="checkbox">
		                  <label>
		                    <input type="checkbox"> Remember me
		                  </label>
		                </div>
		              </div>
		            </div>
		          </div>
		          <!-- /.box-body -->
		          <div class="box-footer">
		            <button type="reset" class="btn btn-default">Cancel</button>
		            <button type="submit" name="sign_in" class="btn btn-info pull-right">Sign in</button>
		          </div>
		          <!-- /.box-footer -->
		        </form>
	      	</div>
		</div>
	</body>
</html>