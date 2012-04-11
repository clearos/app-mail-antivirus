<?php

/**
 * Policy controller.
 *
 * @category   Apps
 * @package    Mail_Antivirus
 * @subpackage Controllers
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
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * Banned Extensions controller.
 *
 * @category   Apps
 * @package    Mail_Antivirus
 * @subpackage Controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/mail_antivirus/
 */

class Banned_Extensions extends ClearOS_Controller
{
    /**
     * Banned extensions default controller
     *
     * @return view
     */

    function index()
    {
        // Load libraries
        //---------------

        $this->lang->load('mail_antivirus');
        $this->load->library('mail_filter/Amavis');

        // Handle form submit
        //-------------------

        if ($this->input->post('submit')) {
            try {
                $this->amavis->set_banned_extensions(array_keys($this->input->post('extensions')));
                $this->page->set_message(lang('mail_antivirus_banned_file_extensions_updated'), 'info');
                redirect('/mail_antivirus');
            } catch (Exception $e) {
                $this->page->view_exception($e);
                return;
            }
        }

        // Load view data
        //---------------

        try {
            $data['extensions'] = $this->amavis->get_banned_extension_list();
            $data['banned_extensions'] = $this->amavis->get_banned_extensions();
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        $this->page->view_form('banned_extensions', $data, lang('mail_antivirus_app_name'));
    }
}
