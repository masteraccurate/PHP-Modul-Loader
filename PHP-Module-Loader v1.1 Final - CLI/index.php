<?php
// PHP-Module-Loader Version 1.0 beta; Copyright (c) by MasterAccurate(R), Germany, EU

// Set default id
$std_id = "home";

if(isset($argv['1']) && $argv['1'] != "NULL" && $argv['1'] != "") {
	$id = $argv['1'];
} else {
	$id = $std_id;
}

$dir_var = dirname(__FILE__);
$idir = $dir_var."/includes/";
$odir = @opendir($idir);
while($file = readdir($odir)) {
	if($file != "." && $file != ".."){
		include $idir.$file;
	}
}
closedir($odir);

if($id != "") {
	$dir = $dir_var."/modules/";
	$module = $dir.$id.".module.php";
	if(file_exists($module)) {
		include $module;
		$var_id = new $id();
		echo $var_id->main();
	} else {
		print "ERROR: Module ".$module." does not exist!\n";
		exit;
	}
} else {
	print "ERROR: fault \$id\n";
	exit;
}

?>