<?php
// Автозагрузка классов и регистрация обработчиков событий
\Bitrix\Main\Loader::registerAutoLoadClasses(
    'customprojectmodule',
    array(
        'Osotov\\CustomProjectModule\\Config\\Config' => 'lib/Config/Config.php',
        'Osotov\\CustomProjectModule\\EventHandlers\\EpilogHandler' => 'lib/EventHandlers/EpilogHandler.php',
    )
);

// Регистрация обработчиков событий
$eventManager = \Bitrix\Main\EventManager::getInstance();

// Событие для корректной устновки 404 страницы, это пример регистрации обработчика
// Удалить если не требуется
$res = $eventManager->addEventHandler(
    'main',
    'OnEpilog',
    array('Osotov\\CustomProjectModule\\EventHandlers\\EpilogHandler', 'set404Status')
);
