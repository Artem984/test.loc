<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();

// if(in_array(1,$arGroups)||in_array(7,$arGroups)||in_array(8,$arGroups)){

  global $USER;
  CModule::IncludeModule("iblock");
  $arGroups = $USER->GetUserGroupArray();
  $el = new CIBlockElement;

  debug($_GET);

  if($_GET['type']==='delete'){



  }elseif($_GET['type']==='add'){

    $PROP["NAME"]              =$_GET["NAME"];
    $PROP["PREVIEW_TEXT"]      =$_GET["PREVIEW_TEXT"];
    $PROP["PREVIEW_PICTURE"]   =$_GET["PREVIEW_PICTURE"];
    $PROP["IBLOCK_NAME"]       =$_GET["IBLOCK_NAME"];
    $PROP["ACTIVE_FROM"]       =date("Y-m-d-H:i:s");
    
  
    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
      "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
      "IBLOCK_ID"      => $_GET['id'],
      "PROPERTY_VALUES"=> $PROP,
      "NAME"           => " Заголовок новости: ".$_GET["TITLE"] ,
      "ACTIVE"         => "Y",            // активен
      );
  
  
    if(!empty($_GET["TITLE"])){  // записываем в базу данных
        $ELEM = $el->Add($arLoadProductArray); 
        echo $ELEM;
    }
  }

 
  $this->IncludeComponentTemplate(); //подключаем шаблон

// }else{
//   $this->IncludeComponentTemplate();
// }?>