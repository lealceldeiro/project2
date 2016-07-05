<?php

namespace P2\Bundle\RoleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', null, array(
                'label_attr' => array(
                    'class' => 'control-label col-sm-2 margin-top-more',
                     'for' => 'p2_bundle_rolebundle_role_label'
                     ),
                'attr' => array(
                    'class' => 'form-control input-short',
                    'placeholder' => 'required',
                    ),
                )
            )
            ->add('description', null, array(
                'label_attr' => array(
                    'class' => 'control-label col-sm-2 margin-top-more',
                    'for' => 'p2_bundle_rolebundle_role_description'
                    ),
                'attr' => array(
                    'class' => 'form-control input-short',
                    ),
                'required' => false
                )
            )
            ->add('active', null, array(
                'required' => false
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'P2\Bundle\RoleBundle\Entity\Role'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'p2_bundle_rolebundle_role';
    }
}
