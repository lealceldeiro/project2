<?php

namespace P2\Bundle\UserBundle\Form;

use P2\Bundle\UserBundle\Form\Type\AddressTransformer;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdministratorType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
      $this->entityManager = $entityManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array(
                'label_attr' => array(
                    'class' => 'control-label col-sm-2',
                    'for' => 'p2_bundle_userbundle_administrator_username'
                    ),
                'attr' => array(
                    'class' => 'form-control input-short pull-right',
                    'placeholder' => 'required',
                    ),
                )
            )
            ->add('firstName', null, array(
                'label_attr' => array(
                    'class' => 'control-label col-sm-2',
                     'for' => 'p2_bundle_userbundle_administrator_firstName'
                    ),
                'label' => 'Firstname',
                'attr' => array(
                    'class' => 'form-control input-short pull-right',
                    'placeholder' => 'required',
                    ),
                )
            )
            ->add('middleName', null, array(
                'label_attr' => array(
                    'class' => 'control-label col-sm-2',
                    'for' => 'p2_bundle_userbundle_administrator_middleName'
                    ),
                'label' => 'Middlename',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control input-short pull-right',
                    ),
                )
            )
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Passwords must match',
                'first_options' => array(
                    'label' => 'Password',
                     'label_attr' => array(
                        'class' => 'control-label col-sm-2',
                        'for' => 'p2_bundle_userbundle_administrator_password_first'),
                    'attr' => array(
                    'class' => 'form-control input-short pull-right',
                    'placeholder' => 'required',
                    ),
                ),
                'second_options' => array(
                    'label' => 'Password again',
                     'label_attr' => array(
                        'class' => 'control-label col-sm-2',
                        'for' => 'p2_bundle_userbundle_administrator_password_second'),
                    'attr' => array(
                    'class' => 'form-control input-short pull-right',
                    'placeholder' => 'required',
                    ),
                ),
            ))
            ->add('lastname', null, array(
                'label_attr' => array(
                    'class' => 'control-label col-sm-2',
                    'for' => 'p2_bundle_userbundle_administrator_lastname'),
                'attr' => array(
                    'class' => 'form-control input-short pull-right',
                    'placeholder' => 'required',
                    ),
            ))
            ->add('dni', null, array(
                'label' => 'DNI',
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label col-sm-2',
                    'for' => 'p2_bundle_userbundle_administrator_dni'
                    ),
                'attr' => array(
                    'class' => 'form-control input-short pull-right',
                    ),
                ))
            ->add('dateOfBirth', null, array(
                'label' => 'Born',
                'required' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array(
                    'class' => 'datepicker input-inline form-control input-short pull-right',
                    'data-provide' => 'datepicker','data-date-format' => 'yyyy-MM-dd',
                    'placeholder' => 'yyyy-Month-dd'
                    ),
                'label_attr' => array(
                   'class' => 'control-label col-sm-2',
                   'for' => 'p2_bundle_userbundle_administrator_dateOfBirth'
                    )
                )
            )
            ->add('email', 'email', array(
                'label_attr' => array(
                    'class' => 'control-label col-sm-2',
                    'for' => 'p2_bundle_userbundle_administrator_email'
                    ),
                'attr' => array(
                    'class' => 'form-control input-short pull-right',
                    'placeholder' => 'required',
                    ),
                ))
            ->add('pictureFile', null, array(
                'data_class' => null,
                 'label' => 'Picture',
                  'required' => false,
                   'label_attr' => array(
                    'class' => 'control-label col-sm-2',
                    'for' => 'p2_bundle_userbundle_administrator_pictureRoute'
                    ),
                'attr' => array(
                    'class' => 'input-short pull-right',
                    ),
                )
            )
            ->add('active', null, array(
                'required' => false
                )
            )
            ->add('roles', null, array(
                'required' => false,
                'label_attr' => array(
                    'class' => 'control-label col-sm-2',
                     'for' => 'p2_bundle_userbundle_administrator_roles'
                     ),
                'attr' => array(
                    'class' => 'margin-right-more form-control input-short pull-right',
                    )
                )
            )
            ->add('address', 'textarea', array(
                'required' => false, 
                'label_attr' => array(
                    'class' => 'control-label col-sm-2 ',
                     'for' => 'p2_bundle_userbundle_administrator_address'
                     ),
                'attr' => array(
                    'class' => 'form-control input-short pull-right',
                    'placeholder' => 'Street House_Number, Avenue, Town, State_or_Province, Country',
                    'autocomplete' => 'off'
                    )
                )
            );
            //trasformer for address, needeed for autocompletion using ajax
        $builder->get('address')->addModelTransformer(new AddressTransformer($this->entityManager));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'P2\Bundle\UserBundle\Entity\Administrator'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'p2_bundle_userbundle_administrator';
    }
}
