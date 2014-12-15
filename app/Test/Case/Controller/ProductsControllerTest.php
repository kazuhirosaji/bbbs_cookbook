<?php
App::uses('ProductsController', 'Controller');

/**
 * ProductsController Test Case
 *
 */
class ProductsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product',
		'app.nation'
	);

	public $image = array('name' => 'pizza.jpeg',
	 	'type' => 'image/jpeg',
		'tmp_name' => '/tmp/phpJ1jzZT',
		'error' => '0',
		'size' => '11414'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/products/index', array('method' => 'get', 'return' => 'vars'));
		debug($result);

		$expected = array(
				array('Product' => array(
				'id' => '1',
				'name' => 'Sake',
				'nation_id' => '1',
				'description' => 'Sake is alchol drink in Japan.',
				'link' => 'http://www.yahoo.co.jp',
				'imagename' => '',
				'created' => '2014-10-18 13:58:59',
				'modified' => '2014-10-18 13:58:59'),
				'Nation' => array("id" => 1, "name" => "JPN"),
			),
				array('Product' => array(
				'id' => '2',
				'name' => 'Beer',
				'nation_id' => '2',
				'description' => 'Beer is famous alchol drink in German.',
				'link' => 'http://www.yahoo.co.jp',
				'imagename' => 'Beer.jpeg',
				'created' => '2014-10-29 13:58:59',
				'modified' => '2014-10-29 13:58:59'),
				'Nation' => array("id" => 2, "name" => "USA"),
			),
			);

		$this->assertEquals($expected, $result['products']);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$result = $this->testAction('/products/view/2', array('method' => 'get', 'return' => 'vars'));
		debug($result);
		$expected = array(
				'Product' => array(
				'id' => '2',
				'name' => 'Beer',
				'nation_id' => '2',
				'description' => 'Beer is famous alchol drink in German.',
				'link' => 'http://www.yahoo.co.jp',
				'imagename' => 'Beer.jpeg',
				'created' => '2014-10-29 13:58:59',
				'modified' => '2014-10-29 13:58:59'),
				
				'Nation' => array("id" => 2, "name" => "USA"),
			);

		$this->assertEquals($expected, $result['product']);
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$now = date('Y-m-d H:i:s');
		$expected = array('Product' => array(
				'id' => '3',
				'name' => 'Wine',
				'nation_id' => '4',
				'description' => 'This is Red wine',
				'link' => 'http://www.yahoo.co.jp',
				'imagename' => 'pizza.jpeg',
				'created' => $now,
				'modified' => $now,
			),
			'Nation' => array('id' => 4, 'name' => 'SPA'),
		);


		$data['Product'] = array(
				'name' => 'Wine',
				'nation_id' => '4',
				'description' => 'This is Red wine',
				'link' => 'http://www.yahoo.co.jp',
				'file' => $this->image,
				'created' => $now,
				'modified' => $now);
		$result = $this->testAction('/products/add', array('data' => $data, 'method' => 'post', 'return' => 'vars'));
		$result = $this->testAction('/products/view/3', array('method' => 'get', 'return' => 'vars'));
		debug($result);
		$this->assertEquals($expected, $result['product']);

	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$data['Product'] = array(
			'id' => 2,
			'description' => 'This is Beer from German.',
			'nation_id' => 3, );

		$now = date('Y-m-d H:i:s');

		$expected = array(
				'Product' => array(
				'id' => '2',
				'name' => 'Beer',
				'nation_id' => '3',
				'description' => 'This is Beer from German.',
				'link' => 'http://www.yahoo.co.jp',
				'imagename' => 'Beer.jpeg',
				'created' => '2014-10-29 13:58:59',
				'modified' => $now),
				
				'Nation' => array("id" => 3, "name" => "GER"),
			);

		$result = $this->testAction('/products/edit/2', array('data' => $data, 'return' => 'vars'));
		$result = $this->testAction('/products/view/2', array('method' => 'get', 'return' => 'vars'));
		debug($result);

		$this->assertEquals($expected, $result['product']);

	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		// before delete
		$result = $this->testAction('/products/index', array('method'=>'post', 'return'=>'vars'));
		$this->assertCount(2, $result['products']);

		// after delete
		$this->testAction('/products/delete/1');
		$result = $this->testAction('/products/index', array('method'=>'post', 'return'=>'vars'));
		debug($result);

		$this->assertCount(1, $result['products']);

	}

}
