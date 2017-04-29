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
    protected $fields;

    /**
     * @return array
     */
    protected function defineAttributes ()
    {
        $definedFields = [ ];

        foreach ($this->getFields() as $index => $fieldKey) {
            if ( is_array($fieldKey) ) {
                $config   = $fieldKey;
                $type     = 'string';
                $default  = '';
                $required = !empty($config['required']);

                if ( isset($config['type']) ) {
                    $type = $config['type'];
                }

                switch ($type) {
                    case 'number':
                        $typeClass = AttributeType::Number;
                        break;
                    case 'email':
                        $typeClass = AttributeType::Email;
                        break;
                    case 'checkbox':
                        $typeClass = AttributeType::Bool;
                        break;
                    case 'multiselect':
                        $typeClass = AttributeType::Mixed;
                        break;
                    case 'date':
                        $typeClass = AttributeType::DateTime;
                        break;
                    case 'datetime':
                        $typeClass = AttributeType::DateTime;
                        break;
                    case 'select':
                    default:
                        $typeClass = AttributeType::String;
                }

                if ( $type === 'number' ) {
                    $default = null;
                }

                if ( $type === 'checkbox' ) {
                    $default = false;
                }

                if ( $type === 'multiselect' ) {
                    $default = [ ];
                }

                $definedFields[ $config['id'] ] = [ $typeClass, 'default' => $default, 'required' => $required ];
            }
            else {
                // Default to String, required
                $definedFields[ $fieldKey ] = [ AttributeType::String, 'default' => '', 'required' => true ];
            }
        }

        return array_merge(parent::defineAttributes(), $definedFields);
    }

    public function rules ()
    {
        $rules = parent::rules();

        foreach ($this->getFields() as $index => $fieldKey) {
            $config = $fieldKey;

            if ( is_array($fieldKey) && isset($config['type']) && $config['type'] == 'checkbox' && !empty($config['required']) ) {
                $rules[] = [ $config['id'], 'validateRequiredCheckbox' ];
            }
        }

        return $rules;
    }

    public function validateRequiredCheckbox ($attribute)
    {
        $value = $this->$attribute;

        if ( empty($value) ) {
            $message = Craft::t($attribute . " is required");
            $this->addError($attribute, $message);
        }
    }

    public function getFields ()
    {
        if ( !$this->fields ) {
            $this->fields = craft()->airtable->getFields();
        }

        return $this->fields;
    }

}