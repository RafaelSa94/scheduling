<?php
require_once("../controller/ProfessorController.class.php");
header("Content-Type:application/json");
$professor = new ProfessorController();
if (isset($_GET['insert'])) {
	$error = false;
	if (!isset($_POST['name']) || $_POST['name'] == '' ||
		!isset($_POST['constraints']) || $_POST['constraints'] == '')
	{
		$error = true;
	}

	if ($error) {
		http_response_code(400);
		echo json_encode(array(
			'success' => false,
		));
	} else {

        $constraints = implode(',', $_POST['constraints']);

		$new = $professor->insert(new Professor(null, $_POST['name'], $constraints));
		echo json_encode(array(
			'success' => true,
			'data' => array($new->toArray()),
		));
	}
} else {
	$data = $professor->getAll();
	foreach ($data as $i => $value) {
		$data[$i] = $value->toArray();
	}
	echo json_encode(array(
		'success' => true,
		'data' => $data,
	));
}
