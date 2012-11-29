<?php
class Recolte extends AppModel {
	var $name = 'Recolte';
	var $displayField = 'lib';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Recolteslegume' => array(
			'className' => 'Recolteslegume',
			'foreignKey' => 'recolte_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>
