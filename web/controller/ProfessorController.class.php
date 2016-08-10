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
        if (!$stmt->execute())
            throw new Exception("Erro ao inserir item.", 1);

        $professor->setId($this->conn->lastInsertId());
        return $professor;
    }

    /**
     * Edita um professor.
     * Esta classe se baseia no ID do professor fornecida para editar os outros
     * atributos do professor. O novo nome será o nome incluído no objeto que for
     * passado como argumento.
     * @param  Professor $professor  Professor a ser editado
     * @return Professor             Professor editado
     */
    function edit(Professor $professor) {
        $stmt = $this->conn->prepare("UPDATE professor SET name = ?, constraints = ? WHERE professor.id = ?");
        $stmt->bindParam(1, $professor->getName());
        $stmt->bindParam(2, implode(',', $professor->getConstraints()));
        $stmt->bindParam(3, $professor->getId());

        if (!$stmt->execute())
            throw new Exception("Erro ao editar item.", 1);

        return $professor;
    }

    /**
     * Remove um professor do banco de dados
     * @param  Professor $professor   Professor a ser removido
     */
    function delete(Professor $professor)
    {
        return $this->deleteId($professor->getId());
    }

    /**
     * Remove um professor do banco de dados
     * @param  int $professor_id  ID do professor a ser removido
     */
    function deleteId($professor_id)
    {
        $stmt = $this->conn->prepare('DELETE FROM professor WHERE id = :uprofessor_id');

        if (!$stmt->execute(array(':uprofessor_id' => $professor_id)))
            throw new Exception("Erro ao excluir item.", 1);
    }

    /**
     * Recebe os dados de um professor dado seu ID.
     * @param  int $id  ID do professor a ser procurado
     * @return Professor  Professor referente ao ID informado
     */
    function get($id) {
        $stmt = $this->conn->prepare('SELECT * FROM professor WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        $data = $stmt->fetchAll();
        foreach ($data as $i => $row) {
            $data[$i] = $this->arrayToObject($row);
        }
        return $data;
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
