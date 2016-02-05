<?php

namespace knx\FarmaciaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DevolucionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imv', 		'entity', array(
            		'class' => 'knx\\FarmaciaBundle\\Entity\\Imv',
            		'required' => true,'attr'=>array('class'=>'input-xxlarge'),
            		'empty_value' => 'Selecciona un Imv',
            		'query_builder' => function(EntityRepository $repositorio) {
            			return $repositorio->createQueryBuilder('s')
            			->orderBy('s.nombre', 'ASC');}
            ))



            ->add('proveedor', 		'entity', array(
            		'class' => 'knx\\ParametrizarBundle\\Entity\\Proveedor',
            		'required' => true,
            		'empty_value' => 'Selecciona un Proveedor',
            		'query_builder' => function(EntityRepository $repositorio) {
            			return $repositorio->createQueryBuilder('s')
            			->orderBy('s.nombre', 'ASC');}
            ))

            ->add('almacen', 		'entity', array(
            		'class' => 'knx\\ParametrizarBundle\\Entity\\Almacen',
            		'required' => true,
            		'empty_value' => 'Selecciona un Almacen',
            		'query_builder' => function(EntityRepository $repositorio) {
            			return $repositorio->createQueryBuilder('s')
            			->orderBy('s.nombre', 'ASC');}
            ))


            ->add('cant',	'integer', 	array('label' => 'Cantidad: *', 'attr' => array('placeholder' => 'Cantidad', 'autofocus'=>'autofocus')))
            ->add('motivo',	'text', 	array('label' => 'Motivo: *',   'attr' => array('placeholder' => 'Ingrese un motivo')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'knx\FarmaciaBundle\Entity\Devolucion'
        ));
    }

    public function getName()
    {
        return 'newDevolucionType';
    }
}
