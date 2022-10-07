<?php

/**
 * @package       local_message
 * @author        Kristian
 * @license       http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
use local_message\form\edit;
require_once (__DIR__ . '/../../config.php');
require_once ($CFG->dirroot . '/local/message/classes/form/edit.php');


global $DB;
$PAGE->set_url(new moodle_url('/local/message/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Edit');
//here display form

$mform=new edit();


if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/message/manage.php', 'You Cancelled The Form');
} else if ($fromform = $mform->get_data()) {
    //insert into Db

//    $a = $fromform->messagetext;
//    $b = $fromform->messagetype;

    $record = new stdClass();

    $record->messagetext = $fromform->messagetext;
    $record->messagetype = $fromform->messagetype;

    $DB->insert_record('local_message', $record);
    redirect($CFG->wwwroot . '/local/message/manage.php', 'you created a message with a title ' . $fromform->messagetext);
} 

redirect($CFG->wwwroot . '/local/message/manage.php', get_string('bulk_edit_successful', 'local_message'));





echo $OUTPUT->header();
$mform->display();

echo $OUTPUT->footer();