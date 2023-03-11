<?php


namespace app\render;

use app\interfaces\PageBuilderInterface;

class PageBuilder implements PageBuilderInterface
{
    /**@var PageBuilder **/
    private $_data_object;

    public function __construct()
    {
        $this->create();
    }

    public function create(): PageBuilderInterface
    {
        $this->_data_object = new class{};
        return $this;
    }

    /**
     * @param string $title
     * @return PageBuilderInterface
    **/
    public function setTitle(string $title): PageBuilderInterface
    {
        $this->_data_object->title = $title;
        return $this;
    }

    /**
     * @param array $meta_data
     * @return PageBuilderInterface
    **/
    public function setMetaData(array $meta_data): PageBuilderInterface
    {
        $meta = '';
        foreach ($meta_data as $value) {
            $meta .= $value;
        }
        $this->_data_object->meta_data = $meta_data;
        return $this;
    }

    /**
     * @param string $path_to_template
     * @return PageBuilderInterface
    **/
    public function setPageTemplate(string $path_to_template):PageBuilderInterface
    {
        $this->_data_object->path_to_template = $path_to_template;
        return $this;
    }

    /**
     * @param array $style
     * @return PageBuilderInterface
    **/
    public function setStyle(array $styles): PageBuilderInterface
    {
        $this->_data_object->styles = $styles;
        return $this;
    }

    /**
     * @param array $scripts
     * @return PageBuilderInterface
    */
    public function setScripts(array $scripts): PageBuilderInterface
    {
        $this->_data_object->scripts = $scripts;
        return $this;
    }

    /**
     * @param array $variable * ['name_variable' => value]
     * @return PageBuilderInterface
     **/
    public function setVariable(array $variable): PageBuilderInterface
    {
        $name_var = current(array_keys($variable));
        $this->_data_object->variable[$name_var] = current(array_values($variable));
        return $this;
    }

    /**
     * @param string $template_name
     * @return PageBuilderInterface
     **/
    public function setTemplateName(string $template_name):PageBuilderInterface
    {
        $this->_data_object->template_name = $template_name;
        return $this;
    }

    /**
     * @param string $path
     * @return PageBuilderInterface
    */
    public function setLayout(string $path): PageBuilderInterface
    {
       $this->_data_object->layout = $path;
       return $this;
    }

    public function setDataObject(object $obj): PageBuilderInterface
    {
        $this->_data_object = $obj;
        return $this;
    }


    public function buildPage()
    {
        $data = $this->_data_object;
        $this->create();
        return $data;
    }

    /**
     * @param string $class - template render class name
     * @return PageBuilderInterface
     **/
    public function setTemplateClass(string $class):PageBuilderInterface
    {
        $this->_data_object->template_class = $class;
        return $this;
    }

    public function renderPage()
    {
        return new $this->_data_object->template_class($this->buildPage());
    }

}