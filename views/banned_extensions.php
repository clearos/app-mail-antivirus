<?php

/**
 * Mail Antivirus banned extensions view.
 *
 * @category   Apps
 * @package    Mail_Antivirus
 * @subpackage Views
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/mail_antivirus/
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.  
//  
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('mail_antivirus');
$this->lang->load('mail_filter');

///////////////////////////////////////////////////////////////////////////////
// Buttons
///////////////////////////////////////////////////////////////////////////////

$buttons = array(
    anchor_cancel('/app/mail_antivirus'),
    form_submit_update('submit')
);

///////////////////////////////////////////////////////////////////////////////
// Headers
///////////////////////////////////////////////////////////////////////////////

$headers = array(
    '',
    lang('mail_filter_file_extension'),
    lang('base_description')
);

///////////////////////////////////////////////////////////////////////////////
// Items
///////////////////////////////////////////////////////////////////////////////

foreach ($extensions as $extension => $entry) {

    $item['title'] = $extension;
    $item['name'] = 'extensions[' . $extension . ']';
    $item['state'] = in_array($extension, $banned_extensions);
    $item['details'] = array(
        $entry['category_text'],
        $extension,
        $entry['description'],
    );

    $items[] = $item;
}

///////////////////////////////////////////////////////////////////////////////
// List table
///////////////////////////////////////////////////////////////////////////////

echo form_open('mail_antivirus/banned_extensions');

echo list_table(
    lang('mail_antivirus_banned_file_extensions'),
    $buttons,
    $headers,
    $items,
    array('id' => 'extensions', 'grouping' => TRUE)
);

echo form_close();
