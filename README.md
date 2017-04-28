# Airtable plugin for Craft CMS

Sweet saving and fetching of data with [Airtable](https://airtable.com/invite/r/znUACjay)

![Icon](resources/icon.png)

## Installation

To install Airtable, follow these steps:

1. Download & unzip the file and place the `airtable` directory into your `craft/plugins` directory
2. Install plugin in the Craft Control Panel under Settings > Plugins
3. The plugin folder should be named `airtable` for Craft to see it.

Airtable works on Craft 2.4.x and Craft 2.5.x.

## Airtable Overview

[Airtable](https://airtable.com/invite/r/znUACjay) is a human-friendly database solution that makes it super easy to manage both simple and complex, relational data.

## Configuring Airtable

```php
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
    'allowedFields' => [ ],
];
```

## Using Airtable

_Example form_

```twig
<form method="post" accept-charset="UTF-8">
    {{ getCsrfInput() }}
    <input type="hidden" name="action" value="airtable/save">
    <input type="hidden" name="redirect" value="airtable?success={slug}">
    <input type="hidden" name="enabled" value="1">

    {% macro errorList(errors) %}
        {% if errors %}
            <ul class="errors">
                {% for error in errors %}
                    <li>{{ error }}</li>
                {% endfor %}
            </ul>
        {% endif %}
    {% endmacro %}

    {% from _self import errorList %}

    <label for="title">Name</label>
    <input id="title" type="text" name="Name"
            {%- if airtable is defined %} value="{{ airtable.Name }}"{% endif -%}>

    {% if entry is defined %}
        {{ errorList(entry.getErrors('Name')) }}
    {% endif %}

    <label for="notes">Notes</label>
    <textarea id="notes" name="Notes">
        {%- if airtable is defined %}{{ airtable.Notes }}{% endif -%}
    </textarea>

    {% if airtable is defined %}
        {{ errorList(airtable.getErrors('Notes')) }}
    {% endif %}

    <input type="submit" value="Save">
</form>
```

## Airtable Roadmap

Some things to do, and ideas for potential features:

* Support multiple tables
* Better validation
* Add model for showing errors & previous input
* Support attachments

Brought to you by [Superbig](https://superbig.co)
