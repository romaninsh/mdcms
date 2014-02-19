<?php
namespace romaninsh\mdcms;
class Model extends \Model {
    public $id_field='name';

    function init(){
        parent::init();

        $this->addField('name');
        $this->addField('data')->caption('Markdown Template');
        $this->addField('rendered')->caption('HTML render cache');

        $this->addHook('afterLoad',function($m){
            if(is_null($m['rendered'])) {
                $m['rendered'] = \Parsedown::instance()->parse($m['data']);
            }
        });
    }
}
