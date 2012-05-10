<?php

/**
 * Mail_Antivirus view.
 *
 * @category   ClearOS
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
$this->lang->load('base');

///////////////////////////////////////////////////////////////////////////////
// Form handler
///////////////////////////////////////////////////////////////////////////////

if ($form_mode === 'edit') {
    $read_only = FALSE;
    $buttons = array(
        form_submit_update('submit'),
        anchor_cancel('/app/mail_antivirus')
    );
} else {
    $read_only = TRUE;
    $buttons = array(
        anchor_edit('/app/mail_antivirus/policy/edit'),
        anchor_custom('/app/antivirus', lang('mail_antivirus_modify_gateway_antivirus_settings'))
    );
}

///////////////////////////////////////////////////////////////////////////////
// Form
///////////////////////////////////////////////////////////////////////////////

echo form_open('mail_antivirus');
echo form_header(lang('mail_antivirus_mail_policies'));

echo field_dropdown('virus_detect', $virus_detect_options, $virus_detect, lang('mail_antivirus_virus_detect_policy'), $read_only);
echo field_dropdown('bad_header', $bad_header_options, $bad_header, lang('mail_antivirus_bad_header_policy'), $read_only);
echo field_dropdown('banned_extension', $banned_extensions_options, $banned_extensions, lang('mail_antivirus_banned_extension_policy'), $read_only);

echo field_button_set($buttons);

echo form_footer();
echo form_close();
