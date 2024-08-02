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
                    new NotBlank(),
                ],
            ]);

        return $this;
    }
}
