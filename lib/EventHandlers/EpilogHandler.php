<?php

namespace Osotov\CustomProjectModule\EventHandlers;

/**
 * Обработчик событий эпилога
 *
 * Class EpilogHandler
 * @package Osotov\CustomProjectModule\EventHandlers
 */
class EpilogHandler
{
    /**
     * Правильный способ показать 404 страницу, без использования редиректов
     */
    public static function set404Status()
    {
        if (! defined('ADMIN_SECTION') && defined('ERROR_404') && file_exists($_SERVER['DOCUMENT_ROOT'] . '/404.php')) {
            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            include($_SERVER['DOCUMENT_ROOT'] . '/404.php');
        }
    }
}
