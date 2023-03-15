<?php


namespace app\Interfaces;


interface TemplateInterface
{
    /**
     @param object $obj object Class PageBuilder->renderPage()
    **/
    public function __construct(object $obj);

    /**
     @param string $title
    **/
    public function setTitle(string $title):void;

    public function render():void;

    public function renderAjaxPage():void;

    public function setStyle(array $styles):void;

    /**
     @param array $scripts
    **/
    public function setScript(array $scripts):void;

    /**
     * @param array $script *
     */
    public function addScript(array $script) :void;

    /**
     @param array $style *
    **/
    public function addStyle(array $style) :void;

    /**@param string $title **/
    public function updateTitle(string $title);

    /**
      @param array $variable
    **/
    public function setVariable(array $variable):void;

    /**
     * @param string $name_template
    **/
    public function setTemplateName(string $name_template);





}