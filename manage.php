<?php

/**
 * @package       local_message
 * @author        Kristian
 * @license       http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

global $DB;
require_once (__DIR__.'/../../config.php');

$PAGE->set_url(new moodle_url('/local/message/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Manage Message');


$messages=$DB->get_records('local_message');



echo $OUTPUT->header();

$templatecontext=(object)[
    'show' => array_values($messages),
    'editurl'=> new moodle_url('/local/message/edit.php'),
];


echo $OUTPUT->render_from_template('local_message/manage', $templatecontext);

echo $OUTPUT->footer();