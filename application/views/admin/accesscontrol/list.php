<?php

$tablist = array('Projects',

			'Add Project',

			'Edit Project',
			
			'Delete  Project',
			
			'Update Project Status',
			
			'Users',
			
			'Add User',
			
			'Edit User',
			
			'Delete User',
			
			'Employee Designation',
			
			'Add Designation',
			
			'Edit Designation',
			
			'Delete Designation',
			
			'Project Categories',
			
			'Add Project Category',
			
			'Edit Project Category',
			
			'Delete Project Category',
			
			'Task Sheet',

			'Add Task',

			'Edit Task',

			'Delete Task',

			'Employee Chat',

			'Email',

			'QA Sheet',

			'Add QA',

			'Edit QA',

			'Delete QA',
			
			'Manage Lead'

			);

?> 

<!---------------form-group--------------------->

<div class="form-group">

<form action="<?=base_url('admin/accesscontrol')?>" method="post">

    <input type="hidden" name="RoleId" value="<?=$Role['RoleId']?>">
	<div class="row">
    <?php foreach($tablist as $key=>$tab): ?>

	<div class="col-md-4">
        <div class="ckbox ckbox-primary">
            <input type="checkbox" name="TabName[]" value="<?=$tab?>"
            <?php if (strpos($Role['TabAccess'],$tab) !== false)echo'checked="checked"';?>
            id="Sales<?=$key?>">
            <label for="Sales<?=$key?>">
                <?=$tab?>
            </label>
        </div>
	</div> 
    
    <?php endforeach; ?> 
	</div>
    <li class="list-group-item">

          <input type="submit" name="btn_save" 

          class="btn btn-primary btn-metro" value="Save">

    </li>

</form>

</div>

              