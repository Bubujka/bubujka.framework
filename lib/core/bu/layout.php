<?php
abstract class buLayout{
    protected $_title = false;
    protected $_content = false;
    protected $_keywords = false;
    protected $_description= false;
    public function setTitle($data){
        $this->_title = $data;
    }
    public function setKeywords($data){
        if(is_array($data))
            $data = implode(', ',$data);
        $this->_keywords = $data;
    }
    public function setDescription($data){
        $this->_description = $data;
    }
    public function setMeta($data = array()){
        $this->setTitle($data['title']);
        $this->setKeywords($data['keywords']);
        $this->setDescription($data['description']);
    }
    public function setContent($data){
        $this->_content = $data;
    }
    public function getData(){
        return array(
            'title'=>$this->_title,
            'content'=>$this->_content,
            'keywords'=>$this->_keywords,
            'description'=>$this->_description
        );
    }
    abstract public function generate();

}
?>
