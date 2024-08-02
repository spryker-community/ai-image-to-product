<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AIImageToProductGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints\Valid;
use Propel\Runtime\ActiveQuery\Criteria;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Spryker\Zed\ProductManagement\Communication\Form\Validator\Constraints\SkuRegex;

/**
 * @method \Pyz\Zed\AIImageToProductGui\AIImageToProductGuiConfig getConfig()
 * @method \Pyz\Zed\AIImageToProductGui\Communication\AIImageToProductGuiCommunicationFactory getFactory()
 * @method \Pyz\Zed\AIImageToProductGui\Business\AIImageToProductGuiFacadeInterface getFacade()
 */
class AIProductForm extends AbstractType
{
    /**
     * @var string
     */
    public const FIELD_SKU = 'sku';

    /**
     * @var string
     */
    public const FIELD_IMAGE = 'image';

    /**
     * @var string
     */
    public const VALIDATION_GROUP_UNIQUE_SKU = 'validation_group_unique_sku';

    /**
     * @var string
     */
    public const FIELD_ID_PRODUCT_ABSTRACT = 'id_product_abstract';

    /**
     * @return array
     */
    protected function getValidationGroups()
    {
        return [
            Constraint::DEFAULT_GROUP,
            static::VALIDATION_GROUP_UNIQUE_SKU,
        ];
    }

     /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $this->setDefaults($resolver);
    }


     /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    protected function setDefaults(OptionsResolver $resolver)
    {
        $validationGroups = $this->getValidationGroups();

        $resolver->setDefaults([
            'constraints' => new Valid(),
            'required' => false,
            'validation_groups' => function (FormInterface $form) use ($validationGroups) {
                $validationGroups = $this->prepareDefaultsValidationGroups($validationGroups, $form);

                return $validationGroups;
            },
            'compound' => true,
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this
            ->addSkuField($builder)
            ->addImageField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addImageField(FormBuilderInterface $builder)
    {
        $builder
        ->add(static::FIELD_IMAGE, TextType::class, [
            'label' => 'Image Link',
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addSkuField(FormBuilderInterface $builder)
    {
        $builder
            ->add(static::FIELD_SKU, TextType::class, [
                'label' => 'SKU Prefix',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'groups' => [static::VALIDATION_GROUP_UNIQUE_SKU],
                    ]),
                    new SkuRegex([
                        'groups' => [static::VALIDATION_GROUP_UNIQUE_SKU],
                    ]),
                    new Callback([
                        'callback' => function ($sku, ExecutionContextInterface $context) {
                            // $form = $context->getRoot();
                            // $idProductAbstract = $form->get(self::FIELD_ID_PRODUCT_ABSTRACT)->getData();

                            $skuCount = $this->getFactory()->getProductQueryContainer()
                                ->queryProduct()
                                ->filterBySku($sku)
                                ->_or()
                                ->useSpyProductAbstractQuery()
                                    ->filterBySku($sku)
                                ->endUse()
                                ->count();

                            if ($skuCount > 0) {
                                $context->addViolation(
                                    sprintf('The SKU "%s" is already used', $sku),
                                );
                            }
                        },
                        'groups' => [static::VALIDATION_GROUP_UNIQUE_SKU],
                    ]),
                ],
            ]);

        return $this;
    }

     /**
     * @param array $validationGroups
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return array
     */
    protected function prepareDefaultsValidationGroups(array $validationGroups, FormInterface $form): array
    {
        return $validationGroups;
    }
}
