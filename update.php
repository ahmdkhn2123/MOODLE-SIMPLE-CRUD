<?php

/**
 * @package       local_message
 * @author        Mohammad Ahmad
 * @license       http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once (__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/message/classes/form/edit.php');



global $DB,$PAGE;
$PAGE->set_url(new moodle_url('/local/message/update.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Edit');



//here display form

$mform=new edit();
$table='local_message';

$id=required_param('id', PARAM_INT);
$info=$DB->get_record($table,array('id' => $id));


if ($mform->is_cancelled()) {
    print_r("1");
    redirect($CFG->wwwroot.'/local/message/manage.php', 'You Cancelled The Form');
} else if ($fromform = $mform->get_data()) {
    print_r("2");
    $record = new stdClass();
    $record->id=$id;
    $record->messagetext = $fromform->messagetext;
    $record->messagetype = $fromform->messagetype;
    $DB->update_record($table, $record);
    redirect($CFG->wwwroot . '/local/message/manage.php', 'you update a message on id = '.$record->id.' with a title '.$fromform->messagetext);
}

echo $OUTPUT->header();
$mform->set_data($info);
$mform->display();
echo $OUTPUT->footer();