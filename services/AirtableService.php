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

    public function filteredContent ()
    {
        $model = new AirtableModel();

        // Get fields
        $fields = $this->getFields();
        $data   = [ ];

        foreach ($fields as $key) {
            if ( is_array($key) ) {
                $config = $key;
                $key    = $config['id'];
                $value  = craft()->request->getParam($key);

                if ( isset($config['type']) && $config['type'] == 'checkbox' ) {
                    $value = !empty(craft()->request->getParam($key));
                }
            }
            else {
                $value = craft()->request->getParam($key);

                if ( empty($value) ) {
                    continue;
                }
            }

            $model->setAttribute($key, $value);

            //$data[ $key ] = $value;
        }

        return $model;
    }

    public function findRecords ($criteria = [ ])
    {
        try {
            $records = $this->client->findRecords($this->table, $criteria);

            return $records;
        }
        catch (\Exception $e) {
            return [];
        }
    }

    public function saveOrUpdate (AirtableModel $model, $id = null)
    {
        $criteria = [ ];
        $data     = $model->getAttributes();

        // Process dates
        foreach ($this->getDateFields() as $config) {
            $key   = $config['id'];
            $value = $data[ $key ];

            if ( $value instanceof DateTime ) {
                $data[ $key ] = $value->format(DateTime::ISO8601);
            }
        }

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
        }
        catch (\Exception $e) {
            $model->addError('server', $e->getMessage());
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

    public function getFields ()
    {
        $fields = craft()->config->get('allowedFields', 'airtable');

        return $fields;
    }

    public function getDateFields ()
    {
        $fields = $this->getFields();

        return array_filter($fields, function ($value, $key) {

            if ( is_array($value) && isset($value['type']) && $value['type'] == 'date' ) {
                return true;
            }

        }, ARRAY_FILTER_USE_BOTH);
    }

}