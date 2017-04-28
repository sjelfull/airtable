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
        $input    = craft()->airtable->filteredInput();
        $response = craft()->airtable->saveOrUpdate($input);

        if ( craft()->request->isAjaxRequest ) {
            $this->returnJson($response);
        }

        if ( !$response['success'] ) {
            // Error response
        }

        $this->redirectToPostedUrl();
    }
}