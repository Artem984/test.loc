<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<? $APPLICATION->SetTitle("Детальная новость"); ?>

<?$APPLICATION->IncludeComponent(
	"starkiller:componentNewsDetal",
     "",
    array(
        "NEWS_ID"=> $_GET['id'],
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>