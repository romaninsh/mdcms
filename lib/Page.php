<?php
namespace romaninsh\mdcms;
class Page extends \Page {

    protected $view_class='romaninsh/mdcms/View'; 
    protected $controller_class='romaninsh/mdcms/View'; 


    function init(){
        parent::init();
        $c=$this->api->add('romaninsh/mdcms/Controller',array('init'=>false)); // in case it's not there
        $v=$this->add($this->view_class);
        $page = str_replace('_','/',$this->api->page);
        $v->set($page);
        $this->setModel($v->model);
    }

    function subPageHandler($p) {
    }
}
