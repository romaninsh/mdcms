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
                $markdown = $m['data'];
                $m->hook('prepareTemplate',array(&$markdown));

                $m['rendered'] = \Parsedown::instance()->parse($markdown);
               // $this->prepareTemplate());
            }
        });
    }
    /**
     * Redefine this method if you want a special treatment for a Markdown
     * before it will get converted into template.
     */
    function prepareTemplate($template){
        //$template=str_replace('Design','',$template);
//![What is Agile Toolkit](what-is/what-is.png)
        return $template;
    }
}
