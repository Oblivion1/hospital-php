<?php

function getAllPatients() {
	$db = openDatabaseConnection();
	$sql = "SELECT `patients`.*, `species`.`species_description`, `clients`.`client_firstname`, `clients`.`client_lastname`
		FROM `patients`
		INNER JOIN `species` ON `patients`.`species_id` = `species`.`species_id`
		INNER JOIN  `clients` ON `patients`.`client_id` = `clients`.`client_id`";
	$query = $db->prepare($sql);
	$query->execute();
	$db=null;
	return $query->fetchAll();
}


function createPatient() {
	$patient = isset($_POST['Name']) ? $_POST['Name'] : null;
	$species = isset($_POST['specie']) ? $_POST['specie'] : null;
	$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
	$status = isset($_POST['Status']) ? $_POST['Status'] : null;
	$client = isset($_POST['client']) ? $_POST['client'] : null;
	if (strlen($patient) == 0 || strlen($species) == 0 || strlen($gender) == 0 || strlen($client) == 0 || strlen($status) == 0 ) {
		return false;
	}
	$db = openDatabaseConnection();
	$sql = "INSERT INTO patients(patient_name, species_id, patient_gender, client_id, patient_status) VALUES (:name, :species, :gender, :client, :status)";
	$query = $db->prepare($sql);
	$query->execute(array(
		':name'=>$patient,
		':species'=>$species,
		':gender'=>$gender,
		':status'=>$status,
		':client'=>$client
		));
	$db = null;
	return true;
}

function getPatient($id) {
	$db = openDatabaseConnection();
	$sql = "SELECT * FROM patients WHERE patient_id = :id";
	$query = $db->prepare($sql);
	$query->execute(array(
		':id' => $id));
	$db = null;
	return $query->fetch();
}

function editPatient($id) {
	$patient = isset($_POST['Name']) ? $_POST['Name'] : null;
	$species = isset($_POST['specie']) ? $_POST['specie'] : null;
	$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
	$status = isset($_POST['Status']) ? $_POST['Status'] : null;
	$client = isset($_POST['client']) ? $_POST['client'] : null;
	$id = isset($_POST['id']) ? $_POST['id'] : null;
	if (strlen($patient) == null || strlen($species) == null || strlen($client) == null || strlen($status) == null) {
		return false;
	}
	$db = openDatabaseConnection();
	$sql = "UPDATE patients SET patient_name = :patient, species_id = :species, patient_gender = :gender, client_id = :client, patient_status = :status WHERE patient_id = :id";
	$query = $db->prepare($sql);
	$query->execute(array(
		':patient'=>$patient,
		':species'=>$species,
		':gender'=>$gender,
		':status'=>$status,
		':client'=>$client,
		':id' =>$id
		));
	$db = null;
	return true;
}

function deletePatient($id = null) {
	if (!$id) {
		return false;
	}
	$db = openDatabaseConnection();
	$sql = "DELETE FROM patients WHERE patient_id = :id";
	$query = $db->prepare($sql);
	$query->execute(array(
		':id' => $id));
	$db = null;
	return true;
}
