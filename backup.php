<?php
//
// Created by : MEHUL V. -[VPN SOLUTION]
//
error_reporting(0);
$error='';
$loginerror='';
$success='';
//-----------------------------------------------------------------------
$zip_file_name = 'backup-'.date('d-M-Y').'.zip';
$current_folder = dirname ( __FILE__ );
//-----------------------------------------------------------------------
$dbhost = isset($_POST['HostName'])?$_POST['HostName']:'';
$dbuser = isset($_POST['UserName'])?$_POST['UserName']:'';
$dbpass = isset($_POST['Password'])?$_POST['Password']:'';
$dbname = isset($_POST['DatabaseName'])?$_POST['DatabaseName']:'';
//-----------------------------------------------------------------------
function backup_tables($host,$user,$pass,$name,$tables = '*')
{

    $link = mysql_connect($host,$user,$pass);
    mysql_select_db($name,$link);
    mysql_query("SET NAMES 'utf8'");
    if($tables == '*')
    {
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while($row = mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }
    $return='';
    foreach($tables as $table)
    {
        $result = mysql_query('SELECT * FROM '.$table);
        $num_fields = mysql_num_fields($result);

        $return.= 'DROP TABLE '.$table.';';
        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE'.$table));
        $return.= "\n\n".$row2[1].";\n\n";

        for ($i = 0; $i < $num_fields; $i++) 
        {
            while($row = mysql_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }
    $handle = fopen($name.'-'.date("d-M-Y").'.sql','w+');
    fwrite($handle,$return);
    fclose($handle);
}
//-----------------------------------------------------------------------
class FlxZipArchive extends ZipArchive 
{

    public function addDir1($location, $name, $includeCurrDir) 
	{
      if($includeCurrDir)
        $this->addEmptyDir($name);     
        $this->addDirDo1($location, $name, $includeCurrDir);
    }

    private function addDirDo1($location, $name, $includeCurrDir) 
	{
		if($includeCurrDir)
		{
			$name .= '/';
		}
		else
		{
			$name = '';
		}
		$location .= '/';
		$dir = opendir ($location);
		while ($file = readdir($dir))
		{
			if ($file == '.' || $file == '..') 
			{
				continue;
			}
			if(strpos($file,'.zip') == false)
			{
				$do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
				$this->$do($location . $file, $name . $file);
			}
		}
    }

    public function addDir($location, $name) 
	{
        $this->addEmptyDir($name);     
        $this->addDirDo($location, $name);
    }

    private function addDirDo($location, $name) 
	{
        $name .= '/';
        $location .= '/';
        $dir = opendir ($location);
        while ($file = readdir($dir))
        {
            if ($file == '.' || $file == '..') continue;
            $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
    }
}

function zipIt($source, $target, $includeCurrDir)
{
  $za = new FlxZipArchive;

  $res = $za->open($target, ZipArchive::CREATE);

  if($res === TRUE) {
      $za->addDir1($source, basename($source),$includeCurrDir);
      $za->close();
  }
  else
      echo 'Could not create a zip archive';

}
//============================================================================
?>
<?php 
if (isset($_POST['action']) && $_POST['action']=='Database Backup' )
{ 
	$link = mysql_connect($dbhost, $dbuser, $dbpass);
	if (!$link) 
	{
		$error = "<p>Could not connect to the server <b>'" . $dbhost . "'</b></p>\n";
		$error.= mysql_error();
	}
	if($dbname) 
	{
		$dbcheck = mysql_select_db($dbname);
		if (!$dbcheck)
		{
		$error = mysql_error();
		}
		else
		{
			backup_tables($dbhost,$dbuser,$dbpass,$dbname);
			$success = "<p>Batabase backup (.sql) created successfully.</p>\n";
		}
	}
}
//=======================================================================
if (isset($_POST['action']) && $_POST['action']=='Site Backup' )
{ 

	zipIt($current_folder,$zip_file_name,false);
	$success = "<p>Site backup (.zip) created successfully.</p>\n";
}
//=======================================================================
if (isset($_GET['unzip']) && $_GET['unzip']!='')
{ 
	$zip = new ZipArchive;
	$res = $zip->open($_GET['unzip']);
	if ($res === TRUE) 
	{
	  	$zip->extractTo($current_folder);
	  	$zip->close();
	  	$success = "<p>Zip file extracted successfully.</p>\n";
	} 
	else 
	{
	  	$error = "<p>Zip file could not extracted.</p>\n";
	}
}
//=======================================================================
session_start();
if (isset($_GET['logout']) && $_GET['logout']=='yes')
{ 
	$_SESSION["Login"] = false;
	echo '<script>window.location="backup.php"</script>';
}
//============================================================================

if (isset($_POST['LoginSubmit']) && $_POST['LoginSubmit']=='Login' )
{   
	if (isset($_POST['LoginId']) 
	   &&  md5($_POST['LoginId'])=='21232f297a57a5a743894a0e4a801fc3'
	   && isset($_POST['LoginPassword']) 
	   &&  md5($_POST['LoginPassword']) == '21232f297a57a5a743894a0e4a801fc3' ) 
	{
		
		$_SESSION["Login"] = true;
	}
	else
	{
		$loginerror = "<p>Invalid Credential Provided.</p>";
		$_SESSION["Login"] = false;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Site & Database Backup Script</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>
.modal-backdrop.in {
  opacity: 1;
  background-color:#FFF;
}
.glyphicon-refresh-animate {
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
}
@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}
@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
</style>
</head>
<body>
<div class="container">
  <h3 class="text-info">Backup and Restore Script
  <a class="pull-right btn btn-danger" href="backup.php?logout=yes">Logout </a>
  </h3>
  
  <br>
  <div class="row">
  <?php if(!empty($error)): ?>
  <div class="alert alert-danger" role="alert">
      <?=$error?>
  </div>
  <?php endif;?>
  <?php if(!empty($success)): ?>
  <div class="alert alert-success" role="alert">
      <?=$success?>
  </div>
  <?php endif;?>
  </div>
  <div class="row">
      <div class="col-md-4">
          <form role="form" id="db_bkp"
          action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
           method="post">
            <div class="form-group">
              <label for="email">Server Host</label>
              <input type="text" class="form-control" 
              required name="HostName" value="localhost">
            </div>
            <div class="form-group">
              <label for="email">User Name</label>
              <input type="text" class="form-control" value="root"
              required name="UserName">
            </div>
            <div class="form-group">
              <label for="email">Password</label>
              <input type="password" class="form-control" 
              name="Password">
            </div>
            <div class="form-group">
              <label for="email">Database Name</label>
              <input type="text" class="form-control" 
              required name="DatabaseName">
            </div>
			<input type="hidden" name="action" value="Database Backup" >
            <button type="submit" class="db-btn-bkp btn btn-default">
            Create Database Backup
            </button>
          </form>
      </div>
       <div class="col-md-1"></div>
      <div class="col-md-7">
          <form role="form" id="site_bkp"
              action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
               method="post">
                <input type="hidden" name="action" value="Site Backup" >
                <button type="submit" class="site-btn-bkp btn btn-default">
                Create Site Backup
                </button>
         </form>
         <br>
    	 <table class="table table-bordered">
          <thead>
            <tr>
              <th>Backup File</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
		  if (file_exists($current_folder)) 
		  {
		  	$list = scandir($current_folder);
			unset($list[0]);
			unset($list[1]);
		  }
		  if(count($list)>0):
			  foreach($list as $key=>$file):?>
              <?php if (strpos($file,'.zip') !== false || strpos($file,'.sql') !== false): ?>
                   <tr>
                        <td><?=$file?></td>
                        <td>
                            <a href="<?=$file?>" 
                            class="btn-link">Download</a>
                            <?php if (strpos($file,'.zip') !== false): ?>
                            &nbsp;|&nbsp;
                            <a href="backup.php?unzip=<?=$file?>" 
                            onClick="return confirm('Are you sure to extract here ?')"
                            class="btn-link">Extract Here</a>
                            <?php endif; ?>
                        </td>
                    </tr>
             <?php endif; ?>
          <?php
			  endforeach;
		  else :
		  ?>
                <tr>
                    <td colspan="3" class="text-danger">
                    <strong>No Backup Created Yet</strong>
                    </td>
                </tr>
          <?php
		  endif;
		  ?>
          </tbody>
        </table>
      </div>
  </div>
</div>
<a class="model-btn" data-toggle="modal" data-target=".bs-example-modal-static"></a>
<div class="modal fade bs-example-modal-static" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title text-center">Authentication</h4>
                  </div>
                  <div class="modal-body">
                      <?php if(!empty($loginerror)): ?>
                      <div class="alert alert-danger" role="alert">
                          <?=$loginerror?>
                      </div>
                      <?php endif;?>
                      <div class="row" style="margin-bottom:20px;">
                      	  <div class="col-md-3"></div>
                          <div class="col-md-6">
                              <form role="form" 
                              action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
                              method="post">
                                <div class="form-group">
                                  <label for="email">Login Id</label>
                                  <input type="text" class="form-control" 
                                  required name="LoginId">
                                </div>
                                <div class="form-group">
                                  <label for="email">Password</label>
                                  <input type="password" class="form-control" 
                                  name="LoginPassword" required>
                                </div>
                                <input type="submit" class="btn btn-primary" 
                                value="Login" name="LoginSubmit">
                              </form>
                          </div>
                  </div>
              </div>
            </div>
        </div>
</body>
<script>
$('form#db_bkp').submit(function(){
	var res = confirm('Are you sure to take a database backup ?');
	if(res)
	{
		var txt = '<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate">';
          txt+='</span> Loading...';
		$('.db-btn-bkp').removeClass('btn-primary').addClass('btn-warning');
		$('.db-btn-bkp').html(txt);
		
	}
	else
	{
		return false;
	}
});
//-----------------------------------------------------------------------
$('form#site_bkp').submit(function(){
	var res = confirm('Are you sure to take a site backup ?');
	if(res)
	{
		var txt = '<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate">';
          txt+='</span> Loading...';
		$('.site-btn-bkp').removeClass('btn-primary').addClass('btn-warning');
		$('.site-btn-bkp').html(txt);
		
	}
	else
	{
		return false;
	}
});
<?php if($_SESSION["Login"]!=true): ?>
	$('a.model-btn').click();
<?php endif;?>
</script>
</html>