<?php
require_once "../app_configs.php";
/**
* Realiza a conexão e as operações no BD
*/
class DbConnect
{
    private $conn;
    function __construct()
    {
        $this->conn = new PDO('mysql:host='.Config::db_host.';dbname='.Config::db_dbname.'', Config::db_user, Config::db_password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) );
    }

    /**
     * Retorna a conexão do banco de dados
     * @return PDO
     */
    public function getConnection() {
        return $this->conn;
    }
}
