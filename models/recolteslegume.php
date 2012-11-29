<?php
class Recolteslegume extends AppModel {
	var $name = 'Recolteslegume';
	var $displayField = 'legume_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Recolte' => array(
			'className' => 'Recolte',
			'foreignKey' => 'recolte_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Terrain' => array(
			'className' => 'Terrain',
			'foreignKey' => 'terrain_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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