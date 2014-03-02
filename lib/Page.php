<?php
namespace romaninsh\mdcms;
class Page extends \Page {
    function init(){
        parent::init();
        $c=$this->api->add('romaninsh/mdcms/Controller'); // in case it's not there

        var_Dump($this->api->page);
        exit;
    }
}
