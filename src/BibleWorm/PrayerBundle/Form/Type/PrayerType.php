<?php

namespace BibleWorm\PrayerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PrayerType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('notes', 'textarea');
        $builder->add('resolution', 'textarea');
        $builder->add('isPublic', 'checkbox', array('label' => 'Share?'));
    }

    public function getName()
    {
        return 'prayer';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'BibleWorm\PrayerBundle\Entity\Prayer',
        );
    }
}