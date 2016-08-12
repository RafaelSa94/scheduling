<?php
require_once("../controller/SubjectClassController.class.php");
require_once "../utils/Utils.php";

header("Content-type:application/json");

$cls = new SubjectClassController();

$timetable = Utils::getTimetable($cls->getAll());

$timetable = array_map(function ($classes)
{
    return array_map(function($c){
        global $cls;
        return $cls->get($c)[0]->toArray();
    }, $classes);
}, $timetable);

echo json_encode(array(
    'success' => true,
    'data' => $timetable,
));
