
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<a href="javascript:history.back()" class="btn btn-primary">Назад</a>
</br>

<?



if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && CModule::IncludeModule('iblock')) {
    $id = intval($_GET['id']);
    CIBlockElement::Delete($id);
    echo "Элемент успешно удален";
} else {
    echo "Ошибка: Неверный запрос или отсутствует ID элемента";
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");


?>
