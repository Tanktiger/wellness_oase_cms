<?php

namespace WO\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServiceCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dir = 'bundles/wo/images/category';
        $fulldir = "{$_SERVER['DOCUMENT_ROOT']}/$dir";
        $d = @dir($fulldir);
        $files = array(null);
        $thumbs = array(null);
        if ($d) {
            while(false !== ($entry = @$d->read()))
            {
                if ($entry != '.' && $entry != '..') {
                    $files[] = "http://{$_SERVER['HTTP_HOST']}/$dir/$entry";
                    $thumbs[] = "http://{$_SERVER['HTTP_HOST']}/$dir/thumbs/$entry";
                }
            }
            $d->close();
        }
        $builder
            ->add('name', null, array('label' => 'Name'))
            ->add('slug', null, array('label' => 'Slug'))
            ->add('description', null, array('label' => 'Beschreibung'))
            ->add('image', 'choice',  array(
                'choice_list' => new ChoiceList($files, $files),
                'label' => 'Angebotsbild auf Seite'
                ))
            ->add('thumbnail', 'choice',  array(
                'choice_list' => new ChoiceList($thumbs, $thumbs),
                'label' => 'Bild auf Kategorienübersicht'
            ))
            ->add('position', null, array('label' => 'Position auf Webseite'))
            ->add('show_online', null, array('label' => 'Sichtbar auf Webseite'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WO\MainBundle\Entity\ServiceCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wo_mainbundle_servicecategory';
    }
}
