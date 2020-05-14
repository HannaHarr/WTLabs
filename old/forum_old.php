<?php
	require_once('include/template_engine.php');
	require_once('include/data.php');
	$arrayData = array(
		'0' => array(
						'name' => 'Породные команды',
						'description' => 'Здесь общаются люди, которые объединили свой опыт и любовь к определенной породе, что бы помочь животным.',
					),
		'1' => array(
						'name' => 'Команды помощи',
						'description' => 'Команды созданы группой людей для оказания целенаправленной помощи животным. Деятельность не является работой, каждый помогает в силу возможностей и свободного времени.',
					),
		'2' => array(
						'name' => 'Закон и права животных',
						'description' => 'А имеют ли животные какие-то права в Республике Беларусь? Защищает ли их закон от жестокого обращения? Давайте пообщаемся на эту тему...',
					),
		'3' => array(
						'name' => 'Я стал очевидцем жестокого обращения с животным',
						'description' => 'Если Вы стали очевидцем жестокого обращения с животными, обязательно заведите новую тему. По возможности оставляйте свою контактную информацию.',
					)
	);
	
	$string = getFile('templates/main_template.html');
	$string = getPage($string, $arrayTemplates, $arrayContents['forum'], $__ARRAYTEMPLATES);
	$string = getAnnouncement($string, 'tema', $arrayAnnouncement, $arrayData);
	echo $string;
	
?>