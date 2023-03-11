<?php


namespace app\config;


use app\interfaces\ConfigInterface;
use app\traits\InstancesTrait;
use app\traits\PropertyContainerTrait;

class Config implements ConfigInterface
{
    use InstancesTrait;
    use PropertyContainerTrait;

    /**
     * @param array $config *
     */
    public function setConfig(array $config ):void
    {
        $this->_setParams('config',$config);
    }

    /**
     * @return array *
    **/
    public function getAllConfig():array
    {
        return $this->_getParams('config');
    }

    /**
     * @param string $key
    **/
    public function getRouting(string $key = ''):mixed
    {
        return $this->_getParams(!empty($key) ? 'config/urlManager/'.$key :'config/urlManager');
    }

    /**
     * @return string *
     */
    public function getPathView():string
    {
        $data = $this->_getParams('path_view');
        if (empty($data)) {
            $this->_getInfoRenderView();
        }
        return $this->_getParams('path_view');
    }

    /**
     * @return string *
    **/
    public function getLayout():string
    {
        $layout = $this->_getParams('layout_path');
        if (empty($layout)) {
            $this->_getInfoRenderView();
        }
        return $this->_getParams('layout_path');
    }

    /**
     * @return string*
    **/
    public function getClassRenderView():string
    {
        $class = $this->_getParams('class_render');
        if (empty($class)) {
            $this->_getInfoRenderView();
        }
        return $this->_getParams('class_render');

    }

    /**
     * @return string
    **/
    public function getBasePath():string
    {
       return $this->_getParams('config/base_path');
    }

    /**
     * @param string $type *
     * @return array
    **/
    public function getAvailableResources(string $type):array
    {
        $resources = $this->_getParams('config/dist/'.$type);
        throw_if(empty($resources),'No attached files' );
        return$resources;
    }

    /** getParam no recursion which saves resources
     * @param string $param_name;
    **/
    public function getParam(string $param_name):mixed
    {
        $params = $this->_getParams('config');
        throw_if(!isset($params[$param_name]),'Not find param '.$param_name );

        return $params[$param_name];
    }

    /**
     * @param string $path
    **/
    public function getConfigToPath(string $path = '')
    {
       return $this->_getParams('config/'.$path);
    }

    /**
     * @return void
    **/
    private function _getInfoRenderView():void
    {
        $use_render_class = $this->_getParams('config/view/render_class');
        $this->_setParams('class_render',$use_render_class);
        $this->_setParams('layout_path',$this->_getParams(sprintf('config/view/%s/layout',$use_render_class)));
        $this->_setParams('path_view', $this->_getParams(sprintf('config/view/%s/path_view',$use_render_class)));
    }

}