<?php

namespace knx\FarmaciaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class TrasladoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

             ->add('imv', 		'text',  array('required' => true, 'label' => 'Imv: *','disabled'=> true,'attr'=>array('class'=>'input-xxlarge')))


        ->add('tipo', 		  'choice', array('empty_value' => 'Selecione tipo','label' => 'Tipo: *',			'choices'   => array('D' => 'Devolucion', 'T' => 'Traslado'),'required'  => true))
        ->add('farmacia', 		'entity', array(
        		'class' => 'knx\\FarmaciaBundle\\Entity\\Farmacia',
        		'required' => true,'label' => 'Farmacia Destino:',
        		'empty_value' => 'Selecciona una Farmacia',
        		'query_builder' => function(EntityRepository $repositorio) {
        			return $repositorio->createQueryBuilder('s')
        			->where('s.estado = :estado ' )
        			->orderBy('s.nombre', 'ASC')
        			->setParameters(array('estado' => 'A'));}
        ))
           	 ->add('cant',	'integer',  array('required' => true, 'label' => 'Cantidad: *', 'attr' => array('placeholder' => 'cantidad')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'knx\FarmaciaBundle\Entity\Traslado'
        ));
    }

    public function getName()
    {
        return 'newTrasladoType';
    }
}
