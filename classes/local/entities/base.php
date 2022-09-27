<?php

namespace local_evokesettings\local\entities;

/**
 * Entity base interface.
 *
 * @package     local_evokesettings
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
abstract class base {
    protected $table;

    public function create($data) {
        global $DB, $CFG;

        try {
            $DB->insert_record($this->table, $data);

            return [true, get_string('createitem_success', 'local_evokesettings')];
        } catch (\Exception $e) {
            if ($CFG->debugdisplay) {
                return [false, $e->getMessage()];
            }

            return [false, get_string('something_went_wrong', 'local_evokesettings')];
        }
    }

    public function update($data) {
        global $DB, $CFG;

        try {
            $DB->update_record($this->table, $data);

            return [true, get_string('updateitem_success', 'local_evokesettings')];
        } catch (\Exception $e) {
            if ($CFG->debugdisplay) {
                return [false, $e->getMessage()];
            }

            return [false, get_string('something_went_wrong', 'local_evokesettings')];
        }
    }

    public function delete($id) {
        global $DB, $CFG;

        try {
            $DB->delete_records($this->table, ['id' => $id]);

            return [true, get_string('deleteitem_success', 'local_evokesettings')];
        } catch (\Exception $e) {
            if ($CFG->debugdisplay) {
                return [false, $e->getMessage()];
            }

            return [false, get_string('something_went_wrong', 'local_evokesettings')];
        }
    }

    public function find($id, $fields = '*', $strictness = MUST_EXIST) {
        global $DB;

        return $DB->get_record($this->table, ['id' => $id], $fields, $strictness);
    }

    public function get_all() {
        global $DB;

        $records = $DB->get_records($this->table);

        if (!$records) {
            return [];
        }

        return array_values($records);
    }

    public function count() {
        global $DB;

        return $DB->count_records($this->table);
    }
}
