<?php
require_once("../controller/SubjectClassController.class.php");
require_once "../utils/Utils.php";

header("Content-Type:text");

$cls = new SubjectClassController();

echo Utils::ClassesToCsv($cls->getAll());
