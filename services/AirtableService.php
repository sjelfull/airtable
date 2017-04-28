<?php
/**
 * Airtable plugin for Craft CMS
 *
 * Airtable Service
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Airtable
 * @since     1.0.0
 */

namespace Craft;

use Armetiz\AirtableSDK\Airtable;

class AirtableService extends BaseApplicationComponent
{
    protected $client;
    protected $table;
    protected $base;

    public function init ()
    {
        parent::init();

        $key          = craft()->config->get('apiKey', 'airtable');
        $this->base   = craft()->config->get('base', 'airtable');
        $this->table  = craft()->config->get('table', 'airtable');
        $this->client = new Airtable($key, $this->base);
    }

    public function filteredInput ()
    {
        // Get fields
        $fields = craft()->config->get('allowedFields', 'airtable');
        $data   = [ ];

        foreach ($fields as $key) {
            $value = craft()->request->getParam($key);

            if ( empty($value) ) {
                continue;
            }

            $data[ $key ] = $value;
        }

        return $data;
    }

    public function saveOrUpdate ($data, $id = null)
    {
        $criteria = [ ];

        if ( !empty($id) ) {
            $criteria['Id'] = $id;
        }

        try {
            if ( isset($criteria['Id']) && $this->client->containsRecord($this->table, $criteria) ) {
                $this->client->updateRecord($this->table, $criteria, $data);
            }
            else {
                $this->client->createRecord($this->table, $data);
            }

            return [
                'success' => true,
            ];
        }
        catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function clear ()
    {
        $this->client->flushRecords($this->table);
    }

    public function delete ($id)
    {
        $this->client->deleteRecord($this->table, [ "Id" => $id ]);
    }

}