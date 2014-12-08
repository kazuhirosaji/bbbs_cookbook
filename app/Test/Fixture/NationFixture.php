<?php
/**
 * NationFixture
 *
 */
class NationFixture extends CakeTestFixture {

	public $useDbConfig = 'test';
/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'name' => array('column' => 'name', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */

	public $records = array(
		array('id' => 1, 'name' => 'JPN'),
		array('id' => 2, 'name' => 'USA'),
		array('id' => 3, 'name' => 'GER'),
		array('id' => 4, 'name' => 'SPA'),
	);

}
