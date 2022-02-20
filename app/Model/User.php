<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
// use Authentication\PasswordHasher\DefaultPasswordHasher;
// App::uses('AuthComponent', 'PasswordHasher\DefaultPasswordHasher');
/**
 * User Model
 *
 * @property Group $Group
 * @property Post $Post
 */
class User extends AppModel {

	public $name = 'User';
	public $belongsTo = array('Group');
	public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

	public function beforeSave($options = array())
	{
		$this->data['User']['password'] = AuthComponent::password(
			$this->data['User']['password']
		);
		return true;
	}


	

	// protected function _setPassword(string $password) : ?string
 //    {
 //        if (strlen($password) > 0) {
 //            return (new DefaultPasswordHasher())->hash($password);
 //        }
 //    }

	public function parentNode() {
	

		if(!$this->id && empty($this->data)) {
			return null;
		}
		if(isset($this->data['User']['group_id'])) {
			$groupId = $this->data['User']['group_id'];

		}else {
			$groupId = $this->field('group_id');
		}

		if (!$groupId) {
			return null;
		}
		return array('Group' => array('id' => $groupId));
	}

	public function bindNode($user) {
		return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}

	



	



/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	// public $belongsTo = array(
	// 	'Group' => array(
	// 		'className' => 'Group',
	// 		'foreignKey' => 'group_id',
	// 		'conditions' => '',
	// 		'fields' => '',
	// 		'order' => ''
	// 	)
	// );

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
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
