<?php

namespace NominaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="usu_name", type="string", length=80, nullable=false)
     */
    private $usuName;

    /**
     * @var string
     *
     * @ORM\Column(name="usu_cedula", type="string", length=20, nullable=true)
     */
    private $usuCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="usu_salary", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $usuSalary;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set usuName
     *
     * @param string $usuName
     *
     * @return Usuario
     */
    public function setUsuName($usuName) {
        $this->usuName = $usuName;

        return $this;
    }

    /**
     * Get usuName
     *
     * @return string
     */
    public function getUsuName() {
        return $this->usuName;
    }

    /**
     * Set usuCedula
     *
     * @param string $usuCedula
     *
     * @return Usuario
     */
    public function setUsuCedula($usuCedula) {
        $this->usuCedula = $usuCedula;

        return $this;
    }

    /**
     * Get usuCedula
     *
     * @return string
     */
    public function getUsuCedula() {
        return $this->usuCedula;
    }

    /**
     * Set usuSalary
     *
     * @param string $usuSalary
     *
     * @return Usuario
     */
    public function setUsuSalary($usuSalary) {
        $this->usuSalary = $usuSalary;
        return $this;
    }

    /**
     * Get usuSalary
     *
     * @return string
     */
    public function getUsuSalary() {
        return $this->usuSalary;
    }

}
