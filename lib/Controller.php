<?php
namespace romaninsh\mdcms;

class Controller extends \AbstractController {
    public $target=null;
    public $callback=null;
    function init() {
        parent::init();

        $path = $this->api->locatePath('content',str_replace('_','/',$this->api->page).'.md');

        if(!$this->target)$this->target=$this->api;

        $page = $this->api->page_object = $this->target->add('Page');

        $html = \Parsedown::instance()->parse(file_get_contents($path));

        $page->template->loadTemplateFromString($html);

        if($this->callback)call_user_func($this->callback,$page);

        throw $this->exception('','Exception_StopInit');
    }
}
