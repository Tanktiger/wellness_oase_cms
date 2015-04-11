<?php

namespace WO\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OfferType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offerStart', 'datetime', array(
                'attr' => array('class' => 'datepicker'),
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'with_seconds' => true,
                'label' => 'Anfang',
                'seconds' => array(0)))
            ->add('offerEnd', 'datetime', array(
//                'read_only' => true,
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'with_seconds' => true,
                'label' => 'Ende',
                'seconds' => array(0)))
            ->add('service', null, array('label' => 'Anwendung'))
            ->add('offerPrice', null, array('label' => 'Neuer Preis'))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WO\MainBundle\Entity\Offer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wo_mainbundle_offer';
    }
}
