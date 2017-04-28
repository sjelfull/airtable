<?php
/**
 * Airtable plugin for Craft CMS
 *
 * Airtable Model
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Airtable
 * @since     1.0.0
 */

namespace Craft;

class AirtableModel extends BaseModel
{
    /**
     * @return array
     */
    protected function defineAttributes ()
    {
        $fields        = craft()->config->get('allowedFields', 'airtable');
        $definedFields = [ ];

        foreach ($fields as $key) {
            $definedFields[ $key ] = [ AttributeType::String, 'default' => '' ];
        }

        return array_merge(parent::defineAttributes(), $definedFields);
    }

}