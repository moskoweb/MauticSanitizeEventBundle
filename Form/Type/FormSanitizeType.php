<?php
/*
 * @copyright   2016 Mautic Contributors. All rights reserved
 * @author      Mautic
 * @link        http://Mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSanitizeEventBundle\Form\Type;

use MauticPlugin\MauticSanitizeEventBundle\Model\SanitizeEventModel;
use Mautic\CoreBundle\Factory\ModelFactory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class FormFieldSelectType.
 */
class FormSanitizeType extends AbstractType
{
    protected $SanitizeEventModel;

    public function __construct(ModelFactory $modelFactory, RouterInterface $router, SanitizeEventModel $SanitizeEventModel)
    {
        $this->SanitizeEventModel = $SanitizeEventModel;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\Validator\Exception\ConstraintDefinitionException
     * @throws \Symfony\Component\Validator\Exception\InvalidOptionsException
     * @throws \Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'sanitize',
            'choice',
            [
                'choices'     => [
                    'yes' => 'plugin.sanitizeevent.form.yes',
                    'no'  => 'plugin.sanitizeevent.form.no',
                ],
                'label'       => 'plugin.sanitizeevent.form.sanitize.label',
                'label_attr'  => ['class' => 'control-label'],
                'attr'        => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(
                        [
                            'message' => 'plugin.sanitizeevent.form.required',
                        ]
                    ),
                ],
            ]
        );
    }

    /**
     * return alias name of form in config.php
     */
    public function getName()
    {
        return 'sanitizeevent_type_form';
    }
}
