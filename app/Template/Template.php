<?php


namespace app\template;

use app\interfaces\TemplateInterface;
use app\traits\TemplateTrait;
use app\App;

class Template implements TemplateInterface
{
    const TEMPLATE_EXTENSION = 'php';
    use TemplateTrait;

    public function __construct(object $obj)
    {
        $this->setTitle($obj->title ?? '');
        $this->setTemplateName($obj->template_name);
        $this->setVariable($obj->variable);
    }


    public function render():void
    {

        $this->_checkLayoutsFile(true);
        $this->_checkTemplatePath(true);
        $this->setScript(App::getConfig()->getAvailableResources('js'));
        $this->setStyle(App::getConfig()->getAvailableResources('css'));

        if (isset($this->variable)) {
            extract($this->variable,EXTR_OVERWRITE);
        }
        ob_start();
            include $this->page;
        $page = ob_get_clean();

        ob_start();
            include $this->layout;
        $content = ob_get_clean();

        echo $content;
    }

    public function renderAjaxPage():void
    {
        if (isset($this->_builder->variable)) {
            extract($this->_builder->variable,EXTR_OVERWRITE);
        }

        ob_start();
        include $this->page;
        $page = ob_get_clean();
        echo $page;
    }


}