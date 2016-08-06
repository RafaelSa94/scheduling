<?php
require_once 'DbConnect.class.php';
require_once '../model/Professor.php';

/**
* Operações relacionadas à tabela de professores
*/
class ProfessorController
{
    private $conn;

    function __construct() {
        $this->conn = (new DbConnect())->getConnection();
    }

    /**
     * Insere um professor no banco de dados
     * @param  Professor $professor  O professor a ser inserido
     * @return Professor             O professor inserido, com o ID
     */
    function insert(Professor $professor) {
        $stmt = $this->conn->prepare("INSERT INTO professor (name, constraints) "
                                        . "VALUES (?, ?)");
        $stmt->bindParam(1, $professor->getName());
        $stmt->bindParam(2, implode(',', $professor->getConstraints()));
        $stmt->execute();
        $professor->setId($this->conn->lastInsertId());
        return $professor;
    }

    /**
     * Obtém todos os valores da tabela, ordenados pelo mais recente.
     * @return array Array com os dados do professor
     */
    function getAll() {
        $stmt = $this->conn->query('SELECT * FROM professor ORDER BY name ASC');
        $data = $stmt->fetchAll();
        foreach ($data as $i => $row) {
            $data[$i] = $this->arrayToObject($row);
        }
        return $data;
    }

    /**
     * Converte um array para objeto
     * @param  array  $array Array associativo com os valores da tabela
     * @return Professor   Objeto convertido
     */
    static public function arrayToObject(array $array) {
        return new Professor(
                    $array['id'],
                    $array['name'],
                    explode(',', $array['constraints'])
                );
    }
}
