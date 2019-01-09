<?php
namespace MauticPlugin\MauticSanitizeEventBundle\Events;

use MauticPlugin\MauticSanitizeEventBundle\MauticSanitizeEventEvents;
use Mautic\CampaignBundle\CampaignEvents;
use Mautic\CampaignBundle\Event\CampaignBuilderEvent;
use Mautic\CampaignBundle\Event\CampaignExecutionEvent;
use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\CoreBundle\Factory\MauticFactory;

class SanitizeEvent extends CommonSubscriber
{
    protected $factory;
    /**
     * CampaignSubscriber constructor.
     *
     * @param MauticFactory $factory
     */
    public function __construct(MauticFactory $factory)
    {
        $this->factory = $factory;
    }

    /** Reescreve o metodo da classe CommonSubscriber
     * Retorna a lista de eventos que esta classe vai registrar.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            CampaignEvents::CAMPAIGN_ON_BUILD        => ['onCampaignBuild', 0],
            MauticSanitizeEventEvents::SanitizeEvent => ['executeCampaignActionSanitize', 0],
            MauticSanitizeEventEvents::SplitEvent    => ['executeCampaignActionSplit', 0],
        ];
    }

    /**
     * @param CampaignBuilderEvent $event
     */
    public function onCampaignBuild(CampaignBuilderEvent $event)
    {
        // Register custom action
        $event->addAction(
            'sanitizeevent.action',
            [
                'label'       => 'plugin.sanitizeevent.campaign.sanitize.label',
                'eventName'   => MauticSanitizeEventEvents::SanitizeEvent,
                'description' => 'plugin.sanitizeevent.campaign.sanitize.desc',
                // Set custom parameters to configure the decision
                'formType'    => 'sanitizeevent_type_form',
                // Set a custom formTheme to customize the layout of elements in formType
                //'formTheme'       => 'HelloWorldBundle:FormTheme\SubmitAction',
                // Set custom options to pass to the form type, if applicable
                //'formTypeOptions' => array(
                //    'even.loc.model.business' => 'mars'
                //)
            ]
        );

        $event->addAction(
            'splitevent.action',
            [
                'label'       => 'plugin.sanitizeevent.campaign.split.label',
                'eventName'   => MauticSanitizeEventEvents::SplitEvent,
                'description' => 'plugin.sanitizeevent.campaign.split.desc',
                // Set custom parameters to configure the decision
                'formType'    => 'splitevent_type_form',
                // Set a custom formTheme to customize the layout of elements in formType
                //'formTheme'       => 'HelloWorldBundle:FormTheme\SubmitAction',
                // Set custom options to pass to the form type, if applicable
                //'formTypeOptions' => array(
                //    'even.loc.model.business' => 'mars'
                //)
            ]
        );
    }

    /**
     * Execute campaign action.
     *
     * @param CampaignExecutionEvent $event
     */
    public function executeCampaignActionSanitize(CampaignExecutionEvent $event)
    {
        $lead = $event->getLead();

        $config = $event->getConfig();

        $model = $this->factory->getModel('sanitizeevent.model');
        $res = $model->sanitizeContact($lead, $config['properties']);

        $event->setResult($res);
    }

    public function executeCampaignActionSplit(CampaignExecutionEvent $event)
    {
        $lead = $event->getLead();

        $config = $event->getConfig();

        $model = $this->factory->getModel('sanitizeevent.model');
        $res = $model->splitContact($lead, $config['properties']);

        $event->setResult($res);
    }
}
