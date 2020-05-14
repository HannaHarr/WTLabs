<?php

	$__ARRAYTEMPLATES = array (
		'0' => 'content',
		'1' => 'header',
		'2' => 'navigation',
		'3' => 'footer' 
	);

	function getTemplate($string) {
		return "{*" . $string . "*}";
	}

	function getFile($main_template) {
		return file_get_contents($main_template);
	}

	function expandTemplate($string, $template, $fileName) {
		return str_replace($template, getFile($fileName), $string);
	}
	
	function expandArray($arrayData, $fileName) {
		$string = "";
		foreach($arrayData as $array) {
			$template = getFile($fileName);
			foreach($array as $key => $element) {
				$template = str_replace(getTemplate($key), $element, $template);
			}
			$string = $string.$template;
		}
		return $string;
	}
	
	function getAnnouncement($string, $announcement, $arrayAnnouncement, $__ARRAYDATA) {
		return str_replace(getTemplate($announcement), expandArray($__ARRAYDATA, $arrayAnnouncement[$announcement]), $string);
	}
	
	function getPage($string, $arrayTemplates, $content, $__ARRAYTEMPLATES) {
		foreach ($__ARRAYTEMPLATES as $value) {
			if ($value !== $__ARRAYTEMPLATES['0'])
				$string = expandTemplate($string, getTemplate($value), $arrayTemplates[$value]);
			else
				$string = expandTemplate($string, getTemplate($value), $content);	
		}
		return $string;
	}
	
?>