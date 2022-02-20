<?php
App::uses('AppModel', 'Model');
/**
 * Widget Model
 *
 */
class Widget extends AppModel {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
