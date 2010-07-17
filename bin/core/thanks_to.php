<?php
$layout = bu::layout('bubujka_basic');
$layout->setTitle('Благодарности');
$layout->setContent(bu::view('thanks_to'));
$layout->generate();
