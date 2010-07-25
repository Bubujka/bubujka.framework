<?php
class LayoutApplication{
	public function runController($__url){
		bu::timer('Controller start.','system');
		bu::hook(array('pre_controller','blank'));
		ob_start();
			$layout = bu::layout();
			if($__url->getBinUrl())
				$layout->_content_view = $__url->getBinUrl();
			include($__url->getBinFile());
			$__content = ob_get_contents();
		ob_end_clean();
		$layout->content = $__content;
		$layout->generate();
		bu::timer('Controller end.','system');
	
	}
}

