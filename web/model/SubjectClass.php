<?php
/**
* SubjectClass model
*/
class SubjectClass
{
    private $id, $name, $professor, $semester;
    /**
     * @param int $id
     * @param string $name
     * @param Professor $professor
     * @param int $semester
     */
    function __construct($id, $name, $professor, $semester)
    {
        $this->id = $id;
        $this->name = $name;
        $this->professor = $professor;
        $this->semester = $semester;
    }

    /**
     * Retrieves the currently set name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name to use.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Retrieves the currently set professor.
     *
     * @return Professor
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * Sets the professor to use.
     *
     * @param Professor $professor
     *
     * @return $this
     */
    public function setProfessor($professor)
    {
        $this->professor = $professor;
        return $this;
    }

    /**
     * Retrieves the currently set semester.
     *
     * @return int
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * Sets the semester to use.
     *
     * @param int $semester
     *
     * @return $this
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;
        return $this;
    }

    /**
     * Retrieves the currently set id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id to use.
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    function toArray()
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'professor' => $this->professor->toArray(),
            'semester' => $this->semester,
        );
    }
}
