
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>
<script>
document.querySelectorAll('.btn-close').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      fetch('/bitrix/delete_element.php', {
        method: 'POST',
        body: JSON.stringify({ id: id }),
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(response => {
        if (response.ok) {
          // Обновление страницы или списка элементов
          location.reload();
        } else {
          console.error('Ошибка удаления элемента');
        }
      });
    });
  });
 </script>

<div class="container px-4 px-lg-5 my-5">
	<div class="row gx-4 gx-lg-5 align-items-center">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"",
	Array(
		"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "orders",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array("ID",""),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE"
	)
);?>
</div>

 <?
 /* 
 $arFilter = Array("IBLOCK_ID"=>3, "IBLOCK_TYPE" => "orders", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"); 
 $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DESCRIPTION_PRODUCT", "IMAGE_PRODUCT");          
 $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
 while($ob = $res->GetNextElement()){
	$arFields = $ob->GetFields(); 
	$arProps = $ob->GetProperties();   
    $detailPicture = CFile::GetPath($arProps['IMAGE_PRODUCT']); 
	//echo "<img src='$detailPicture' alt='{$arFields['NAME']}'>";                                                 
	?>
		 <pre>			
		 <? print_r($arFields['NAME']); ?>
		 <? print_r($arProps['PRICE_PRODUCT']['VALUE']); ?>
		 <? print_r($arProps['DESCRIPTION_PRODUCT']['VALUE'])?>
		 </pre>
		 
<? }
*/
?>

<? /* Обновление
	\Bitrix\Main\Loader::includeModule('iblock');
	$iblockId = 3;
	$iblock = \Bitrix\Iblock\Iblock::wakeUp($iblockId);
	$elements = $iblock->getEntityDataClass()::update($idUpdate, array(
		
	));
	foreach ($elements as $element){

	}
	*/
?>

<?/*
\Bitrix\Main\Loader::includeModule('iblock');
$iblockId = 3;

$iblock = \Bitrix\Iblock\Iblock::wakeUp($iblockId);
$elements = $iblock->getEntityDataClass()::getList([
	'select' => ['ID', 'NAME','DESCRIPTION_PRODUCT', 'IMAGE_PRODUCT', 'PRICE_PRODUCT']
])->fetchCollection();
	

foreach ($elements as $element)
{
	echo $element->getID()." ";
	echo $element->getName()."  ";
	echo $element->getDescriptionProduct()->getValue()."  ";
	echo $element->getPriceProduct()->getValue().'<br>';
	if($element->getID()==24){
		echo "Rovno 24";
		$element->delete($element->getID());
	}

}
//Удаление

if (!$element) echo "Элемент не найден";
*/
?>
<?


?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название товара</th>
      <th scope="col">Описание</th>
      <th scope="col">Цена</th>
	  <th scope="col">Удаление</th>
	  <th scope="col">Изменить</th>

    </tr>
  </thead>
  <tbody>
	<?
	use Bitrix\Main\Loader;
	use Bitrix\Main\Entity;
	
	Loader::includeModule('iblock');
	
	$iblockId = 3;
	$pageSize = 5; // Количество элементов на странице
	 // Получаем номер текущей страницы
	
	$iblock = \Bitrix\Iblock\Iblock::wakeUp($iblockId);
	$entityDataClass = $iblock->getEntityDataClass();
	
	$count = $entityDataClass::getList([
		'select' => [new Entity\ExpressionField('CNT', 'COUNT(*)')]
	])->fetch();
	
	$totalItemsCount = $count['CNT'];
	
	$nav = new \Bitrix\Main\UI\PageNavigation("nav");
	$nav->allowAllRecords(false)
		->setPageSize($pageSize)
		->initFromUri();
	
	$nav->setRecordCount($totalItemsCount);

	
	$elements = $entityDataClass::getList([
		'select' => ['ID', 'NAME','DESCRIPTION_PRODUCT', 'IMAGE_PRODUCT', 'PRICE_PRODUCT'],
		'offset' => $nav->getOffset(),
		'limit' => $nav->getLimit()
		
	])->fetchCollection();
	foreach ($elements as $element)
	{
		
		?>
		 <tr>
		 <form>
	<th scope="row"><?echo $element->getID()?></th>
	<td><?echo $element->getName();?></td>
	<td><?echo $element->getDescriptionProduct()->getValue();?></td>
	<td><?echo $element->getPriceProduct()->getValue();?></td>
	<td><a  href="/local/templates/blog/delete_element.php?id=<?php echo $element->getID();?>">
			<button class="btn-close" type="button" id="" ></button>
		 </a>
	</td> <?/* УДАЛЕНИЕ */?>
	<td> 
	<a  href="/local/templates/blog/update_element.php?id=<?php echo $element->getID();?>&name=<?php echo $element->getName();?>&description_product=<?php echo $element->getDescriptionProduct()->getValue();?>&price_product=<?php echo $element->getPriceProduct()->getValue();?>">
			<button class="btn btn-primary" type="button">Изменить</button>
			</a>
	</td>
	<form>
</tr>
	<?
} 
$APPLICATION->IncludeComponent(
    "bitrix:main.pagenavigation",
    "",
    array(
        "NAV_OBJECT" => $nav,
        "SEF_MODE" => "N",
    ),
    false
);
//Удаление
if (!$element) echo "Элемент не найден";
?>
    <tr>
    </tr>
  </tbody>
</table>




<div class="modal" id="exampleModal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Изменить товар</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  	<div class="form-group mb-2">
    		<label for="formGroupExampleInput">Название товара <?echo $NameUpdate?></label>
    		<input type="text" class="form-control"  id="formGroupExampleInput" name="<?echo $NameUpdate?>" >
  		</div>
		  <div class="form-group mb-2">
    		<label for="formGroupExampleInput">Описание</label>
    		<input type="text" class="form-control"  id="formGroupExampleInput" >
  		</div>
		  <div class="form-group mb-2">
    		<label for="formGroupExampleInput">Цена</label>
    		<input type="number" class="form-control"  id="formGroupExampleInput" >
  		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Сохранить изменение</button>
      </div>
    </div>
  </div>
</div>		




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

<?
/*
$element = \Bitrix\Iblock\ElementTable::getList([
    'filter' => ['=ID' => $elementId, '=IBLOCK_ID' => $iblockId],
    'select' => ['ID', 'NAME', 'PROPERTY_*']
])->fetch();

if ($element) {
    var_dump($element);
} else {
    echo "Элемент не найден";
}
'DESCRIPTION_PRODUCT', 'IMAGE_PRODUCT', 'PRICE_PRODUCT'
*/

//Вывод
?>



