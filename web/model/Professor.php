<?php
/**
* Modelo Professor
*/
class Professor
{
    private $id, $name, $constraints;
    /**
     * @param int    $id         [description]
     * @param string $name       [description]
     * @param array  $constraint [description]
     */
    function __construct($id, $name, $constraints)
    {
        $this->id = $id;
        $this->name = $name;
        $this->constraints = $constraints;
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
     * Retrieves the currently set constraints.
     *
     * @return array
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * Sets the constraints to use.
     *
     * @param array $constraints
     *
     * @return $this
     */
    public function setEstado($constraints)
    {
        $this->constraints = $constraints;
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

    function toArray() {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'constraints' => $this->constraints,
        );
    }
}
