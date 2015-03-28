<?php

namespace WO\OrganizerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day', 'datetime', array(
//                'read_only' => true,
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'with_seconds' => true,
                'label' => 'Tag',
                'seconds' => array(0)))
            ->add('dateStart', 'datetime', array('date_widget' => 'single_text',
                                                'time_widget' => 'choice',
                                                'with_seconds' => true,
                                                'seconds' => array(0),
                                                'minutes' => array(0,30),
                                                'hours' => range(8,20,1),
                                                'date_format' => 'yyyy-MM-dd',
                                                'label' => 'Anfang'))
            ->add('dateEnd', 'datetime', array('date_widget' => 'single_text',
                                                'time_widget' => 'choice',
                                                'with_seconds' => true,
                                                'seconds' => array(0),
                                                'minutes' => array(0,30),
                                                'hours' => range(8,20,1),
                                                'date_format' => 'yyyy-MM-dd',
                                                'label' => 'Ende'))
            ->add('customer', null, array('label' => 'Kunde'))
            ->add('info', null, array('label' => 'Anwendung'))
            ->add('extrainfo', null, array('label' => 'Zusätzliche Info'))
            ->add('price', null, array('label' => 'Preis'))
            ->add('paymentmethod', null, array('label' => 'Bezahlmethode'))
            ->add('employee', null, array('label' => 'Mitarbeiter'))
            ->add('location', null, array('label' => 'Ort', 'read_only' => true))
            ->add('canceled', null, array('label' => 'Abgesagt'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WO\OrganizerBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wo_organizerbundle_event';
    }
}
