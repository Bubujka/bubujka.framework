<?php
class PanicLayout extends buLayout{
    public function generate(){
        echo bu::view('layout/panic',$this->getData());
    }
}
?>
