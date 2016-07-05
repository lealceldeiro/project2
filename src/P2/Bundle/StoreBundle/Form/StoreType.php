<?php

namespace P2\Bundle\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label_attr' => array(
                    'class' => 'control-label col-sm-2 margin-top-more',
                    'for' => 'p2_bundle_storebundle_store_name'
                    ),
                'attr' => array(
                    'class' => 'form-control input-short',
                    'placeholder' => 'required',
                    ),
                    )
                )
            ->add('storeUser', null, array(
                'label_attr' => array(
                    'class' => 'control-label col-sm-2 margin-top-more',
                    'for' => 'p2_bundle_storebundle_store_storeUser'
                    ),
                'attr' => array(
                    'class' => 'form-control input-short',
                    'id'=> 'store_user',
                    'placeholder' => 'required',
                    ),
                    )
                )
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Passwords must match',
                'first_options' => array(
                    'label' => 'Password',
                    'label_attr' => array(
                        'class' => 'control-label col-sm-2 margin-top-more',
                         'for' => 'p2_bundle_storebundle_store_password_first'
                            ),
                    'attr' => array(
                        'class' => 'form-control input-short',
                        'placeholder' => 'required',
                            ),
                        ),
                'second_options' => array(
                    'label' => 'Password again',
                    'label_attr' => array(
                        'class' => 'control-label col-sm-2 margin-top-more',
                        'for' => 'p2_bundle_storebundle_store_password_second'
                        ),
                    'attr' => array(
                        'class' => 'form-control input-short margin-top-more',
                        'placeholder' => 'required',
                        ),
                    ),
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
            'data_class' => 'P2\Bundle\StoreBundle\Entity\Store'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'p2_bundle_storebundle_store';
    }
}
