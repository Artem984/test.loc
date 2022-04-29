<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true){die();}?>

<div class="container">
    <h1><?= $arResult["IBLOCK_NAME"]?></h1>
    <div style="display:flex;">
        <div>
            <img src="<?= $arResult["IMG"]?>" alt="">
        </div>
        <div style="margin-left: 20px;">
            <h2><?= $arResult["NAME"]?></h2>
            <h6><?= $arResult["DATE_CREATE"]?></h6>
            <p><?= $arResult["PODROBNOSTI"]?></p>
            <a href="/">На главную</a>
        </div>
    </div>
</div>