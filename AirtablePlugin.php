<?php
/**
 * Airtable plugin for Craft CMS
 *
 * Sweet saving and fetching of data with Airtable
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Airtable
 * @since     1.0.0
 */

namespace Craft;

class AirtablePlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init ()
    {
        parent::init();

        require_once __DIR__ . '/vendor/autoload.php';
    }

    /**
     * @return mixed
     */
    public function getName ()
    {
        return Craft::t('Airtable');
    }

    /**
     * @return mixed
     */
    public function getDescription ()
    {
        return Craft::t('Sweet saving and fetching of data with Airtable');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl ()
    {
        return 'https://github.com/sjelfull/airtable/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl ()
    {
        return 'https://raw.githubusercontent.com/sjelfull/airtable/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion ()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion ()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper ()
    {
        return 'Superbig';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl ()
    {
        return 'https://superbig.co';
    }

    /**
     * @return mixed
     */
    public function getSettingsHtml ()
    {
        return craft()->templates->render('airtable/Airtable_Settings', array(
            'settings' => $this->getSettings()
        ));
    }

}