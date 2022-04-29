<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); //Защита от подключения файла напрямую без подключения ядра
use Bitrix\Main\Page\Asset; //Подключение библиотеки для использования  Asset::getInstance()->addCss() 
global $USER;
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  	<title><? $APPLICATION->ShowTitle(); ?></title> <!-- Отображение заголовка страницы -->
    <? 
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/vendor/jquery/jquery.min.js"); 
$APPLICATION->ShowHead(); 
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/vendor/fontawesome-free/css/all.min.css"); 
    Asset::getInstance()->addCss("https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700&selection.subset=cyrillic"); 
    Asset::getInstance()->addCss("https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i&display=swap&subset=cyrillic");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/vendor/magnific-popup/magnific-popup.css"); 
?>

</head>

<body id="page-top">

<div id="panel">
    <? $APPLICATION->ShowPanel(); ?> <!-- Отображение панели администратора -->
</div>

  <!-- Navigation -->
 <?$APPLICATION->IncludeComponent("starkiller:menu","blue_tabs",Array(
        "ROOT_MENU_TYPE" => "top", 
        "MAX_LEVEL" => "1", 
        "CHILD_MENU_TYPE" => "top", 
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "Y",
        "MENU_CACHE_TYPE" => "N", 
        "MENU_CACHE_TIME" => "3600", 
        "MENU_CACHE_USE_GROUPS" => "Y", 
        "MENU_CACHE_GET_VARS" => "" 
    )
);?>

  <!-- Masthead -->
 <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Рыбный совхоз "Корпач"</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-5">Одно из лучших мест для рыбалки</p>
          <a class="btn btn-primary btn-xl js-scroll-trigger" href="#home">Узнать больше</a><!-- Перемещение по клику к блоку УЗНАТЬ БОЛЬШЕ -->
        </div>
      </div>
    </div>
  </header>
