<?php
/**
 * Airtable plugin for Craft CMS
 *
 * Airtable Variable
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Airtable
 * @since     1.0.0
 */

namespace Craft;

class AirtableVariable
{
    /**
     */
    public function findRecords ($criteria = [ ])
    {
        return craft()->airtable->findRecords($criteria);
    }
}