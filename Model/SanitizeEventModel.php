<?php

namespace MauticPlugin\MauticSanitizeEventBundle\Model;

use Mautic\CoreBundle\Model\FormModel;

class SanitizeEventModel extends FormModel
{
    public function sanitizeContact($lead, $options)
    {
        $leadModel = $this->factory->getModel('lead');

        if (isset($options['sanitize']) && $options['sanitize'] == 'yes') {
            $leadModel->setFieldValues($lead, [
                'firstname' => ucwords(strtolower($lead->firstname)),
                'lastname'  => ucwords(strtolower($lead->lastname)),
            ], false);

            $leadModel->saveEntity($lead);
        }

        return true;
    }

    public function splitContact($lead, $options)
    {
        $leadModel = $this->factory->getModel('lead');

        if (isset($options['split']) && $options['split'] == 'yes') {
            $name = ltrim($lead->firstname . ' ' . $lead->lastname);

            $firstname = explode(' ', $name)[0];
            $lastname = array_reverse(explode(' ', $name, 2))[0];

            $leadModel->setFieldValues($lead, [
                'firstname' => $firstname,
                'lastname'  => $lastname,
            ], false);

            $leadModel->saveEntity($lead);
        }

        return true;
    }
}
