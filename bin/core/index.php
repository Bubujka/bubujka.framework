<?php
$layout = bu::layout('bubujka_basic');
$layout->setTitle('Бубуйка смотрит на тебя =_+!');
$layout->setContent(bu::view('index_content'));
$layout->generate();
?>
