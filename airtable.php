<?php
return [
    // Find this on https://airtable.com/account
    'apiKey'        => '',

    // Find this on https://airtable.com/api
    'base'
                    => '',
    // The name of the table. Make sure the capitalization is correct
    'table'         => '',

    // Allowed field keys. This matches the field names in the table
    // See the documentation for a complete example of how to set column type and validation
    // If not defined, all fields defaults to string, and is required
    'allowedFields' => [ ],
];