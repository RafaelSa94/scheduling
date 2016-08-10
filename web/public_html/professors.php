<?php
use Exception;
require_once("../controller/ProfessorController.class.php");
header("Content-Type:application/json");
$professor = new ProfessorController();

try {
	if (isset($_GET['insert'])) {
		if (!isset($_POST['name']) || empty($_POST['name']) ||
			!isset($_POST['constraints']) || empty($_POST['constraints']))
			throw new Exception("Falta parâmetros na requisição", 1);

		$new = $professor->insert(new Professor(null, $_POST['name'], $_POST['constraints']));
		success($new->toArray());

	} elseif (isset($_GET['edit'])) {
		if (!isset($_POST['id']) || empty($_POST['id']) ||
			!isset($_POST['name']) || empty($_POST['name']) ||
			!isset($_POST['constraints']))
			throw new Exception("Falta parâmetros na requisição", 1);

		$new = $professor->edit(new Professor($_POST['id'], $_POST['name'], $_POST['constraints']));
		success($new->toArray());

	} elseif (isset($_GET['delete'])) {
		if (!isset($_POST['id']) || empty($_POST['id']))
			throw new Exception("Falta parâmetros na requisição", 1);

		$professor->deleteId($_POST['id']);
		success(array());

	} else {
		$data = $professor->getAll();
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
