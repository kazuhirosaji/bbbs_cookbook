<?php
App::uses('Nation', 'Model');

/**
 * Nation Test Case
 *
 */
class NationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nation',
		'app.product'
	);	

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Nation = ClassRegistry::init('Nation');
	}
/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nation);

		parent::tearDown();
	}

	public function testFindFirst() {
	    $params = array(
	        'conditions' => array('id' => 1),
	        'fields' => array('id', 'name')
	    );

		$result = $this->Nation->find('first', $params);
		$expected = 
				array('Nation' => array('id' => 1, 'name' => 'JPN'));
			

		$this->assertEquals($expected['Nation'], $result['Nation']);
	}

	public function testFindAll() {
	    $params = array(
	        'fields' => array('id', 'name')
	    );
	    $results = $this->Nation->find('all', $params);
		$expected = array(
				array('Nation' => array('id' => 1, 'name' => 'JPN')),
				array('Nation' => array('id' => 2, 'name' => 'USA')),
				array('Nation' => array('id' => 3, 'name' => 'GER')),
				array('Nation' => array('id' => 4, 'name' => 'SPA'))
				);

		for($i=0; $i < count($results); $i++) {
			$this->assertEquals($expected[$i]['Nation'], $results[$i]['Nation']);
		}
	}

	public function testAddSameNationName() {
	    $params = array(
	        'fields' => array('id', 'name')
	    );


		try {
			// can't add Nation name which already added
			$count = $this->Nation->find('count');
			$this->assertEquals(4, $count);

			$data = array('Nation' => array('name' => 'JPN'));
			$result = $this->Nation->save($data);
			$count_after_add = $this->Nation->find('count');

			// /var/www/html/bbbs/lib/Cake/Model/Datasource/Database/Mysql.php
			// のPDO::ATTR_ERRMODE => を "PDO::ERRMODE_SILENT" にした時のみ、本検証処理が行われる。
			$this->assertEquals(4, $count_after_add);

		} catch (PDOException $e) {
			debug($e);
		}

	}

	public function testRelatedProducts() {
		$params = array(
			"conditions"=> array('Nation.id' => 1));
		$results = $this->Nation->find("all", $params);
		$expected = "Sake";
		debug($results);
		$this->assertEquals($expected, $results[0]['Product'][0]['name']);
	}	

}
