<?php

namespace knx\ParametrizarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * knx\ParametrizarBundle\Entity\CargoPyp
 * @ORM\Table(name="cargo_pyp")
 * @ORM\Entity
 */
class CargoPyp
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="knx\ParametrizarBundle\Entity\Cargo")
     */
    private $cargo;


     /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="knx\ParametrizarBundle\Entity\Pyp")
     */
    private $pyp;

     /**
     * @var edadIni
     *
     * @ORM\Column(name="edad_ini", type="integer", nullable=true)
     */
        private $edadIni;

     /**
     * @var edadFin
     *
     * @ORM\Column(name="edad_fin", type="integer", nullable=true)
     */
        private $edadFin;

     /**
     * @var rango
     *
     * @ORM\Column(name="rango", type="string", length=200, nullable=true)
     * @Assert\Choice(choices = {"1", "2", "3"}, message = "Selecciona un rango valido.")
     */
        private $rango;

     /**
     * @var sexo
     *
     * @ORM\Column(name="sexo", type="string", nullable=false)
     * @Assert\Choice(choices = {"M", "F","A"}, message = "Selecciona una opción valida.")
     */
        private $sexo;


        /**
         * @var string $tipoCons
         *
         * @ORM\Column(name="tipo_cons", type="string", length=2, nullable=true)
         */

        private $tipoCons;

        /**
         * @var integer $tipoProc
         *
         * @ORM\Column(name="tipoProc", type="integer", length=1, nullable=true)
         */

        private $tipoProc;

    /**
     * Set edadIni
     *
     * @param integer $edadIni
     * @return CargoPyp
     */
    public function setEdadIni($edadIni)
    {
        $this->edadIni = $edadIni;

        return $this;
    }

    /**
     * Get edadIni
     *
     * @return integer
     */
    public function getEdadIni()
    {
        return $this->edadIni;
    }

    /**
     * Set edadFin
     *
     * @param integer $edadFin
     * @return CargoPyp
     */
    public function setEdadFin($edadFin)
    {
        $this->edadFin = $edadFin;

        return $this;
    }

    /**
     * Get edadFin
     *
     * @return integer
     */
    public function getEdadFin()
    {
        return $this->edadFin;
    }

    /**
     * Set rango
     *
     * @param string $rango
     * @return CargoPyp
     */
    public function setRango($rango)
    {
        $this->rango = $rango;

        return $this;
    }

    /**
     * Get rango
     *
     * @return string
     */
    public function getRango()
    {
        return $this->rango;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return CargoPyp
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set cargo
     *
     * @param \knx\ParametrizarBundle\Entity\Cargo $cargo
     * @return CargoPyp
     */
    public function setCargo(\knx\ParametrizarBundle\Entity\Cargo $cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return \knx\ParametrizarBundle\Entity\Cargo
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set pyp
     *
     * @param \knx\ParametrizarBundle\Entity\Pyp $pyp
     * @return CargoPyp
     */
    public function setPyp(\knx\ParametrizarBundle\Entity\Pyp $pyp)
    {
        $this->pyp = $pyp;

        return $this;
    }

    /**
     * Get pyp
     *
     * @return \knx\ParametrizarBundle\Entity\Pyp
     */
    public function getPyp()
    {
        return $this->pyp;
    }

    /**
     * Set tipoCons
     *
     * @param string $tipoCons
     * @return Cargo
     */
    public function setTipoCons($tipoCons)
    {
    	$this->tipoCons = $tipoCons;

    	return $this;
    }

    /**
     * Get tipoCons
     *
     * @return string
     */
    public function getTipoCons()
    {
    	return $this->tipoCons;
    }

    /**
     * Set tipoProc
     *
     * @param integer $tipoProc
     * @return Cargo
     */
    public function setTipoProc($tipoProc)
    {
    	$this->tipoProc = $tipoProc;

    	return $this;
    }

    /**
     * Get tipoProc
     *
     * @return integer
     */
    public function getTipoProc()
    {
    	return $this->tipoProc;
    }

}