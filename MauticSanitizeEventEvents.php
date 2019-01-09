<?php
/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://Mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSanitizeEventBundle;

/**
 * Class LeadEvents
 * Events available for LeadBundle.
 */
final class MauticSanitizeEventEvents
{
    /**
     * The Mautic.lead_pre_save event is dispatched right before a lead is persisted.
     *
     * The event listener receives a
     * Mautic\LeadBundle\Event\LeadEvent instance.
     *
     * @var string
     */
    const SanitizeEvent = 'Mautic.sanitizeevent.event';
    const SplitEvent = 'Mautic.splitevent.event';

}
