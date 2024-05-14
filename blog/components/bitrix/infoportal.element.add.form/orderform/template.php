<?

use Bitrix\Calendar\Core\Base\Property;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<?
//echo "<pre>Template arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
//exit();
?>
<?
	$propertyName = 0;
	$propertyPrice = 1;
	$propertyImage = 2;
	$propertyDescription = 3; 
?>

<?if (!empty($arResult["ERRORS"])):?>
	<?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif?>
<?if ($arResult["MESSAGE"] <> ''):?>
	<?=ShowNote($arResult["MESSAGE"])?>
<?endif?>

<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data"> 
<?=bitrix_sessid_post()?>
<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=GetMessage("IBLOCK_FORM_NAME")?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
      <div class="form-group mb-2">
    <label for="formGroupExampleInput">Название товара</label>
    <input type="text" class="form-control" name="PROPERTY[NAME][0]" id="formGroupExampleInput" required placeholder=<?=GetMessage("IBLOCK_FORM_FIELD_NAME")?> >
  </div>
  <div class="form-group mb-2">
    <label for="formGroupExampleInput2">Цена товара</label>
    <input type="number" class="form-control" name="PROPERTY[<?=$propertyPrice?>][0]" id="formGroupExampleInput2" placeholder=<?=GetMessage("IBLOCK_FORM_FIEL_PRICE")?>>
  </div>
    <div class="form-group mb-2">
    <label for="formGroupExampleInput2">Описание товара</label>
    <input type="text" class="form-control"  name="PROPERTY[<?=$propertyDescription?>][0]" id="formGroupExampleInput2" placeholder=<?=GetMessage("IBLOCK_FORM_FIED_DESCRIPTION")?>>
  </div>
  <div class="form-group mb-2">
  <label class="custom-file-label" for="customFile">Загрузить изображение</label> <br>
  </div>
  <div class="form-group mb-2">
  <input type="hidden" name="PROPERTY[<?=$propertyImage?>][0]" value="<?=$value?>" >
  <input type="file" class="custom-file-input" id="customFile" name="PROPERTY_FILE_<?=$propertyImage?>_0">
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <input type="submit" name="iblock_submit" class="btn btn-primary" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>">
      </div>
</div>
</form>
