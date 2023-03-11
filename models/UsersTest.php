<?php


namespace models;
use app\ReadAndWriteDbFile;

class UsersTest
{

    private object $_fileClass;
    private string $_file_name = 'user';

    public function __construct()
    {
        $this->_fileClass = ReadAndWriteDbFile::getInstance();
        $this->_fileClass->setFileName($this->_file_name);
    }

    protected function _setParams($data)
    {
        $this->_data = $data;
    }

    protected function getData():array
    {
        return $this->_data;
    }


    private array $_users = [
        [
            'id' => 1,
            'first_name' => 'Test',
            'last_name'  => 'Testovich',
            'email'      => 'test@test.com',
        ],[
            'id' => 2,
            'first_name' => 'Test1',
            'last_name'  => 'Testov',
            'email'      => 'test1@test.com',
        ],[
            'id' => 3,
            'first_name' => 'Test2',
            'last_name'  => 'Testov',
            'email'      => 'test2@test.com',
        ]
    ];

    private array $_rules = [
        ['name' => 'email', 'require' => true, 'type' => 'email'],
        ['name' => 'first_name', 'require' => true, 'type' => 'text'],
        ['name' => 'last_name', 'require' => true, 'type' => 'text'],
        ['name' => 'password', 'require' => true, 'type' => 'text'],
        ['name' => 'confirm_password', 'require' => true, 'type' => 'text'],
    ];



    /**@param
     * string $email
     * @return array
     **/
    public function getUserByEmail(string $email):array
    {
        $arr = array_filter($this->_users,function ($data) use ($email) {
            return $data['email'] == $email;
        });

        $log = sprintf(
            'date:%s; ip: %s; email: %s; status:%s;',
            date('Y-m-d H:i:s'),
            $_SERVER['REMOTE_ADDR'],
            $email,
            !empty($arr) ? 'ok' : 'error email exists',
        );
        $this->_fileClass->addText($log);
        $this->_fileClass->runWrite();

        return $arr;
    }

    public function save(array $data)
    {
        $this->_setParams($data);
        $res = $this->_checkData();

        if (!$res['status']) {
            return $res;
        }

        try {
            if (!empty($this->getUserByEmail($this->getData()['email']))) {
                return ['status' => false, 'error' => 'email_exists'];
            }
        } catch (\Exception $e) {
            throw_if($e->getCode() !== 100,$e->getMessage(),$e->getCode());
        }

        return ['status' => true];
    }

    private function _checkData():array
    {
        $arr = [];
        $data = $this->getData();
        $errors = [];
        foreach ($this->_rules as $key) {

            if (isset($key['require']) && $key['require'] == true) {
                if (!isset($key['name'], $data)) {
                    $errors[] = ['error' => 'no_fields_in_rules', 'name' => $key['name']];
                }

                if ($data[$key['name']] == '') {
                    $errors[] =  ['error' => 'empty_field', 'name' => $key['name']];
                }
            }

            if ($key['type'] == 'email') {
                if (!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $data[$key['name']])) {
                    $errors[] =  ['error' => 'invalid_field', 'name' => $key['name']];
                }
            }

            $arr[$key['name']] = $data[$key['name']];
        }

        if ($data['password'] != $data['confirm_password']) {
            $errors[] = ['error' => 'error_password_coincidence', 'name' => 'password'];
            $errors[] = ['error' => 'error_password_coincidence', 'name' => 'confirm_password'];
        }

        if (!empty($errors)) {

            $names_fields = [];
            $errors_res = array_filter($errors,function ($arr) use (&$names_fields) {
                if (!in_array($arr['name'],$names_fields)) {
                    $names_fields[] = $arr['name'];
                    return true;
                }
                return false;
            });
            $errors_res = array_values($errors_res);
            return ['status' => false, 'error' => $errors_res];
        }

        unset($arr['confirm_password']);
        $this->_setParams($arr);
        return ['status'=> true];
    }








}