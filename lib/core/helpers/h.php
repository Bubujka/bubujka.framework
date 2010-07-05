<?php
// stolen from rails
function h($str = ''){
    return htmlentities($str,ENT_COMPAT,'UTF-8');
}
