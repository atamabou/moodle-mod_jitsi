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
 * List of deprecated mod_jitsi functions.
 *
 * @package    mod_jitsi
 * @copyright  2022 Sergio Comerón Sánchez-Paniagua <sergiocomeron@icloud.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Obtains the automatic completion state for this module based on any conditions
 * in jitsi settings.
 *
 * @deprecated since Moodle 3.11
 * @see \mod_jitsi\completion\custom_completion
 * @param object $course Course
 * @param object $cm Course-module
 * @param int $userid User ID
 * @param bool $type Type of comparison (or/and; can be used as return value if no conditions)
 * @return bool True if completed, false if not, $type if conditions not set.
 */
function jitsi_get_completion_state($course, $cm, $userid, $type) {
    global $DB;
    if (!$jitsi = $DB->get_record('jitsi', ['id' => $this->cm->instance])) {
        throw new \moodle_exception('Unable to find jitsi with id ' . $this->cm->instance);
    }
    if ($jitsi->get_instance()->completionminutes) {   
        $completionminutes = $jitsi->completionminutes;
        $userminutes = getminutes($this->cm->id, $userid);
        return $completionminutes <= $userminutes;
    } else {
        // Completion option is not enabled so just return $type.
        return $type;
    }





    global $DB;

        $this->validate_rule($rule);

        $userid = $this->userid;
        $jitsi = $this->cm->instance;

        if (!$jitsi = $DB->get_record('jitsi', ['id' => $this->cm->instance])) {
            throw new \moodle_exception('Unable to find jitsi with id ' . $this->cm->instance);
        }
        $completionminutes = $this->cm->customdata['customcompletionrules']['completionminutes'];
        $userminutes = getminutes($this->cm->id, $userid);

        $status = $completionminutes <= $userminutes;

        return $status ? COMPLETION_COMPLETE : COMPLETION_INCOMPLETE;
}