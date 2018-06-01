<?php

require(ROOT . 'model/PatientsModel.php');
require(ROOT . 'model/SpeciesModel.php');
require(ROOT . 'model/ClientsModel.php');

function index() {
		render('patients/index', array(
		'patients' => getAllPatients(),
		));
}

function create() {
	render('patients/create', array(
		'species' => getAllSpecies(),
		'clients' => getAllClients(),
		));
}

function createSave() {
	if (!createPatient()) {
		header('Location:' . URL . 'error/index');
		exit();
	}
	header('Location:' . URL . 'patients/index');
}

function delete($id) {
	if (!deletePatient($id)) {
		header('Location:' . URL . 'error/index');
		exit();
	}
	header('Location:' . URL . 'patients/index');
}

function edit($id) {
	render('patients/edit', array(
		'species' => getAllSpecies(),
		'clients' => getAllClients(),
		'patient' => getPatient($id)
		));
}

function editSave() {
	if (!editPatient($id)) {
		header('Location:' . URL . 'error/index');
		exit();
	}
	header('Location:' . URL . 'patients/index');
}
