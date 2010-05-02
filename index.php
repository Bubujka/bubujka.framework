<?php
include('base.php');
include('boot/spyc.php'); #библиотека для парсинга конфигов
include('boot/bu_core.php'); 
include('boot/bu_cache.php'); 
include('boot/bu.php'); #магический класс который управляет всем-всем
include('boot/bu_route.php');
include('boot/bu_loader.php');
include('boot/bu_url.php');
include('boot/bu_statistic.php');
include('boot/bu_logger.php');

bu::timer('init','system');
bu::hook(array('preload','blank'));

BuLoader::setHttpString(RAW_HTTP_STRING);

bu::timer('Aplication start.','system');
BuLoader::doIt();
bu::timer('Aplication end.','system');

bu::hook(array('postload','blank'));
?>
