<?php
require_once("../controller/SubjectClassController.class.php");
require_once "../utils/Utils.php";

header("Content-type:application/json");

$cls = new SubjectClassController();

$timetable = Utils::getTimetable($cls->getAll());

echo json_encode($timetable);
