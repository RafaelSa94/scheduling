<?php
require_once("../controller/SubjectClassController.class.php");
require_once("../controller/ProfessorController.class.php");
header("Content-Type:application/json");
$class = new SubjectClassController();
if (isset($_GET['insert'])) {
	$error = false;
	if (isset($_POST['name']) && $_POST['name'] != '' &&
		isset($_POST['semester']) && $_POST['semester'] != '')
	{
        if (isset($_POST['professor_id']) && $_POST['professor_id'] != '') {
            $professorController = new ProfessorController();
            $professor = $professorController->get($_POST['professor_id']);

            if (count($professor) > 0)
                $professor = $professor[0];
            else
                $professor = null;
        }
	} else {
		$error = true;
	}

	if ($error) {
		http_response_code(400);
		echo json_encode(array(
			'success' => false,
		));
	} else {

		$new = $class->insert(
            new SubjectClass(
                null,
                $_POST['name'],
                $professor,
                $_POST['semester']
                )
        );
		echo json_encode(array(
			'success' => true,
			'data' => array($new->toArray()),
		));
	}
} else {
	$data = $class->getAll();
	foreach ($data as $i => $value) {
		$data[$i] = $value->toArray();
	}
	echo json_encode(array(
		'success' => true,
		'data' => $data,
	));
}
