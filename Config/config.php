<?php
/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://Mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

return [
    'name'        => 'Mautic Sanitize Event',
    'description' => 'Updates contact name information to readable format.',
    'version'     => '1.0',
    'author'      => 'Alan Mosko',

    'services'    => [
        //Models Definition
        'models' => [
            'mautic.sanitizeevent.model.model' => [
                'class' => 'MauticPlugin\MauticSanitizeEventBundle\Model\SanitizeEventModel',
                'alias' => 'sanitizeevent.model',
            ],
        ],

        'forms'  => [
            'mautic.form.type.sanitizeevent_form_type' => [
                'class'     => 'MauticPlugin\MauticSanitizeEventBundle\Form\Type\FormSanitizeType',
                'arguments' => [
                    'mautic.model.factory',
                    'router',
                    'mautic.sanitizeevent.model.model',
                ],
                'alias'     => 'sanitizeevent_type_form',
            ],
            'mautic.form.type.spliteevent_form_type'   => [
                'class'     => 'MauticPlugin\MauticSanitizeEventBundle\Form\Type\FormSplitType',
                'arguments' => [
                    'mautic.model.factory',
                    'router',
                    'mautic.sanitizeevent.model.model',
                ],
                'alias'     => 'splitevent_type_form',
            ],
        ],

        'events' => [
            'mautic.sanitizeevent.event' => [
                'class'     => 'MauticPlugin\MauticSanitizeEventBundle\Events\SanitizeEvent',
                'arguments' => 'Mautic.factory',
            ],
        ],
    ],
];
