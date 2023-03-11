<?php


namespace app;


class ReadAndWriteDbFile
{

    private static $_instances = [];
    private string $_file_name = '';
    private array $_data = [];

    protected function __construct(){

    }
    protected function __clone(){}
    public function __wakeup(){}

    public static function getInstance()
    {
        $cls = static::class;
        if (!isset(self::$_instances[$cls])) {
            self::$_instances[$cls] = new static();
        }
        return self::$_instances[$cls];
    }

    /*************************************************** set **************************************************************/

    public function setFileName(string $file_name) :void
    {
        $this->_file_name = $file_name;
    }

    public function addText(string $text):void
    {
        array_push($this->_data,$text);
    }

    /*************************************************** get **************************************************************/

    private function _getNewText():string
    {
        $str = '';
        foreach ($this->_data as $value) {
            $str.= $value.PHP_EOL;
        }
        return $str;
    }

    public function getData():array
    {
        throw_if(
            !file_exists(sprintf('%s%s.txt',
                App::getConfig()->getParam('path_to_save_files'), $this->_file_name)),
            'No file',
            100,
        );
       return file(App::getConfig()->getParam('path_to_save_files').$this->_file_name.'.txt');
    }



    /*************************************************** logic  **************************************************************/

    public function runWrite():bool
    {

        throw_if(empty($this->_file_name),'Set file name!');
        throw_if(empty($this->_data),'Set data!');

        return $this->_writeToFile();
    }

    private function _writeToFile():bool
    {
        try {

            if (!is_dir(App::getConfig()->getParam('path_to_save_files'))) {
                mkdir(App::getConfig()->getParam('path_to_save_files'), 0775);
            }
            $dir_name = App::getConfig()->getParam('path_to_save_files').$this->_file_name.'.txt';
            $fd = fopen("$dir_name", 'a+');
            fwrite($fd, $this->_getNewText());
            fclose($fd);
            return true;
        } catch (\Exception $exception){
            return false;
        }
    }







}
