<?php

namespace knx\ParametrizarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	public function InicioAction()
    {   
    	$breadcrumbs = $this->get("white_october_breadcrumbs");
    	$breadcrumbs->addItem("Inicio", $this->get("router")->generate("parametrizar_index"));
        
        return $this->render('ParametrizarBundle:Default:inicio.html.twig');
    }
    
    public function ContaAction()
    {
    	$breadcrumbs = $this->get("white_october_breadcrumbs");
    	$breadcrumbs->addItem("Inicio", $this->get("router")->generate("parametrizar_index"));
    	$breadcrumbs->addItem("Contabilidad");
    
    	return $this->render('ParametrizarBundle:Default:conta.html.twig');
    }

    public function ClienteAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Inicio", $this->get("router")->generate("parametrizar_index"));
        $breadcrumbs->addItem("Contabilidad");
    
        return $this->render('ParametrizarBundle:Default:cliente.html.twig');
    }

    public function ProveedorAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Inicio", $this->get("router")->generate("parametrizar_index"));
        $breadcrumbs->addItem("Contabilidad");
    
        return $this->render('ParametrizarBundle:Default:proveedor.html.twig');
    }
}