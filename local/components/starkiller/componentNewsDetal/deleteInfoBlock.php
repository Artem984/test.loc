<?require($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');
$arGroups = $USER->GetUserGroupArray();

if(in_array(1,$arGroups)||in_array(7,$arGroups)||in_array(8,$arGroups)){ 
    CModule::IncludeModule("iblock");
    CIBlock::Delete($_GET['id']);
    LocalRedirect("index.php");
 }
?>