<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Data\Cache;
$arGroups = $USER->GetUserGroupArray();
CModule::IncludeModule("iblock");

 
$cache = Cache::createInstance(); // Служба кеширования
 
$cachePath = 'componentNews'; // папка, в которой лежит кеш
$cacheTtl = 3600; // срок годности кеша (в секундах)
$cacheKey = 'mycachekey'; // имя кеша
 
if ($cache->initCache($cacheTtl, $cacheKey, $cachePath))
{
    $arResult = $cache->getVars(); // Получаем переменные
    $cache->output(); // Выводим HTML пользователю в браузер
}
elseif ($cache->startDataCache())
{

  $arSort=Array();
  $arSelect = Array("ID","NAME","PREVIEW_TEXT","PREVIEW_PICTURE","IBLOCK_NAME","ACTIVE_FROM","DATE_CREATE");
  $arFilter = Array("IBLOCK_ID"=>$arParams["IB"], "ACTIVE"=>"Y");
  $arPaginator = Array("nPageSize"=>50);

  $res = CIBlockElement::GetList($arSort, $arFilter, false, $arPaginator , $arSelect);


  for( $i=0; $ob = $res->GetNextElement(); $i++) 
    {
      $arFields =$ob->GetFields();

      $arResult[$i]["ID"]=$arFields["ID"];
      $arResult[$i]["NAME"]=$arFields["NAME"];
      $arResult[$i]["PREVIEW_TEXT"]=$arFields["PREVIEW_TEXT"];
      $arResult[$i]["PREVIEW_PICTURE"]= CFile::GetPath($arFields["PREVIEW_PICTURE"]);
      $arResult[$i]["IBLOCK_NAME"]= $arFields["IBLOCK_NAME"];
      $arResult[$i]["ACTIVE_FROM"]= $arFields["DATE_CREATE"];
    }
    $this->IncludeComponentTemplate();
    
    // записываем кеш
    $cache->endDataCache($arResult);
}


if(in_array(1,$arGroups)||in_array(7,$arGroups)||in_array(8,$arGroups)){ 

  //--- Start Добавление новости ---//
  $el = new CIBlockElement;
  
    echo '<form style="border:2px solid black;" method="post" enctype="multipart/form-data">
        <p><input name="NAME" type="text"> Заголовок новости</p>
        <p><input name="PREVIEW_TEXT" type="text"> Текст новости</p>
        Выберите файл: <input type="file" name="DETAIL_PICTURE" size="10" /><br /><br />
        <input type="submit" value="Создать" />
        <input type="submit" value="Обновить" />
    </form>';
  
    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
      "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
      "IBLOCK_ID"      => $arParams["IB"],
      "PROPERTY_VALUES"=> $PROP,
      "NAME"           => $_POST["NAME"],
      "ACTIVE"         => "Y",            // активен
      "PREVIEW_TEXT"   => $_POST["PREVIEW_TEXT"],
      "DETAIL_TEXT"    => $_POST["PREVIEW_TEXT"],
      "PREVIEW_PICTURE" => $_FILES['DETAIL_PICTURE']
    );
    
    if(!empty($_POST["NAME"])){  // записываем в базу данных
      $ELEM = $el->Add($arLoadProductArray); 
      $cache->cleanDir($cachePath); // очищаем кеш
    } 
    //--- End Добавление новости ---//

  //--- Start Получаем инфоблок ---//
  $res = CIBlock::GetList( Array(), Array("TYPE" => "content"));

  while($ar_res = $res->Fetch()){
    echo "ID инфоблока: ".$ar_res["ID"].' '.$ar_res['NAME'].' ';
    // ссылка на удаление инфоблока
    echo '<a href="\local\components\starkiller\componentNewsDetal\deleteInfoBlock.php?id='.$ar_res["ID"].'">Удалить инфоблок</a>'."<br>";
  }

  echo '<form method="post" enctype="multipart/form-data">
        <p><input name="NAMEINFOBLOCK" type="text"> Имя инфоблока</p>
        <p><input name="CODEINFOBLOCK" type="text"> Код инфоблока</p><br/>
        <input type="submit" value="Создать" />
        <input type="submit" value="Обновить" />
    </form>';
    
    $nameInfoBlock = $_POST["NAMEINFOBLOCK"];
    $codeInfoBlock = $_POST["CODEINFOBLOCK"];
    
    $ib = new CIBlock;
    $arFields = Array(
      "ACTIVE" => 'Y',
      "NAME" => $nameInfoBlock,
      "CODE" => $codeInfoBlock,
      "LIST_PAGE_URL" => '#SITE_DIR#/catalog/list.php?SECTION_ID=#SECTION_ID#',
      "DETAIL_PAGE_URL" => '#SITE_DIR#/catalog/detail.php?ID=#ELEMENT_ID#',
      "IBLOCK_TYPE_ID" => 'content',
      "SITE_ID" => Array("23","s1"),
      "SORT" => 500,
      "PICTURE" => '',
      "DESCRIPTION" => '',
      "DESCRIPTION_TYPE" => '',
      "GROUP_ID" => Array("2"=>"D", "3"=>"R"),
    );
    
    if((!empty($nameInfoBlock)) and (!empty($codeInfoBlock))){
      $res = $ib->Add($arFields);
    }
    //--- End Получаем инфоблок ---//

    //--- Start Изменение названия инфолока ---//
    echo '<form method="post" enctype="multipart/form-data">
          <p><input name="ID_INFO_BLOCKS" type="text"> ID инфоблока</p>
          <p><input name="RENAME_INFO_BLOCK" type="text"> Имя инфоблока</p><br/>
          <input type="submit" value="Переименовать" />
          <input type="submit" value="Обновить" />
      </form>';

      $arFields = Array(
        "NAME" => $_POST['RENAME_INFO_BLOCK'],
      );
      
      if((!empty($_POST['ID_INFO_BLOCKS'])) and (!empty($_POST['RENAME_INFO_BLOCK']))){
        $res = $ib->Update($_POST['ID_INFO_BLOCKS'],$arFields);
      }
    //--- End Изменение названия инфолока ---//
}
?>