<?php
class Legume extends AppModel {
	var $name = 'Legume';
	var $displayField = 'lib';
	var $validate = array(
		'lib' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'unite_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'classification_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Unite' => array(
			'className' => 'Unite',
			'foreignKey' => 'unite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Classification' => array(
			'className' => 'Classification',
			'foreignKey' => 'classification_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>