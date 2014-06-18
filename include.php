<?php
// Автозагрузка классов и регистрация обработчиков событий
\Bitrix\Main\Loader::registerAutoLoadClasses('CustomProjectModule', array(

));

// Регистрация обработчиков событий
$eventManager = \Bitrix\Main\EventManager::getInstance();
