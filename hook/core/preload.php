<?php
bu::hook('session/init');

if (bu::isValidRequest()){
    bu::hook('session/pages');
    bu::hook('session/flash');
}
