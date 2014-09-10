<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'mail_antivirus';
$app['version'] = '2.0.0';
$app['release'] = '1';
$app['vendor'] = 'ClearFoundation';
$app['packager'] = 'ClearFoundation';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('mail_antivirus_app_description');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('mail_antivirus_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = lang('base_subcategory_mail');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['requires'] = array(
    'app-antivirus',
);

$app['core_requires'] = array(
    'amavisd-new',
    'app-antivirus-core',
    'app-mail-filter-core >= 1:1.6.5',
    'app-smtp-core',
);
