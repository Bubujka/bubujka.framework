<?
class BuLoader{
    private static $httpString = false;
    private function __construct(){ }

    public static function setHttpString($val){
        self::$httpString = $val;
    }
    private static function prepareHttpString(){
        BuRoute::setHttpString(self::$httpString);
        $httpString = BuRoute::doIt();
        self::$httpString = $httpString;
    }

    private static function runController($_controllerFile){
        bu::timer('Controller start.','system');
        include($_controllerFile);
        bu::timer('Controller end.','system');
    }
    public static function DoIt(){
        self::prepareHttpString();
        try{
            BuUrl::setHttpString(self::$httpString);
            BuUrl::doIt();
            $controllerFile = BuUrl::getControllerFile();
            self::runController($controllerFile);
        }catch(Exception $e){
            $msg = 'Ошибка на сайте';
            if(bu::config('rc/debug'))
                $msg = get_class($e).': '.$e->getMessage();
            $layout = bu::layout('panic');
            $content = $msg;
            if(bu::config('rc/debug')){
                #$content .= sprintf('<br><b>%s</b><br>',get_class($e));
                #$content .= "<pre>";
                #foreach (array_reverse($e->getTrace()) as $v)
                    #$content .= $v['line'].' '.$v['file']."\n";
                #$content .= "</pre>";
            }
            $layout->setContent($content);
            $layout->generate();
        }
    }
}
?>
