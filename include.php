<?php
// Автозагрузка классов и регистрация обработчиков событий
\Bitrix\Main\Loader::registerAutoLoadClasses('variable_module_id', array(

));

// Регистрация обработчиков событий
$eventManager = \Bitrix\Main\EventManager::getInstance();
