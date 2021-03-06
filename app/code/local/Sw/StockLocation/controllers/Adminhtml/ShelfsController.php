<?php


class Sw_StockLocation_Adminhtml_ShelfsController extends Mage_Adminhtml_Controller_Action {


	public function indexAction() {
		$this->loadLayout()->_setActiveMenu('swstocklocation');

		$id_zone = null;

		// echo 'params ';
		// $param = $this->getRequest()->getParams();
		// print_r($param);
		//		$param['filter'] = explode('&',urldecode(base64_decode($param['filter'])));
		//		Zend_Debug::dump($param['filter'], 'Filter: ');
		// print_r(urldecode(base64_decode($param['filter'])));

		Mage::register('preparedFilter', array(
			/*
			'store_id' => '1',
			'status' => 'processing',
			'created_at' => array(
				'from'=> new Zend_Date($from, null, $locale),
				'to'=> new Zend_Date($to, null, $locale),
				'locale' => $locale,
				'orig_to' => Mage::helper('core')->formatDate($to),
				'orig_from' => Mage::helper('core')->formatDate($from),
				'datetime' => true
			),
			*/
			'id_zone' => $id_zone,
		));

		$this->_addContent($this->getLayout()->createBlock('swstocklocation/adminhtml_shelfs'));

		$this->renderLayout();
	}

	public function newAction() {
		$this->_forward('edit');
	}

	public function editAction() { 
		$id = (int)$this->getRequest()->getParam('id');
		Mage::register('current_shelfs', Mage::getModel('swstocklocation/shelfs')->load($id));
		$this->loadLayout();
		$this->_setActiveMenu('swstocklocation');
		$this->getLayout()->getBlock('head')->addItem('skin_js', 'Sw_StockLocation/adminhtml/stocklocation.js');

		$this->_addContent($this->getLayout()->createBlock('swstocklocation/adminhtml_shelfs_edit'));
		$this->renderLayout();
	}

	public function saveAction() {

		if ($data = $this->getRequest()->getPost()) {
			try {
				$model = Mage::getModel('swstocklocation/shelfs');
				$model->setData($data)->setId($this->getRequest()->getParam('id'));
				if(!$model->getCreated()){
					$model->setCreated(now());
				}
				$model->save();

				Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Shelfs was saved successfully'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array(
					'id' => $this->getRequest()->getParam('id')
				));
			}
			return;
		}
		Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
		$this->_redirect('*/*/');
	}

	public function deleteAction() {
		if ($id = $this->getRequest()->getParam('id')) {
			try {
				Mage::getModel('swstocklocation/shelfs')->setId($id)->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Shelfs was deleted successfully'));
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $id));
			}
		}
		$this->_redirect('*/*/');
	}

	public function massDeleteAction() {

		$shelfs = $this->getRequest()->getParam('shelfs', null);

		if (is_array($shelfs) && sizeof($shelfs) > 0) {
			try {
				foreach ($shelfs as $id) {
					Mage::getModel('swstocklocation/shelfs')->setId($id)->delete();
				}
				$this->_getSession()->addSuccess($this->__('Total of %d shelfs have been deleted', sizeof($shelfs)));
			} catch (Exception $e) {
				$this->_getSession()->addError($e->getMessage());
			}
		} else {
			$this->_getSession()->addError($this->__('Please select shelfs'));
		}
		$this->_redirect('*/*');
	}

}


