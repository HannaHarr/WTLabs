<?php

	function getTemplate($string) {
		return "{*" . $string . "*}";
	}
	
	function expandArray($arrayData, $templatefileName) {
		$string = "";
		foreach($arrayData as $array) {
			$template = file_get_contents($templatefileName);
			foreach($array as $key => $element) {
				$template = str_replace(getTemplate($key), $element, $template);
			}
			$string = $string.$template;
		}
		return $string;
	}
	
	function getPage($arrayTemplates, $string) {
		foreach($arrayTemplates as $key => $element) {
			$string = str_replace(getTemplate($key), $element, $string);
		}
		return $string;
	}
