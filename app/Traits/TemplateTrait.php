<?php


namespace app\Traits;

use app\App;

trait TemplateTrait
{
    protected string $layout;
    protected string $page;
    protected string $scripts;
    protected string $style;
    protected string $title;
    protected object $object;
    protected array $variable = [];
    protected string $template_name = '';

    /**
     * @param string $title
    **/
    public function setTitle(string $title):void
    {
        $this->title = $title;
    }

    /**
     * @param array $styles
     * @return void
    **/
    public function setStyle(array $styles):void
    {
        $styleHtml = '';
        foreach ($styles as $key) {
            throw_if(pathinfo($key)['extension'] != 'css',  'Wrong extension css file');
            $styleHtml .= sprintf('<link rel="stylesheet" href="%s">', $key);

        }
        $this->style = $styleHtml;
    }

    /** @param array $scripts **/
    public function setScript(array $scripts):void
    {
        $scriptHtml = '';
        foreach ($scripts as $key) {
            throw_if(pathinfo($key)['extension'] != 'js','Wrong extension js file' );
            $scriptHtml .=sprintf('<script src="%s"></script>',$key);
        }
        $this->scripts = $scriptHtml;
    }

    /**
     * @param string $name_template
    **/
    public function setTemplateName(string $name_template)
    {
        $this->template_name = $name_template;
    }


    /**
      @param array $script
    **/
    public function addScript(array $script) :void
    {
        foreach ($script as $value){
            array_push($this->object->scripts , $value);
        }
        $this->setScript($this->object->scripts);
    }

    /**
     * @param array $style
    **/
    public function addStyle(array $style) :void
    {
        foreach ($style as $value){
            array_push($this->object->styles , $value);
        }
        $this->setStyle($this->object->styles);
    }

    /**
     * @param string $title
    **/
    public function updateTitle(string $title)
    {
        $this->title = $title;
    }

    /**
      @param array $variable
    **/
    public function setVariable(array $variable):void
    {
        $this->variable = $variable;
    }

    /**
     * @param bool $absolute_path
     * @return void
    **/
    private function _checkLayoutsFile(bool $absolute_path = false):void
    {
        $layout = sprintf('%s%s%s.%s',
            App::getConfig()->getPathView(),
            'layouts'.DIRECTORY_SEPARATOR,
             App::getConfig()->getLayout(),
             self::TEMPLATE_EXTENSION
        );
        throw_if(!file_exists($layout),'Layout file not found '.$layout);
        if ($absolute_path){
            $this->layout = $layout;
        } else {
            $this->layout = sprintf('layouts%s%s.%s',
                DIRECTORY_SEPARATOR,
                App::getConfig()->getLayout(),
                self::TEMPLATE_EXTENSION
            );
        }
    }

    /**
     * @param bool $absolute_path
    **/
    private function _checkTemplatePath(bool $absolute_path = false):void
    {
        $path = App::getConfig()->getPathView().App::getRouter()->getNameController();
        throw_if(!is_dir($path), 'Render file not found '. $path);
        $path_file = sprintf('%s%s%s.%s',
            $path,
            DIRECTORY_SEPARATOR,
            $this->template_name,
            self::TEMPLATE_EXTENSION
        );

        throw_if(!file_exists($path_file), sprintf('No render view %s', $path_file));

        if ($absolute_path) {
            $this->page =  $path_file;
        } else {
            $this->page = sprintf(
                '%s%s%s.%s',
                App::getRouter()->getNameController(),
                DIRECTORY_SEPARATOR,
                $this->template_name,
                self::TEMPLATE_EXTENSION
            );
        }
    }








}