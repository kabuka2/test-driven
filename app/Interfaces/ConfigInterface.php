<?php


namespace app\Interfaces;


interface ConfigInterface
{
    /**@param array $config **/
    public function setConfig(array $config):void;

    /**
     * @return array
    **/
    public function getAllConfig():array;

    /**
     * @param string $key
     * @return mixed String or Array;
    **/
    public function getRouting(string $key = ''):mixed;

    /**
     * @return string
    **/
    public function getPathView():string;

    /**
     * @param string $path
     * @return mixed
     */
    public function getConfigToPath(string $path);

    /**
     * @return string*
     */
    public function getLayout():string;

    /**@return string**/
    public function getClassRenderView():string;

    /**@return array**/
    public function getAvailableResources(string $type):array;

}