<?php
require_once 'DbConnect.class.php';
require_once("../controller/ProfessorController.class.php");
require_once '../model/SubjectClass.php';

/**
* Operações relacionadas à tabela de turmas
*/
class SubjectClassController
{
    private $conn;

    function __construct() {
        $this->conn = (new DbConnect())->getConnection();
    }

    /**
     * Insere um registro na tabela
     * @param  SubjectClass $class  Turma a ser inserida
     * @return SubjectClass         Turma inserida, mas com valor do ID
     */
    function insert(SubjectClass $class) {
        $stmt = $this->conn->prepare("INSERT INTO class (name, professor_id, semester) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $class->getName());
        $stmt->bindParam(2, $class->getProfessor()->getId());
        $stmt->bindParam(3, $class->getSemester());
        $stmt->execute();
        $class->setId($this->conn->lastInsertId());
        return $class;
    }

    /**
     * Edita uma turma.
     * Esta classe se baseia no ID da turma fornecida para editar os outros
     * atributos da turma. O novo nome será o nome incluído no objeto que for
     * passado como argumento.
     * @param  SubjectClass $class  Turma a ser editada
     * @return SubjectClass         Turma editada
     */
    function edit(SubjectClass $class) {
        $stmt = $this->conn->prepare("UPDATE class SET name = ?, semester = ?, professor_id = ? WHERE class.id = ?");
        $stmt->bindParam(1, $class->getName());
        $stmt->bindParam(2, $class->getProfessor() != null ? $class->getProfessor()->getId() : null);
        $stmt->bindParam(3, $class->getSemester());
        $stmt->bindParam(4, $class->getId());
        $stmt->execute();
        return $class;
    }

    /**
     * Remove uma turma do banco de dados
     * @param  SubjectClass $class   Turma a ser removida
     */
    function delete(SubjectClass $class)
    {
        return $this->deleteId($class->getId());
    }

    /**
     * Remove uma turma do banco de dados
     * @param  int $class_id  ID da turma a ser removida
     */
    function deleteId($class_id)
    {
        $stmt = $this->conn->prepare('DELETE FROM class WHERE id = :uclass_id');
        return $stmt->execute(array(':uclass_id' => $class_id));
    }

    /**
     * Obtém todos as turmas
     * @return array Array de objetos SubjectClass
     */
    function getAll() {
        $stmt = $this->conn->query('SELECT * FROM class_professor ORDER BY semester ASC, name ASC');
        $data = $stmt->fetchAll();
        foreach ($data as $i => $row) {
            $data[$i] = $this->arrayToObject($row);
        }
        return $data;
    }

    /**
     * Recebe os dados de uma turma dado seu ID.
     * @param  int $id  ID do turma a ser procurada
     * @return SubjectClass  Turma referente ao ID informado
     */
    function get($id) {
        $stmt = $this->conn->prepare('SELECT * FROM class_professor WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        $data = $stmt->fetchAll();
        foreach ($data as $i => $row) {
            $data[$i] = $this->arrayToObject($row);
        }
        return $data;
    }

    /**
     * Converte um array para objeto
     * @param  array  $array Array associativo com os valores da tabela
     * @return SubjectClass   Objeto convertido
     */
    static public function arrayToObject(array $array) {
        return new SubjectClass(
            $array['id'],
            $array['name'],
            ProfessorController::arrayToObject(array(
                'id' => $array['professor_id'],
                'name' => $array['professor_name'],
                'constraints' => $array['constraints'],
            )),
            $array['semester']
        );
    }
}
