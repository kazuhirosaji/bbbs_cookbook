<?php
App::uses('AppController', 'Controller');
/**
 * Nations Controller
 *
 * @property Nation $Nation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Nation->recursive = 0;
		$this->set('nations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Nation->exists($id)) {
			throw new NotFoundException(__('Invalid nation'));
		}
		$options = array('conditions' => array('Nation.' . $this->Nation->primaryKey => $id));
		$this->set('nation', $this->Nation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Nation->create();
			if ($this->Nation->save($this->request->data)) {
				$this->Session->setFlash(__('The nation has been saved.'));
				var_dump($this->request->data);
//				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nation could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Nation->exists($id)) {
			throw new NotFoundException(__('Invalid nation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Nation->save($this->request->data)) {
				$this->Session->setFlash(__('The nation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Nation.' . $this->Nation->primaryKey => $id));
			$this->request->data = $this->Nation->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Nation->id = $id;
		if (!$this->Nation->exists()) {
			throw new NotFoundException(__('Invalid nation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Nation->delete()) {
			$this->Session->setFlash(__('The nation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The nation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
