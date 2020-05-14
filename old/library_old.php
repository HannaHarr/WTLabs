<?php
	require_once('include/template_engine.php');
	require_once('include/data.php');

	$string = getFile('templates/main_template.html');
	$string = getPage($string, $arrayTemplates, $arrayContents['library'], $__ARRAYTEMPLATES);
	echo $string;
	
?>