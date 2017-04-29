<?php
/**
 * Airtable plugin for Craft CMS
 *
 * Airtable Controller
 *
 * @author    Superbig
 * @copyright Copyright (c) 2017 Superbig
 * @link      https://superbig.co
 * @package   Airtable
 * @since     1.0.0
 */

namespace Craft;

class AirtableController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = [
        'actionSave',
    ];

    /**
     */
    public function actionSave ()
    {
        $content = craft()->airtable->filteredContent();

        // Validate
        if ( !$content->validate() ) {
            $this->returnErrors($content);
        }


        if ( !$content->hasErrors() ) {
            $response = craft()->airtable->saveOrUpdate($content);

            // Check for errors from the API
            if ( $content->hasErrors() ) {
                $this->returnErrors($content);
            }
            else {
                $this->returnSuccess($content);
            }

        }
    }

    /**
     * Returns a 'success' response.
     *
     * @param $entry
     *
     * @return void
     */
    private function returnSuccess ($model)
    {
        //$successEvent = new GuestEntriesEvent($this, array( 'entry' => $entry, 'faked' => $faked ));

        if ( craft()->request->isAjaxRequest() ) {
            $return['success'] = true;
            //$return['id']      = $entry->id;
            $this->returnJson($return);
        }
        else {
            craft()->userSession->setNotice(Craft::t('Submission saved.'));
            $this->redirectToPostedUrl($model);
        }
    }

    public function returnErrors ($model)
    {
        //$errorEvent = new GuestEntriesEvent($this, array( 'entry' => $entry ));
        //craft()->guestEntries->onError($errorEvent);

        if ( craft()->request->isAjaxRequest() ) {
            $this->returnJson(array(
                'airtable' => $model->getErrors(),
            ));
        }
        else {
            craft()->userSession->setError(Craft::t('Couldn’t save record.'));

            // Send the airtable input back to the template
            //$entryVariable = craft()->config->get('entryVariable', 'guestentries');
            craft()->urlManager->setRouteVariables(array(
                'airtable' => $model
            ));
        }
    }
}