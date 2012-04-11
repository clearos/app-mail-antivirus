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

class Policy extends ClearOS_Controller
{
    /**
     * Antivirus policy controller.
     *
     * @return view
     */

    function index()
    {
        $this->view();
    }

    /**
     * Antivirus edit view.
     *
     * @return view
     */

    function edit()
    {
        $this->_view_edit('edit');
    }

    /**
     * Antivirus view view.
     *
     * @return view
     */

    function view()
    {
        $this->_view_edit('view');
    }

    /**
     * Antivirus common view/edit view.
     *
     * @param string $form_mode form mode
     *
     * @return view
     */

    function _view_edit($form_mode)
    {
        // Load libraries
        //---------------

        $this->load->library('mail_filter/Amavis');

        // Set validation rules
        //---------------------
        // All dropdowns - done in library
         
        //$form_ok = $this->form_validation->run();

        // Handle form submit
        //-------------------

        if ($this->input->post('submit')) {
            try {
                $this->amavis->set_antivirus_policy($this->input->post('virus_detect'));
                $this->amavis->set_bad_header_policy($this->input->post('bad_header'));
                $this->amavis->set_banned_policy($this->input->post('banned_extension'));

                $this->page->set_status_updated();
            } catch (Engine_Exception $e) {
                $this->page->view_exception($e);
                return;
            }
        }

        // Load view data
        //---------------

        try {
            $data['form_mode'] = $form_mode;
            $data['virus_detect'] = $this->amavis->get_antivirus_policy();
            $data['bad_header'] = $this->amavis->get_bad_header_policy();
            $data['banned_extensions'] = $this->amavis->get_banned_policy();
            $data['virus_detect_options'] = $this->amavis->get_policy_options('virus_detected');
            $data['bad_header_options'] = $this->amavis->get_policy_options('bad_header');
            $data['banned_extensions_options'] = $this->amavis->get_policy_options('banned_extensions');
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        $this->page->view_form('mail_antivirus', $data, lang('mail_antivirus_app_name'));
    }
}
