<?php
class BuUrl{
    private static $instance=false;
    private $httpString=false;
    private $controllerFile=false;

    private $bin = false;
    private $usrBin = false;
    private $usrLocalBin = false;

    private $var = array();

    public static function getInstance(){
        if(!self::$instance) 
            self::$instance = new BuUrl();
        return self::$instance;
    }

    private function __construct(){
        $this->bin = $this->recursiveReadDir(BuCore::fstab('controllersCore'));
        $this->usrBin = $this->recursiveReadDir(BuCore::fstab('controllersPrj'));
        $this->usrLocalBin = $this->recursiveReadDir(BuCore::fstab('controllersHostDir').'/'.HTTP_HOST);
    }
    public static function setHttpString($var){
        $i = self::getInstance();
        $i->httpString = $var;
    }
    public static function doIt(){
        $i = self::getInstance();
        $i->var = array();
        $i->controllerFile = $i->getControllerFileHidden($i->httpString);
    }
    public static function getVars(){
        $i = self::getInstance();
        return array_reverse($i->var);
    }
    public static function getPath(){
        $array = explode('/',RAW_HTTP_STRING);
        $returnArray = array();
        foreach ($array as $v)
            if (trim($v))
                $returnArray[] = $v;
        return $returnArray;
    }
    public static function getControllerFile(){
        $i = self::getInstance();
        return $i->controllerFile;
    }
    private function getControllerFileHidden($url){
        if (substr($url,-1)=='/') 
            $url = substr ($url, 0, -1);
        if ($this->usrLocalBin[$url]) 
            return $this->usrLocalBin[$url];
        if($this->usrBin)
            if (array_key_exists($url,$this->usrBin)) 
                return $this->usrBin[$url];
        if (array_key_exists($url,$this->bin)) 
            return $this->bin[$url];
        
        if (!$url){
            if ($this->usrLocalBin['/index']) 
                return $this->usrLocalBin['/index'] ;
            if ($this->usrBin['/index']) 
                return $this->usrBin['/index'] ;
            if ($this->bin['/index']) 
                return $this->bin['/index'] ;
            throw new Exception404;
        }

        preg_match('/(.*)\/([^\/]+)/',$url,$match);
        $stripUrl = '';
        if (array_key_exists(1,$match) and array_key_exists(2,$match) ){
            $stripUrl = $match[1];
            $this->var[]=$match[2];
        }
        return $this->getControllerFileHidden($stripUrl);
    }

    private function recursiveReadDir($dirName, $prefix=''){
        if(!file_exists($dirName)) return ;
        $d = dir($dirName);
        $return = array();
        while (false !== ($entry = $d->read())) {
            if ($entry != '.' and $entry != '..'){
                if(is_dir($dirName.'/'.$entry)){
                    $tmp = $this->recursiveReadDir($dirName.'/'.$entry,$prefix.'/'.$entry);
                    $return = array_merge($return,$tmp);
                }
                if (is_file($dirName.'/'.$entry)){
                    if($entry == 'index.php'){
                        $return[str_replace('.php','',$prefix)]=$dirName.'/'.$entry;
                    }else{
                        $return[str_replace('.php','',$prefix.'/'.$entry)]=$dirName.'/'.$entry;
                    }
                }
            }
        }
        $d->close();
        return $return;
    }
}
?>
