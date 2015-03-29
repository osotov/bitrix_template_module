<?php
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (! check_bitrix_sessid()) {
    return;
}

global $errors, $APPLICATION;

if ($errors === false) {
	echo \CAdminMessage::ShowNote(GetMessage('UNINSTALL_COMPLETED'));
} else {
    for ($i = 0; $i < count($errors); $i++) {
        $alErrors .= $errors[$i] . '<br>';
    }
    echo \CAdminMessage::ShowMessage(array(
        'TYPE' => 'ERROR',
        'MESSAGE' => Loc::getMessage('MOD_UNINST_ERR'),
        'DETAILS' => $alErrors,
        'HTML' => true
    ));
}
?>

<form action='<?= $APPLICATION->GetCurPage() ?>'>
	<input type='hidden' name='lang' value='<?= LANG ?>'/>
	<input type='submit' name='' value='<?= Loc::getMessage('MOD_BACK') ?>'/>
</form>