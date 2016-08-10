<?php
use Exception;
use SubjectClass;
require_once("../controller/SubjectClassController.class.php");
require_once("../controller/ProfessorController.class.php");
header("Content-Type:application/json");
$class = new SubjectClassController();

try {
	if (isset($_GET['insert'])) {
		if (!isset($_POST['name']) || empty($_POST['name']) ||
			!isset($_POST['semester']) || empty($_POST['semester']))
			throw new Exception("Falta parâmetros na requisição", 1);

		if (isset($_POST['professor_id']) && $_POST['professor_id'] != '') {
            $professorController = new ProfessorController();
            $professor = $professorController->get($_POST['professor_id']);

            if (count($professor) > 0)
                $professor = $professor[0];
            else
                $professor = null;
        }

		$new = $class->insert(
            new SubjectClass(
                null,
                $_POST['name'],
                $professor,
                $_POST['semester']
                )
        );

		success($new->toArray());

	} elseif (isset($_GET['edit'])) {
		if (!isset($_POST['id']) || empty($_POST['id']) ||
			!isset($_POST['name']) || empty($_POST['name']) ||
			!isset($_POST['semester']) || empty($_POST['semester']))
			throw new Exception("Falta parâmetros na requisição", 1);

		if (isset($_POST['professor_id']) && $_POST['professor_id'] != '') {
			$professorController = new ProfessorController();
			$professor = $professorController->get($_POST['professor_id']);

			if (count($professor) > 0)
				$professor = $professor[0];
			else
				$professor = null;
		}

		$new = $class->edit(
			new SubjectClass(
				$_POST['id'],
				$_POST['name'],
				$professor,
				$_POST['semester']
				)
		);

		success($new->toArray());

	} elseif (isset($_GET['delete'])) {
		if (!isset($_POST['id']) || empty($_POST['id']))
			throw new Exception("Falta parâmetros na requisição", 1);

		$professor->deleteId($_POST['id']);
		success(array());

	} else {
		$data = $class->getAll();
		foreach ($data as $i => $value) {
			$data[$i] = $value->toArray();
		}
		success($data);
	}

} catch (Exception $e) {
	http_response_code(400);
	echo json_encode(array(
		'success' => false,
		'error' => $e->getCode(),
		'error_msg' => $e->getCode() == 1 ? $e->getMessage() : null,
	));

}

/**
 * Função para retornar json com sucesso.
 *
 * @param  array  $data Os dados inseridos, etc.
 */
function success(array $data) {
	echo json_encode(array(
		'success' => true,
		'data' => $data,
	));
}
