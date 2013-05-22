<?php

/**
 * Mail Antivirus filter settings view.
 *
 * @category   apps
 * @package    mail-antivirus
 * @subpackage views
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

///////////////////////////////////////////////////////////////////////////////
// Items
///////////////////////////////////////////////////////////////////////////////

$anchor = anchor_edit('/app/mail_antivirus/banned_extensions', 'high');
$items['banned_extensions']['title'] = lang('mail_antivirus_banned_file_extensions');
$items['banned_extensions']['action'] = $anchor;
$items['banned_extensions']['anchors'] = array($anchor);

///////////////////////////////////////////////////////////////////////////////
// Action table
///////////////////////////////////////////////////////////////////////////////

echo action_table(
    lang('mail_antivirus_configuration_settings'),
    array(),
    $items
);
