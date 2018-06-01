<?php

require(ROOT . 'model/SpeciesModel.php');

function index() {
	render('species/index', array(
		'species' => getAllSpecies()
		));
}

function create() {
	render('species/create');
}

function createSave() {
	if (!createSpecie()) {
		header('Location:' . URL . 'error/index');
		exit();
	}
	header('Location:' . URL . 'species/index');
}

function delete($id) {
	if (!deleteSpecies($id)) {
		header('Location:' . URL . 'error/index');
		exit();
	}
	header('Location:' . URL . 'species/index');
}

function edit($id) {
	render('species/edit', array(
		'specie' => getSpecie($id)
		));
}

function editSave() {
	if (!editSpecie()) {
		header('Location:' . URL . 'error/index');
		exit();
	}
	header('Location:' . URL . 'species/index');
}
