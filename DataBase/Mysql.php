<?php
/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 2017/4/12
 * Time: 下午2:36
 */
class Mysql
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PWD = '';
    const DB_PORT = 3306;
    CONST DB_NAME = 'personal';

    protected static $_instance ;
    protected static $_link = null;

    /**
     * 累的实例
     * @return Mysql
     *
     */
    public function getClassStringLeton()
    {
        if(!isset(self::$_instance)){
            self::$_instance = new self();
        }
        self::connect($this::DB_HOST,$this::DB_USER,$this::DB_PWD,$this::DB_NAME);
        return self::$_instance;
    }

    /**
     * 连接数据库
     * @param $host
     * @param $user_name
     * @param $user_name
     * @param $db_name
     */
    public function connect($host,$user_name,$pwd,$db_name)
    {
        try{
            self::$_link = new PDO("mysql:host={$host};dbname={$db_name}",$user_name, $pwd);
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }

    public function query()
    {

    }
}