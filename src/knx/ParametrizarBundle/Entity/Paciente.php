<?php

namespace knx\ParametrizarBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * knx\ParametrizarBundle\Entity\Paciente
 *
 * @ORM\Table(name="paciente")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="knx\ParametrizarBundle\Entity\Repository\PacienteRepository")
 * @DoctrineAssert\UniqueEntity("email")
 */
 
class Paciente
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $tipoId
     * 
     * @ORM\Column(name="tipo_id", type="string", length=2, nullable=false)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     * @Assert\Choice(choices = {"MS","PA","CC", "RC", "TI", "CE", "NV", "AS"}, message = "Selecciona una opción valida.")
     *
     */
    private $tipoId;

    /**
     * @var string $identificacion
     * 
     * @ORM\Column(name="identificacion", type="string", length=13, unique=true)
     */
    private $identificacion;

    /**
     * @var string $priNombre
     * 
     * @ORM\Column(name="pri_nombre", type="string", length=30, nullable=false)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     * @Assert\Length(max=30)      
     */
    private $priNombre;

    /**
     * @var string $segNombre
     * 
     * @ORM\Column(name="seg_nombre", type="string", length=30, nullable=true)
     * @Assert\Length(max=30)
     *
     */
    private $segNombre;

    /**
     * @var string $priApellido
     * 
     * @ORM\Column(name="pri_apellido", type="string", length=30, nullable=false)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     * @Assert\Length(max=30)
     *
     */
    private $priApellido;

    /**
     * @var string $segApellido
     *
     * @ORM\Column(name="seg_apellido", type="string", length=30, nullable=true)
     * @Assert\Length(max=30)
     */
    private $segApellido;

    /**
     * @var date $fN
     * 
     * @ORM\Column(name="f_n", type="date", nullable=false)    
     */
    private $fN;

    /**
     * @var string $sexo
     * 
     * @ORM\Column(name="sexo", type="string", length=1, nullable=false)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     * @Assert\Choice(choices = {"M", "F"}, message = "Selecciona una opción valida.")
     */
    private $sexo;


     /**
     * @var string $estaCivil
     * 
     * @ORM\Column(name="esta_civil", type="string", length=15, nullable=false)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     * @Assert\Choice(choices = {"CASADO", "SOLTERO","UNION_LIBRE"}, message = "Selecciona una opción valida.")
     */
       private $estaCivil;


    /**
     * @var integer $mupio
     * 
     * @ORM\Column(name="depto", type="integer", nullable=false)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     *
     * 
     */
    private $depto;

    /**
     * @var integer $mupio
     * 
     * @ORM\Column(name="mupio", type="integer", nullable=false)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     */
    private $mupio;

    /**
     * @var string $direccion
     *
     * @ORM\Column(name="direccion", type="string", length=60, nullable=true)
     * @Assert\Length(max=60)
     */
    private $direccion;

    /**
     * @var string $zona
     *
     * @ORM\Column(name="zona", type="string", length=1, nullable=false)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     * @Assert\Choice(choices = {"U", "R"}, message = "Selecciona una opción valida.")
     *
     */
    private $zona;

    /**
     * @var string $telefono      
     * 
     * @ORM\Column(name="telefono", type="string", length=10, nullable=true)
     */
    private $telefono;

    /**
     * @var string $movil
     * 
     * @ORM\Column(name="movil", type="string", length=10, nullable=true)
     */
    private $movil;

    /**
     * @var string $email
     * 
     * @ORM\Column(name="email", type="string", length=200, nullable=true)
     * @Assert\Email(message = "El email '{{ value }}' no es valido.", checkMX = false)
     */
    private $email;      
    
     /**
     * @var string $tipoDes
     *
     * @ORM\Column(name="tipo_des", type="string", length=1, nullable=true) 
     * @Assert\Choice(choices = {"6", "7", "8"}, message = "Selecciona una opción valida.")
     */
     
     /*     
      6- Des.Contributivo
      7- Des.Subsidiado
      8- Des.Vinculado        
     */
     
    private $tipoDes;
    
     /**
     * @var string $pertEtnica
     *
     * @ORM\Column(name="pert_etnica", type="string", length=1, nullable=true)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     * @Assert\Choice(choices = { "1", "2", "3", "4", "5","6",}, message = "Selecciona una opción valida.")
     */     
     
     /*  1 - Indígena
         2 - ROM (gitano)
         3 - Raizal (archipieélago de San Andrés y Providencia)
         4 - Palanquero de San  Basilio
         5 - Negro(a), Mulato(a),Afrocolombiano(a) o Afrodescendiente
         6 - Ninguno de los anteriores
     */     

    private $pertEtnica;    
       
     /**
     * @var string $nivelEdu
     *
     * @ORM\Column(name="nivel_edu", type="string", length=15, nullable=true)
     * @Assert\NotBlank(message="El valor ingresado no puede estar vacio.")
     * @Assert\Choice(choices = {"1", "2", "3", "4", " 5", "6", "7", "8", "9", "10", "11", "12","13"}, message = "Selecciona una opci�n valida.")
     */
     
     /*
     1- No Definido
     2- Preescolar
     3- Basica Primaria
     4- Basica Secundaria(Bachillerato Basico)
     5- Media Academica o Clásica (Bachillerato Basico)
     6- Media Tecnica (Bachillerato Tecnico)
     7- Normalista
     8- Tecnica Profesional
     9- Tecnologica
     10- Profesional
     11- Especializacion
     12- Maestria
     13- Doctorado
     */

     
    private $nivelEdu;
    
    
    /**
     * @var Ocupacion
     *
     * @ORM\ManyToOne(targetEntity="knx\ParametrizarBundle\Entity\Ocupacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ocupacion_id", referencedColumnName="id" )
     * })
     **/    

    private $ocupacion;
    
     /**
     * @var date $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="date")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getEdad()
    {
    	list($Y,$m,$d) = explode("-",$this->getFN()->format('Y-m-d'));
    	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }

    /**
     * Set tipoId
     *
     * @param string $tipoId
     * @return Paciente
     */
    public function setTipoId($tipoId)
    {
        $this->tipoId = $tipoId;
    
        return $this;
    }

    /**
     * Get tipoId
     *
     * @return string 
     */
    public function getTipoId()
    {
        return $this->tipoId;
    }

    /**
     * Set identificacion
     *
     * @param string $identificacion
     * @return Paciente
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;
    
        return $this;
    }

    /**
     * Get identificacion
     *
     * @return string 
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set priNombre
     *
     * @param string $priNombre
     * @return Paciente
     */
    public function setPriNombre($priNombre)
    {
        $this->priNombre = $priNombre;
    
        return $this;
    }

    /**
     * Get priNombre
     *
     * @return string 
     */
    public function getPriNombre()
    {
        return $this->priNombre;
    }

    /**
     * Set segNombre
     *
     * @param string $segNombre
     * @return Paciente
     */
    public function setSegNombre($segNombre)
    {
        $this->segNombre = $segNombre;
    
        return $this;
    }

    /**
     * Get segNombre
     *
     * @return string 
     */
    public function getSegNombre()
    {
        return $this->segNombre;
    }

    /**
     * Set priApellido
     *
     * @param string $priApellido
     * @return Paciente
     */
    public function setPriApellido($priApellido)
    {
        $this->priApellido = $priApellido;
    
        return $this;
    }

    /**
     * Get priApellido
     *
     * @return string 
     */
    public function getPriApellido()
    {
        return $this->priApellido;
    }

    /**
     * Set segApellido
     *
     * @param string $segApellido
     * @return Paciente
     */
    public function setSegApellido($segApellido)
    {
        $this->segApellido = $segApellido;
    
        return $this;
    }

    /**
     * Get segApellido
     *
     * @return string 
     */
    public function getSegApellido()
    {
        return $this->segApellido;
    }

    /**
     * Set fN
     *
     * @param \Date $fN
     * @return Paciente
     */
    public function setFN($fN)
    {
        $this->fN = $fN;
    
        return $this;
    }

    /**
     * Get fN
     *
     * @return \Date 
     */
    public function getFN()
    {
        return $this->fN;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Paciente
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
     * Set estaCivil
     *
     * @param string $estaCivil
     * @return Paciente
     */
    public function setEstaCivil($estaCivil)
    {
        $this->estaCivil = $estaCivil;
    
        return $this;
    }

    /**
     * Get estaCivil
     *
     * @return string 
     */
    public function getEstaCivil()
    {
        return $this->estaCivil;
    }

    /**
     * Set depto
     *
     * @param integer $depto
     * @return Paciente
     */
    public function setDepto($depto)
    {
        $this->depto = $depto;
    
        return $this;
    }

    /**
     * Get depto
     *
     * @return integer 
     */
    public function getDepto()
    {
        return $this->depto;
    }

    /**
     * Set mupio
     *
     * @param integer $mupio
     * @return Paciente
     */
    public function setMupio($mupio)
    {
        $this->mupio = $mupio;
    
        return $this;
    }

    /**
     * Get mupio
     *
     * @return integer 
     */
    public function getMupio()
    {
        return $this->mupio;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Paciente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set zona
     *
     * @param string $zona
     * @return Paciente
     */
    public function setZona($zona)
    {
        $this->zona = $zona;
    
        return $this;
    }

    /**
     * Get zona
     *
     * @return string 
     */
    public function getZona()
    {
        return $this->zona;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Paciente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set movil
     *
     * @param string $movil
     * @return Paciente
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    
        return $this;
    }

    /**
     * Get movil
     *
     * @return string 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Paciente
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    } 

    /**
     * Set pertEtnica
     *
     * @param string $pertEtnica
     * @return Paciente
     */
    public function setPertEtnica($pertEtnica)
    {
        $this->pertEtnica = $pertEtnica;
    
        return $this;
    }

    /**
     * Get pertEtnica
     *
     * @return string 
     */
    public function getPertEtnica()
    {
        return $this->pertEtnica;
    }

    /**
     * Set nivelEdu
     *
     * @param string $nivelEdu
     * @return Paciente
     */
    public function setNivelEdu($nivelEdu)
    {
        $this->nivelEdu = $nivelEdu;
    
        return $this;
    }

    /**
     * Get nivelEdu
     *
     * @return string 
     */
    public function getNivelEdu()
    {
        return $this->nivelEdu;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Paciente
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Paciente
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set ocupacion
     *
     * @param \knx\ParametrizarBundle\Entity\Ocupacion $ocupacion
     * @return Paciente
     */
    public function setOcupacion(\knx\ParametrizarBundle\Entity\Ocupacion $ocupacion = null)
    {
        $this->ocupacion = $ocupacion;
    
        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return \knx\ParametrizarBundle\Entity\Ocupacion 
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set tipoDes
     *
     * @param string $tipoDes
     * @return Paciente
     */
    public function setTipoDes($tipoDes)
    {
        $this->tipoDes = $tipoDes;
    
        return $this;
    }

    /**
     * Get tipoDes
     *
     * @return string 
     */
    public function getTipoDes()
    {
        return $this->tipoDes;
    }
    
    // optine la pertenencia etnica para ser visualizada en las plantillas 
    public function getPE($i)
    {
    	$pe = array(
					'' => 'NO ASIGNADO',
					'1' => 'Indígena',
					'2' => 'ROM (gitano)',
					'3' => 'Raizal (archipiélago de San Andrés y Providencia)',
					'4' => 'Palanquero de San  Basilio',
					'5' => 'Negro(a), Mulato(a),Afrocolombiano(a) o Afrodescendiente',
					'6' => 'Ninguno de los anteriores',
					);
    	return $pe[$i];
    }
    // nivel educativo
    public function getNE($i)
    {
    	$ne = array('' => 'NO ASIGNADO',
					'1' => 'No Definido',
					'2' => 'Preescolar',
					'3' => 'Basica Primaria',
					'4' => 'Basica Secundaria(Bachillerato Basico)',
					'5' => 'Media Academica o Clásica (Bachillerato Basico)',
					'6' => 'Media Tecnica (Bachillerato Tecnico)',
					'7' => 'Normalista',
					'8' => 'Tecnica Profesional',
					'9' => 'Tecnologica',
					'10' => 'Profesional',
					'11' => 'Especializacion',
					'12' => 'Maestria',
					'13' => 'Doctorado', 
					);
    	return $ne[$i];    	
    }
    // tipo desplazado
    public function getTD($i)
    {
    	$td = array('' => 'NO ASIGNADO',
 					'6' => 'Des.Contributivo',
 					'7' => 'Des.Subsidiado',
 					'8' => 'Des.Vinculado',
 				);
    	
    	return $td[$i];
    }
}