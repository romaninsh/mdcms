<?php
namespace romaninsh\mdcms;
class Model extends \Model {
    public $id_field='name';

    function init(){
        parent::init();

        $this->addField('name');
        $this->addField('title');
        $this->addField('data')->caption('Markdown Template');
        $this->addField('rendered')->caption('HTML render cache');

        $this->addHook('afterLoad',function($m){
            if(is_null($m['rendered'])) {
                $markdown = $m['data'];
                if(!$m->hook('prepareTemplate',array(&$markdown))){
                    $markdown = $this->prepareTemplate($markdown);
                }

                $m['rendered'] = \ParsedownExtra::instance()->parse($markdown);
               // $this->prepareTemplate());
            }
            if(is_null($m['title'])) {
                $x=null;
                preg_match('/^# (.*)$/m',$m['data'],$x);
                $m['title']=$x[1];
                //v
                //$m['rendered'] = \ParsedownExtra::instance()->parse($markdown);
               // $this->prepareTemplate());
            }
        });
    }
    /**
     * Redefine this method if you want a special treatment for a Markdown
     * before it will get converted into template.
     */
    function prepareTemplate($template){
        $template=preg_replace_callback('/^\!\[image]\(([^)]*)\)/m',function($x){
            return '![image]('.$this->app->locateURL('public',$x[1]).')';

        },$template);
        $template=preg_replace_callback('/\{page\}([^\{)]*)\{\/\}/m',function($x){
            return $this->app->url($x[1]);

        },$template);
//        $template=preg_replace('/^\!\[image\]\(([^)*])\)/','\1',$template);
//![What is Agile Toolkit](what-is/what-is.png)
        return $template;
    }
}
