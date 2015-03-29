<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main;

/**
 * Class customprojectmodule
 */
class customprojectmodule extends \CModule
{
    /**
     * @var string
     */
    public $MODULE_ID = 'customprojectmodule';
    /**
     * @var
     */
    public $MODULE_VERSION;
    /**
     * @var
     */
    public $MODULE_VERSION_DATE;
    /**
     * @var string
     */
    public $MODULE_NAME;
    /**
     * @var string
     */
    public $MODULE_DESCRIPTION;

    /**
     * @var bool
     */
    public $errors = false;

    /**
     * Инициализация модуля
     */
    public function customprojectmodule()
    {
        Loc::loadMessages(__FILE__);
        $moduleVersion = array();
        include(realpath(__DIR__) . '/version.php');
        $this->MODULE_VERSION = $moduleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $moduleVersion['VERSION_DATE'];
        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
    }

    /**
     * Регистрация модуля в БД, установка таблиц модуля
     *
     * @return bool
     * @throws Exception
     */
    public function InstallDB()
    {
        global $errors;

        $errors = false;

        // если у модуля есть свои таблицы, сюда следует поместить создание этих таблиц

        if (!empty($errors)) {
            throw new \Exception(implode('', $errors));
        }
        \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);

        return true;
    }

    /**
     * Удалить модуль из БД, удаление таблиц модуля
     *
     * @param array $arParams
     * @return bool
     */
    public function UnInstallDB($arParams = Array())
    {
        // если у модуля есть свои таблицы, сюда следует поместить удаление этих таблиц

        COption::RemoveOption($this->MODULE_ID);
        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

        return true;
    }

    /**
     * Установка файлов административной страницы и других файлов
     *
     * @param array $arParams
     * @return bool
     */
    public function InstallFiles($arParams = array())
    {
        // если у модуля есть свои административные страницы и другие файлы,
        // сюда следует поместить установку этих страниц
        return true;
    }

    /**
     * Удаление файлов административной страницы и других файлов
     *
     * @return bool
     */
    public function UnInstallFiles()
    {
        // если у модуля есть свои административные страницы и другие файлы,
        // сюда следует поместить удаление этих страниц
        return true;
    }

    /**
     * Инициализация установки модуля
     *
     * @throws Exception
     */
    public function DoInstall()
    {
        global $USER, $APPLICATION;
        if ($USER->IsAdmin()) {
            if (! \Bitrix\Main\ModuleManager::isModuleInstalled($this->MODULE_ID)) {
                $this->InstallDB();
                $this->InstallFiles();

                $GLOBALS['errors'] = $this->errors;

                $APPLICATION->IncludeAdminFile(Loc::getMessage('INSTALL_TITLE'), realpath(__DIR__) . '/step.php');
            }
        }
    }

    /**
     * Инициализация удаления модуля
     */
    public function DoUninstall()
    {
        global $USER, $APPLICATION, $step;

        if ($USER->IsAdmin()) {
            $this->UnInstallDB(array());
            $this->UnInstallFiles();
            $GLOBALS['errors'] = $this->errors;
            $APPLICATION->IncludeAdminFile(Loc::getMessage('UNINSTALL_TITLE'), realpath(__DIR__) . '/unstep.php');
        }
    }
}
