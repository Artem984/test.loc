<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="<?=$arResult[0]["LINK"]?>"><?=$arResult[0]["TEXT"]?></a>
	  <? unset($arResult[0]); ?>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">

		<ul class="navbar-nav ml-auto my-2 my-lg-0">
			<?foreach($arResult as $arItem):?>
				<?if ($arItem["PERMISSION"] > "D"):?>
					<li class="nav-item">
						<?if ($arItem["PERMISSION"] > "D"):?>
							<a class="nav-link js-scroll-trigger" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a> <!-- перемещение по клику к блоку About Section -->
						<?endif?>
					</li>
				<?endif?>
			<?endforeach?>
		</ul>
		
      </div>
    </div>
 </nav>
<?endif?>
