<?php
namespace romaninsh\mdcms;
class Page extends \Page {
    function init(){
        parent::init();
        $c=$this->api->add('romaninsh/mdcms/Controller',array('init'=>false)); // in case it's not there
        $v=$this->add('romaninsh/mdcms/View');
        $page = str_replace('_','/',$this->api->page);
        $v->set($page);
        $this->api->setTags($v->template);
    }

    function subPageHandler($p) {
    }
}
