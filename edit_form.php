<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package block_dataformaccessfield
 * @copyright 2014 Itamar Tzadok {@link http://substantialmethods.com}
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_dataformaccessfield_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        $ruleformhelper = '\mod_dataform\pluginbase\dataformruleform_helper';

        $ruleformhelper::general_definition($mform, $this->block->dataformid, 'config_');

        $mform->addElement('header', 'fieldshdr', get_string('fields', 'dataform'));
        $mform->setExpanded('fieldshdr');
        $ruleformhelper::fields_selection_definition($mform, $this->block->dataformid, 'config_');

        $mform->addElement('header', 'filterhdr', get_string('filter', 'dataform'));
        $mform->setExpanded('filterhdr');

        $config = $this->block->config;
        $customsearch = !empty($config->customsearch) ? $config->customsearch : null;
        $ruleformhelper::entries_filter_definition($mform, $this->block->dataformid, $customsearch, 'config_');
    }

    /**
     *
     */
    public function get_data() {

        if ($data = parent::get_data()) {
            $ruleformhelper = '\mod_dataform\pluginbase\dataformruleform_helper';
            // Custom search.
            if ($customsearch = $ruleformhelper::get_custom_search_from_form($data, $this->block->dataformid)) {
                $data->config_customsearch = $customsearch;
            } else {
                $data->config_customsearch = null;
            }
        }

        return $data;
    }

    /**
     *
     */
    public function validation($data, $files) {
        if ($errors = parent::validation($data, $files)) {
            return $errors;
        }

        $ruleformhelper = '\mod_dataform\pluginbase\dataformruleform_helper';
        $errors = $ruleformhelper::general_validation($data, $files, 'config_');

        return $errors;
    }
}
