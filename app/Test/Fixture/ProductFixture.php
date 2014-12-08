<?php
/**
 * ProductFixture
 *
 */
class ProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'nation_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'link' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'image' => array('type' => 'binary', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Sake',
			'nation_id' => 1,
			'description' => 'Sake is alchol drink in Japan.',
			'link' => 'http://www.yahoo.co.jp',
			'image' => '',
			'created' => '2014-10-18 13:58:59',
			'modified' => '2014-10-18 13:58:59'
		),
		array(
			'id' => 2,
			'name' => 'Beer',
			'nation_id' => 2,
			'description' => 'Beer is famous alchol drink in German.',
			'link' => 'http://www.yahoo.co.jp',
			'image' => '',
			'created' => '2014-10-29 13:58:59',
			'modified' => '2014-10-29 13:58:59'
		),
	);

}
