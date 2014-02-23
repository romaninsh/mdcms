<?php
namespace romaninsh\mdcms;
class View extends \View {
    function set($file){
        $m=$this->setModel('romaninsh/mdcms/Model');
        $m->setSource('PathFinder','md_content');
        $this->model->tryLoadBy('name',$file.'.md');

        parent::setHTML($this->model['rendered']);
    }
}
