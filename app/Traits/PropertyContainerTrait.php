<?php


namespace app\traits;



trait PropertyContainerTrait
{

    private $_params;

    /**
     * @param string $key - name key - it is desirable to use keys from a variable $this->_key_params;
     * @param mixed $value
     * @return void
     **/

    protected function _setParams(string $key, mixed $value):void
    {
        throw_if(isset($this->_params[$key]),sprintf('Option %s was set before',$key));
        $this->_params[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    protected function updateParams(string $key, mixed $value):void
    {
        throw_if(!isset($this->_params[$key]),sprintf('The key %s has not been set',$key) );
        $this->_params[$key] = $value;
    }

    /**
     * @param string $key - $this->_key_params;
     * @return mixed
     */
    protected function _getParams(string $key):mixed
    {
        $res_search = $this->_getParamsToPath($key ,'');
        if (!empty($res_search)) {
            return $res_search;
        }
        return [];
    }

    /**
     * @param string $path
     */
    private function _getParamsToPath(string $path, $haystack ='')
    {
        $path = explode('/',$path);

        if (empty($haystack)) {
            $haystack = $this->_params;
        }

        foreach ($path as $key) {
            if (isset($haystack[$key])) {
                if ($path[count($path)-1] == $key) {
                    return $haystack[$key];
                }
                if (is_array($haystack[$key]) && !empty($path)) {
                    array_shift($path);
                    $res = $this->_getParamsToPath( implode('/',$path) , $haystack[$key]);
                    if (!is_null($res)) {
                        return $res;
                    }
                }
            }
        }
    }
}