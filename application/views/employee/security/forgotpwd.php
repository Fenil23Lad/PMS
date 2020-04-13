<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Employee Portal | VPN</title>

        <link href="<?php echo  base_url('assets/admin/css/style.default.css');?>" rel="stylesheet">
    <style>
    	.panel-signin{
			margin: 50px auto 0 !important;	
		}
    </style>
    </head>

    <body class="signin">
        <section>  
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?php echo  base_url();?>/assets/admin/images/logo.png">
                    </div>
                    <div class="mb10"></div>
                    <h1 class="text-info text-center">Employee Portal</h1>         
                    <h3 class="text-warning text-center">Forgot Password</h3>
                    <div class="mb20"></div>
                    
                     <form action="<?php echo site_url('employee/security/forgotPassword');?>" method="post">
                            <div class="input-group mb15">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" name="email" required 
                                placeholder="Email" id="email" />
                            </div><!-- input-group -->
                            </div><!-- panel-body -->
                            <div class="panel-footer">
                            <input type="submit" class="btn btn-success btn-block"
                             name="chk_email" value="Submit" id="login_button"  />
                         </form>
                         
                   
                     
                        <a href="<?php echo site_url('employee/security/login')?>" 
                        class="btn btn-primary btn-block">Back to Login</a>
                        </div><!-- panel-footer -->
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger text-center">
                                <strong><?=$this->session->flashdata('error');?></strong>
                            </div> 
                        <?php endif; ?>
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success text-center">
                                <strong><?=$this->session->flashdata('success');?></strong>
                            </div> 
                        <?php endif; ?>
                    </div><!-- panel -->
             </form>
        </section>
        <script src="<?php echo  base_url();?>/assets/admin/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo  base_url();?>/assets/admin/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo  base_url();?>/assets/admin/js/bootstrap.min.js"></script>
        <script src="<?php echo  base_url();?>/assets/admin/js/modernizr.min.js"></script>
        <script src="<?php echo  base_url();?>/assets/admin/js/pace.min.js"></script>
        <script src="<?php echo  base_url();?>/assets/admin/js/retina.min.js"></script>
        <script src="<?php echo  base_url();?>/assets/admin/js/jquery.cookies.js"></script>
        <script src="<?php echo  base_url();?>/assets/admin/js/custom.js"></script>
    </body>
</html>
