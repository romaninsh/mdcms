<?php
namespace romaninsh\mdcms;

class Controller extends \AbstractController {
    public $target=null;
    public $callback=null;

    public $init=true;

    public $page_class='romaninsh/mdcms/Page';

    function addLocation() {
        $this->api->pathfinder->base_location->defineContents(array(
            'md_content'=>'content',
        ));
    }
    function tryInitPage() {
        // Attempt to load content file for respective page
        $content = $this->get(str_replace('_','/',$this->api->page));
        if(!$content)return;
        /*
        if(is_null($content))return;
         */


        if(!$this->target){
            $this->target=$this->api->layout ?: $this->api;
        }

        $page = $this->api->page_object = $this->target->add($this->page_class, ['title'=>$content['title']]);
    }


    function registerTemplateTags() {

        $self=$this;

        $this->api->addHook('set-tags',function($a,$t)use($self){
            $t->eachTag('markdown',array($self,'parse'));
            $t->eachTag('markdown_include',array($self,'parseTemplate'));
        });
    }

    /**
     * Provided with markdown - parse it and return HTML
     */
    function parse($markdown){
        return \Parsedown::instance()->parse($markdown);
    }

    function parseTemplate($template){
        return $this->get($template)->get('rendered');
    }

    function get($template){
        if($this->model && $this->model->tryLoadBy('name',$template.'.md')->loaded()){
            return $this->model;
        }
    }

    function init() {
        parent::init();


        $this->addLocation();

        if($this->init){
            try {
                $this->registerTemplateTags();

                $m=$this->setModel('romaninsh/mdcms/Model');
                $m->setSource('PathFinder','md_content');

                $this->tryInitPage();
            }catch(Exception $e){
            }
        }
    }
}
