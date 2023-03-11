<?php

namespace app ;

class Router
{
    private $_url;
    private $_params = [];

    public function __construct(){}

    public function __clone() {}

    public function __wakeup() {}

    public function getContoller():array
    {
      return $this->_comparisonWithRules();
    }

    private function _parsUrl():string
    {
        return urldecode(parse_url( $_SERVER['REQUEST_URI'] ?? '/',PHP_URL_PATH));
    }

    private function _comparisonWithRules()
    {
        $url = $this->_parsUrl();
        if (strcasecmp($url, '/') == 0) {
            $this->_url = '/';
            return $this->_parsIncomingRequest();
        }

        foreach (App::getConfig()->getRouting('route') as $key => $values) {
            if ( strcasecmp($key, $url) != 0 ) {
                 continue;
            }
            $this->_url = $values;
        }
        return $this->_parsIncomingRequest();
    }

    private function _parsIncomingRequest ()
    {

        if ( !empty($this->_url) ) {

            if ( strcasecmp('/', $this->_url) == 0 ) {
                $this->_url = App::getConfig()->getRouting('base_url');
            }

            $url = explode('/',$this->_url);

            if ( empty(current($url)) ) {
                array_shift($url);
            }

            return [
                'controller'=> $this->_createName(current($url)).'Controller',
                'action' => isset($url[1]) ? 'action'.$this->_createName($url[1]) : 'actionIndex',
            ];

        }
        return [];
    }


    private function _createName($data)
    {
        $data = (explode('-',$data)); // split the string by '-'
        if ( count($data) > 1 ) {
            $array = [];
            for ($i = 0 ; $i < count($data); $i++) {
                $array[] = ucfirst($data[$i]);  // first character to top rigister
            }
            $data = implode($array);
        } else {
            $data = ucfirst($data['0']);
        }

        return $data;
    }

    public function redirectAction()
    {

        $data = $this->getContoller();

        if (empty($data)) {
            $this->redirect404Page();
        }

        $controller = sprintf('controller\%s', $data['controller']);

        if (!class_exists($controller) ) {
            $this->redirect404Page();
        }

        $method = get_class_methods($controller);

        if ( !in_array($data['action'], $method) ) {
             $this->redirect404Page();
        }

        $res = new $controller;
        $method = $data['action'];
        $this->_params['controller'] = $data['controller'];
        $this->_params['action'] = $data['action'];
        $res->$method();
    }

    public function getNameController():string
    {
        return mb_strtolower(stristr($this->_comparisonWithRules()['controller'], 'Controller', true));
    }

    public function redirect404Page()
    {
        return  header('Location:'.App::getConfig()->getRouting('404'));
    }


    public function getNameAction():string
    {
       return substr($this->getContoller()['action'],6);
    }
}










?>