<?php

require(ROOT . 'model/ClientsModel.php');

function index() {

	$clients = getAllClients();

	render('clients/index', array(
		'clients' => $clients)
	);
}

function create() {
	render('clients/create');
}

function createSave() {
	if (createClient()) {
		header('Location:' . URL . "clients/index");
		exit();
	}
	header('Location:' . URL . "error/error_db");
	exit();
}

function delete($id) {
	if (deleteClient($id)) {
		header('Location:' . URL . "clients/index");
		exit();
	}
	header('Location:' . URL . "error_db");
	exit();
}

function edit($id) {
	render('clients/edit', array(
		'client' => getclient($id)
		));
}

function editSave($id) {
	if (editClient()) {
		header('Location:' . URL . "clients/index");
		exit();
	}
	header('Location:' . URL . "error_db");
	exit();
}
