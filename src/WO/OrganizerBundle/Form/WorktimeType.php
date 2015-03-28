<?php

namespace WO\OrganizerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WorktimeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('date', null, array('label' => 'Tag'))
            ->add('date', 'date', array('read_only' => true,
                'widget' => 'single_text',
                'label' => 'Tag'))
            ->add('timerange', null, array('label' => 'Arbeitszeit'))
            ->add('employee', null, array('label' => 'Mitarbeiter', 'read_only' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WO\OrganizerBundle\Entity\Worktime'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wo_organizerbundle_worktime';
    }
}
