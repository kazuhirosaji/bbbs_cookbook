<?php
App::uses('NationsController', 'Controller');

/**
 * NationsController Test Case
 *
 */
class NationsControllerTest extends ControllerTestCase {

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
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/nations/index', array('method' => 'get', 'return' => 'vars'));
		debug($result);

		$expected = array(
				array('Nation' => array('id' => 1, 'name' => 'JPN')),
				array('Nation' => array('id' => 2, 'name' => 'USA')),
				array('Nation' => array('id' => 3, 'name' => 'GER')),
				array('Nation' => array('id' => 4, 'name' => 'SPA'))
				);

		$this->assertEquals($expected, $result['nations']);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$expected = array(
				array('Nation' => array('id' => 1, 'name' => 'JPN')),
				array('Nation' => array('id' => 2, 'name' => 'USA')),
				array('Nation' => array('id' => 3, 'name' => 'GER')),
				array('Nation' => array('id' => 4, 'name' => 'SPA'))
				);

		for ($i = 0; $i < count($expected); $i++) {
			$index = $i + 1;
			$result = $this->testAction('/nations/view/'.$index , array('method' => 'get', 'return' => 'vars'));
			debug($result);
			$this->assertEquals($expected[$i]['Nation'], $result['nation']['Nation']);
		}

	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
  		$data['Nation']['name'] = 'POR';
		$result = $this->testAction('/nations/add', array('data' => $data, 'method' => 'post', 'return' => 'vars'));
		$result = $this->testAction('/nations/view/5' , array('method' => 'get', 'return' => 'vars'));
		debug($result);

		$expected = array('id' => 5, 'name' => 'POR');

		$this->assertEquals($expected, $result['nation']['Nation']);
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$data['Nation']['id'] = 1;
		$data['Nation']['name'] = 'SWE';
		$result = $this->testAction('/nations/edit/1', array('data' => $data, 'method' => 'post', 'return' => 'vars'));
		$result = $this->testAction('/nations/view/1' , array('method' => 'get', 'return' => 'vars'));
		debug($result);
		$expected = array('id' => 1, 'name' => 'SWE');

		$this->assertEquals($expected, $result['nation']['Nation']);
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$result = $this->testAction('/nations/delete/1', array('method' => 'post', 'return' => 'vars'));
		$result = $this->testAction('/nations/index' , array('method' => 'get', 'return' => 'vars'));
		debug($result);

		$expected = array(
				array('Nation' => array('id' => 2, 'name' => 'USA')),
				array('Nation' => array('id' => 3, 'name' => 'GER')),
				array('Nation' => array('id' => 4, 'name' => 'SPA'))
				);
		$this->assertEquals($expected, $result['nations']);
	}

}
