<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

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
		$this->Product->recursive = 0;
		$this->Paginator->settings['limit'] = 10;
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}


	public function saveImageFile() {
		$options = array(
			'fields' => 'id',
			'conditions' => array('Product.name' => $this->request->data['Product']['name'])
		);
		$newId = $this->Product->find('first', $options);
		$imageName = $newId['Product']['id'];

		$dest_fullpath = IMAGES . "products/" . $imageName;

		$file = $this->request->data['Product']['file'];
		$res = move_uploaded_file($file['tmp_name'], $dest_fullpath);
		if ($res) {
			chmod($dest_fullpath, 0666);
		}

		$saveImage = array('Product' => array('imagename' => $imageName));
		return $this->Product->save($saveImage);
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data) && $this->saveImageFile()) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		$nations = $this->Product->Nation->find('list');
		$this->set(compact('nations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if (isset($this->request->data['Product']['file']) && $this->request->data['Product']['file']['size'] > 0) {
				$this->deleteImage($id);
				$file = $this->request->data['Product']['file'];
				$dest_fullpath = IMAGES . "products/" . $id;
				$res = move_uploaded_file($file['tmp_name'], $dest_fullpath);
				if ($res) {
					chmod($dest_fullpath, 0666);
				}
				$this->request->data['Product']['imagename'] = $this->request->data['Product']['id'];
			}

			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$nations = $this->Product->Nation->find('list');
		$this->set(compact('nations'));
	}


/**
 * delete image method
 *
 * @param string $id
 * @return void
 */
	public function deleteImage($id) {
		if (!isset($id)) {
			return;
		}
		$dest_fullpath = IMAGES . "products/" . $id;
		if(file_exists($dest_fullpath)) {
			unlink($dest_fullpath);
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
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
			$this->deleteImage($id);
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
