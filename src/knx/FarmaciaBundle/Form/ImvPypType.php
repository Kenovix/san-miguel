<?php

namespace knx\FarmaciaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ImvPypType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('imv', 'entity', array('class' => 'knx\\FarmaciaBundle\\Entity\\Imv','required' => true,'label' => 'Imv:',
        		'empty_value' => 'Selecciona un Imv','attr'=>array('class'=>'input-xxlarge'),
        		'query_builder' => function(EntityRepository $repositorio) {
        			return $repositorio->createQueryBuilder('s')
        			->where('s.tipoImv = :tipo Or s.tipoImv = :tipo1' )
        			->orderBy('s.nombre', 'ASC')
        			->setParameters(array('tipo' => 'V','tipo1' => 'MP'));}

        ))

        ->add('pyp', 			'entity', array('class' => 'knx\\ParametrizarBundle\\Entity\\Pyp','required' => true,'label' => 'Categoria:',
        		'empty_value' => 'Selecciona una categoria',
        		'query_builder' => function(EntityRepository $repositorio) {
        			return $repositorio->createQueryBuilder('s')
        			->orderBy('s.nombre', 'ASC');}
        ))
            ->add('edadini',	'integer', array('required' => false, 'label' => 'Edad Inicio', 'attr' => array('placeholder' => 'Inicio')))
            ->add('edadfin',	'integer', array('required' => false, 'label' => 'Edad Final', 'attr' => array('placeholder' => 'Fin')))
            ->add('rango',		'text', array('required' => false, 'label' => 'Rango', 'attr' => array('placeholder' => 'Numero')))
            ->add('sexo',		'choice',  array('choices'  => array('empty_value' => 'Selecciona Sexo','M' => 'Masculino', 'F' => 'Femenino','A' => 'Ambos'), 'label'=>'Sexo','required'  => true))
            ->add('tipoProc', 'choice', array('label' => 'Finalidad procedimiento:',  'choices' => array( '3' => 'protección especifica')))


        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'knx\FarmaciaBundle\Entity\ImvPyp'
        ));
    }

    public function getName()
    {
        return 'newImvPypType';
    }
}
