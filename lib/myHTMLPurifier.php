<?php

class myHTMLPurifier extends HTMLPurifier {
	public function createConfig () {
		$config = HTMLPurifier_Config::createDefault();

		// cache dir, just for symfony of course, you can change to another path
		$config->set('Cache.SerializerPath', sfConfig::get('sf_cache_dir'));

		$config->set('HTML.Doctype', 'XHTML 1.0 Strict');

		$config->set('HTML.TidyLevel', 'heavy');

		return $config;
	}
}
