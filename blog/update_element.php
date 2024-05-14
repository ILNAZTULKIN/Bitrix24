<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<a href="javascript:history.back()" class="btn btn-primary">Назад</a>
</br>

<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && CModule::IncludeModule('iblock')) {   
    $id = intval($_GET['id']);
    $name =($_GET['name']);
    $price =($_GET['price_product']);
    $description =($_GET['description_product']);
?>
<form id="productForm" action="" class="myform" method="post">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingName" value="<?php echo $name ?>">
        <label for="floatingInput">Название товара</label>
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" id="floatingDescription" value="<?php echo $description ?>">
        <label for="floatingPassword">Описание</label>
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" id="floatingPrice" value="<?php echo $price ?>">
        <label for="floatingPassword">Цена</label>
    </div>
     <button class="btn btn-primary" type="button" id=submitForm >Изменить</button>
     
</form>
    

<?
 }
 ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#submitForm').click(function(e) {
        var formData = $('#productForm').serialize(); // Получаем данные формы в виде строки
        $.ajax({
            type: 'POST',
            url: 'http://bitrix.test/local/templates/blog/event_update.php', // Укажите путь к файлу, который будет обрабатывать данные
            data: formData,
            success: function(response) {
                // Обработка успешного ответа от сервера
                console.log('Успешный ответ от сервера:', response);
                сonsole.log(formData);
            },
            error: function(xhr, status, error) {
                // Обработка ошибки
                console.error('Проебался как обычно', error);
            }
        });
    });
});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>