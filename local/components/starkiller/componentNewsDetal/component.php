<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $USER;
use \Bitrix\Main\Data\Cache;
CModule::IncludeModule("iblock");

$arGroups = $USER->GetUserGroupArray();

$cache = Cache::createInstance(); // Служба кеширования
$cachePath = 'componentNewsDetal'; // папка, в которой лежит кеш
$cacheTtl = 3600; // срок годности кеша (в секундах)
$cacheKey = 'componentNewsDetal'; // имя кеша

if ($cache->initCache($cacheTtl, $cacheKey, $cachePath))
{
    $arResult = $cache->getVars(); // Получаем переменные
    $cache->output(); // Выводим HTML пользователю в браузер
}
elseif ($cache->startDataCache())
{
    $res = CIBlockElement::GetByID($arParams["NEWS_ID"]);
    $arNews = $res->GetNext();

    $arResult["ID"]=$arNews["ID"];
    $arResult["NAME"]=$arNews["NAME"];
    $arResult["PODROBNOSTI"]=$arNews["PREVIEW_TEXT"];
    $arResult["IMG"]=CFile::GetPath($arNews["PREVIEW_PICTURE"]);;
    $arResult["DATE_CREATE"]=$arNews["DATE_CREATE"];
    $arResult["IBLOCK_NAME"]=$arNews["IBLOCK_NAME"];
         
    $this->IncludeComponentTemplate();
    // Всё хорошо, записываем кеш
    $cache->endDataCache($vars);
}


if(in_array(1,$arGroups)||in_array(7,$arGroups)||in_array(8,$arGroups)){ 
    $el = new CIBlockElement;

    echo '<form style="border:2px solid black;" method="post" enctype="multipart/form-data">
        <p><input name="NAME" type="text"> Заголовок новости</p>
        <p><input name="PREVIEW_TEXT" type="text"> Текст новости</p>
        Выберите файл: <input type="file" name="DETAIL_PICTURE" size="10" /><br /><br />
        <input type="submit" value="Загрузить" />
        <input type="submit" value="Обновить" />
        <a href="\local\components\starkiller\componentNewsDetal\elementDelete.php?id='.$arResult["ID"].'">Удалить новость</a>
    </form>';

    $arLoadProductArray = Array(
    "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
    "IBLOCK_SECTION" => false,          // элемент лежит в корне раздела
    "PROPERTY_VALUES"=> $PROP,
    "NAME"           => $_POST["NAME"],
    "ACTIVE"         => "Y",            // активен
    "PREVIEW_TEXT"   => $_POST["PREVIEW_TEXT"],
    "DETAIL_TEXT"    => $_POST["PREVIEW_TEXT"],
    "DETAIL_PICTURE" => $_FILES['DETAIL_PICTURE']
    );

    if(!empty($_POST["NAME"])){
        $NEWS_ID = $arParams["NEWS_ID"];  // изменяем элемент с кодом (ID)
        $res = $el->Update($NEWS_ID, $arLoadProductArray);

        $cache->cleanDir($cachePath);
    }
    
   echo '';
}?>