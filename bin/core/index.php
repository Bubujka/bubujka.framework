<?php
$layout = bu::layout('bubujka_basic');
$layout->setTitle(bu::lang('framework/name').' смотрит на тебя =_+!');
$layout->setContent(bu::view('index_content'));
$layout->generate();
?>
