<div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-sitemap"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                <li>Access Control</li>
            </ul>
            <h4>Access Control</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->

<div class="contentpanel">
	<?php if ($this->session->flashdata('notification')): ?>
    <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <strong><?php echo $this->session->flashdata('notification') ?></strong>
    </div>					
    <?php endif; ?>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!---------------form-group--------------------->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">        
                       <strong> Choose Designation  :</strong>
                        </label>
                        <div class="col-sm-4">
                            <select id="Designation" name="Designation" class="form-control">
                                <?php if(empty($roles)){
									echo '<option value="Select">Role Not Available</option>';
                                }
								foreach($roles as $role) 
								{
									echo '<option value="'.$role['RoleId'].'">'.$role['RoleName'].'</option>';
								} 
								?>		
                            </select>									
                        </div>
                    </div>
                    <?php if(!empty($roles)){?>
                    <div class="form_load">
                    </div>
                    <?php }?>
                </div>
            </div>                                                                       
        </div><!-- col-md-8 --> 
    </div>
</div><!-- contentpanel --> 
<script>
$('.form_load').load('<?=base_url('admin/accesscontrol/tabs/2')?>');
$('select#Designation').change(function(){
	$('.form_load').load('<?=base_url('admin/accesscontrol/tabs/')?>/'+$(this).val());
});

</script>