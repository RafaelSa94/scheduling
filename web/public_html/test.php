<?php
require_once("../controller/SubjectClassController.class.php");
require_once "../utils/Utils.php";

$cls = new SubjectClassController();

Utils::ClassesToCsv($cls->getAll());
