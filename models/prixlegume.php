<?php
class Prixlegume extends AppModel {
	var $name = 'Prixlegume';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Legume' => array(
			'className' => 'Legume',
			'foreignKey' => 'legume_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Unite' => array(
			'className' => 'Unite',
			'foreignKey' => 'unite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>