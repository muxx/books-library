<?php

namespace Intaro\BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BookType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('author')
            ->add('cover')
            ->add('read_at')
            ->add('filename')
        ;
    }

    public function getName()
    {
        return 'intaro_bookbundle_booktype';
    }
}
