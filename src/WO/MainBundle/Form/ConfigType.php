<?php

namespace WO\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use WO\MainBundle\Entity\Config;

class ConfigType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offline')
            ->add('layout','choice', array(
                'choice_list' => new ChoiceList(array(Config::LAYOUT_SEMANTIC, Config::LAYOUT_BOOTSTRAP),
                                                array(Config::LAYOUT_SEMANTIC, Config::LAYOUT_BOOTSTRAP))))
            ->add('event_overwrite_protection')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WO\MainBundle\Entity\Config'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wo_mainbundle_config';
    }
}
