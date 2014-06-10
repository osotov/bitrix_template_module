<?php
namespace variable_namespase\EventHandlers;

class EpilogHandler {
	public static function set404Status ()
	{
		if(
			! defined('ADMIN_SECTION') &&
			defined('ERROR_404') &&
			file_exists($_SERVER['DOCUMENT_ROOT'] . '/404.php')
		) {

			global $APPLICATION;
			$APPLICATION->RestartBuffer();
			//TODO подключить header и footer корректно
			//include($_SERVER['DOCUMENT_ROOT'].'/local/templates/404/header.php');
			include($_SERVER['DOCUMENT_ROOT'].'/404.php');
			//include($_SERVER['DOCUMENT_ROOT'].'/local/templates/404/footer.php');
		}
	}
} 