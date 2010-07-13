<?php
$layout = bu::layout('bubujka_basic');
$title = sf('%s %s',bu::lang('framework/name'),' смотрит на тебя =_+!');
$layout->setTitle($title);
$layout->setContent(bu::view('index_content'));
$layout->generate();
?>
