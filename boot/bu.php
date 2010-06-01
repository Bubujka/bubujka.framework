<?php

/*
    public static function timer($name = false, $group = false){
    public static function log($name=false, $group=false, $data=false){

    public static function config($configFullPath, $value = false){
    public static function view($_b_name, $_b_data = array()){
    public static function act($_b_name, $_b_data = array()){
    public static function lib($path, $reload=false){

    public static function args($segment = false){
    public static function path($segment = false){

    public static function hook($name,$data=array()){
    public static function orm($path){
    public static function layout($name){

    public static function deprecated($text){

    public static function pub($path){
    public static function up($path){

    public static function url($path,$data = array()){
    public static function redirect($url){
*/
class bu{
    public static function timer($name = false, $group = false){
        buStatistic::timer($name,$group);
    }
    public static function log($name=false, $group=false, $data=false){
        buLogger::log($name,$group,$data);
    }

    public static function config($configFullPath, $value = false){
        include_once('boot/bu_config.php');
        if (count(func_get_args())==1)
            return buConfig::get($configFullPath);
        else
            return buConfig::set($configFullPath,$value);
    }

    private static function getViewFile($pathArray){
        if (is_string($pathArray))
            $pathArray = array($pathArray);
        $coreDir = BuCore::fstab('viewCore').'/';
        $prjDir = BuCore::fstab('viewPrj').'/';
        $hostDir = BuCore::fstab('viewHostDir').'/'.HTTP_HOST.'/';
        foreach ($pathArray as $path){
            if($path=='blank')
                return 'blank';
            foreach(array($hostDir,$prjDir,$coreDir) as $v)
                if(file_exists($v.$path.'.php'))
                    return $v.$path.'.php';
        }
        throw new Exception('View: '.implode(', ',$pathArray).' not exists');
    }

    public static function view($_b_name, $_b_data = array()){
        if(!$_b_data)
            $_b_data = array();
        ob_start();
            foreach ($_b_data as $k => $v)
                $$k = $v;
            $_b_file = self::getViewFile($_b_name);
            if($_b_file != 'blank')
                include($_b_file); 
            $_b_view_html = ob_get_contents();
        ob_end_clean();
        return $_b_view_html;
    }
    public static function deprecated($text){
        $action = bu::config('rc/actionOnDeprecated');
        if(!$action)
            return ;
        if($action == 'exception')
            throw new Exception ($text);
        if($action == 'print')
            print ('--'.$text.'--');
    }
    public static function redirect($url){
        header('Location: '.$url);
        exit;
    }

    private static $_path = false;
    public static function args($segment = false){
        $args = BuUrl::getVars();
        if ($segment === false)
            return $args;
        if(!array_key_exists($segment, $args))
            return false;
        return $args[$segment];
    }
    public static function path($segment = false){
        if(self::$_path === false)
            self::$_path = BuUrl::getPath();
        if ($segment === false)
            return self::$_path;
        if(!array_key_exists($segment, self::$_path))
            throw new Exception('Сегмент '.$segment.' отсутствует в'.
                                ' списке пути.');
        return self::$_path[$segment];
    }

    private static function getHookFile($pathArray){
        if (is_string($pathArray))
            $pathArray = array($pathArray);
        $coreDir = BuCore::fstab('hookCore').'/';
        $prjDir = BuCore::fstab('hookPrj').'/';
        $hostDir = BuCore::fstab('hookHostDir').'/'.HTTP_HOST.'/';

        foreach ($pathArray as $path){
            if($path=='blank')
                return 'blank';
            foreach(array($hostDir,$prjDir,$coreDir) as $v)
                if(file_exists($v.$path.'.php'))
                    return $v.$path.'.php';
        }
        throw new Exception('Hook: '.$path.' not exists');
    }
    private static function getActFile($pathArray){
        if (is_string($pathArray))
            $pathArray = array($pathArray);
        $coreDir = BuCore::fstab('actCore').'/';
        $prjDir = BuCore::fstab('actPrj').'/';
        $hostDir = BuCore::fstab('actHostDir').'/'.HTTP_HOST.'/';

        foreach ($pathArray as $path){
            if($path=='blank')
                return 'blank';
            foreach(array($hostDir,$prjDir,$coreDir) as $v)
                if(file_exists($v.$path.'.php'))
                    return $v.$path.'.php';
        }
        throw new Exception('Action: '.$path.' not exists');
    }


    public static function act($_b_name, $_b_data = array()){
        if(!$_b_data)
            $_b_data = array();
        ob_start();
            foreach ($_b_data as $k => $v)
                $$k = $v;
            $_b_file = self::getActFile($_b_name);
            if($_b_file != 'blank')
                include($_b_file); 
            $_b_view_html = ob_get_contents();
        ob_end_clean();
        return $_b_view_html;
    }

    public static function hook($_b_name,$_b_data=array()){
        if(!$_b_data)
            $_b_data = array();
        foreach ($_b_data as $k => $v)
            $$k = $v;
        $_b_file = self::getHookFile($_b_name);
        if($_b_file != 'blank')
            include($_b_file); 
    }
    private static function getLibFile($path){
        $coreDir = BuCore::fstab('snipCore').'/';
        $prjDir = BuCore::fstab('snipPrj').'/';
        $hostDir = BuCore::fstab('snipHostDir').'/'.HTTP_HOST.'/';
        foreach(array($hostDir,$prjDir,$coreDir) as $v)
            if(file_exists($v.$path.'.php'))
                return $v.$path.'.php';
        throw new Exception('Library: '.$path.' not exists');
    }


    public static function lib($path, $reload=false){
        $filePath = self::getLibFile($path);
        if($reload)
            include($filePath);
        else
            include_once($filePath);
    }

    private static $_ormPeer = array();
    public static function orm($path){
        self::lib('orm/'.$path);
        self::lib('orm/peer/'.$path);
        if(!isset(self::$_ormPeer[$path])){
            $className = str_replace('_','',$path).'OrmPeer';
            self::$_ormPeer[$path] = new $className();
        }
        return self::$_ormPeer[$path];
    }

    private static $_layouts = array();
    public static function layout($name){
        self::lib('bu/layout');
        if(!isset(self::$_layouts[$name])){
            self::lib('layout/'.$name);
            $className = str_replace('_','',$name).'Layout';
            self::$_layouts[$name] = new $className();
        }
        return self::$_layouts[$name];
    }

    public static function pub($path){
        return self::config('rc/browserPublicPath').$path;
    }

    public static function up($path){
        return self::config('rc/browserUploadPath').$path;
    }

    public static function url($path,$data = array()){
        $url = self::config('url/'.$path);
        if($data)
            foreach($data as $k=>$v)
                $url = str_replace(':'.$k,$v, $url);
        return $url;
    }

}
?>
