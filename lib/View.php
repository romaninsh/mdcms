<?php
namespace romaninsh\mdcms;
class View extends \View {
    public $prepareTemplate;
    public $file=null;

    function set($file){
        $m=$this->setModel('romaninsh/mdcms/Model');
        $m->setSource('PathFinder','md_content');
        $this->file=$file;
        return $this;
    }
    function recursiveRender(){
        $this->model->loadBy('name',$this->file.'.md');
        $this->template->loadTemplateFromString($this->model['rendered']);
        parent::recursiveRender();
    }

}
