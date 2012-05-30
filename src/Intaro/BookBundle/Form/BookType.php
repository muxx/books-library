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
            ->add('allow_download')
            ->add('read_at', null, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('cover_file')
            ->add('book_file')
        ;
    }

    public function getName()
    {
        return 'book';
    }
}
