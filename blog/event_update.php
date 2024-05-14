<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

echo "ДО сюда";
$name1 = $_POST['name'];
echo $name1;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $price = $_POST['price_product'];
    $description = $_POST['description_product'];
    echo $name;
    $iblockId = 3; // ID вашего инфоблока
    $elementId = $id; // ID элемента инфоблока, который нужно обновить

    $arFields = Array(
        "NAME" => $name,
        "PROPERTY_VALUES" => array(
            "PRICE" => $price,
            "DESCRIPTION" => $description
        )
    );

    $res = CIBlockElement::GetByID($elementId);
    if($ar_res = $res->GetNext()) {
        $iblockElement = new CIBlockElement;
        $iblockElement->Update($elementId, $arFields);
        echo "Свойства элемента инфоблока успешно обновлены";
    } else {
        echo "Элемент инфоблока не найден";
    }
}




require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>

