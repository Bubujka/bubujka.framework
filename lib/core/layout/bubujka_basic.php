<?php
class BubujkaBasicLayout extends buLayout{
    public function generate(){
        echo bu::view('layout/bubujka_basic',$this->getData());
    }
}
?>
