<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ImagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if ($this->request->data) {
				$file = $this->request->data['Image']['file'];
				$dest_fullpath = APP. 'tmp/saji/'. $file['name'];
				move_uploaded_file($file['tmp_name'], $dest_fullpath);
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
