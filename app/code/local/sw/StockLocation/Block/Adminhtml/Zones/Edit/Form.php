<?php


class sw_StockLocation_Block_Adminhtml_Zones_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

	protected function _prepareForm() {

		$helper = Mage::helper('swstocklocation');
		$model = Mage::registry('current_zones');

		$form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save', array(
				'id' => $this->getRequest()->getParam('id')
			)),
			'method' => 'post',
			'enctype' => 'multipart/form-data'
		));

		$this->setForm($form);

		$fieldset = $form->addFieldset('zones_form', array('legend' => $helper->__('Zone\'s Information')));

		$fieldset->addField('name', 'text', array(
			'label' => $helper->__('Name'),
			'required' => true,
			'name' => 'name',
		));

        $fieldset->addField('length', 'text', array(
            'label' => $helper->__('Length'),
            'required' => true,
            'name' => 'length',
        ));
        $fieldset->addField('width', 'text', array(
            'label' => $helper->__('Width'),
            'required' => true,
            'name' => 'width',
        ));
        $fieldset->addField('height', 'text', array(
            'label' => $helper->__('Height'),
            'required' => true,
            'name' => 'height',
        ));

        $fieldset->addField('sp_x', 'text', array(
            'label' => $helper->__('sp_x'),
            'required' => true,
            'name' => 'sp_x',
        ));
        $fieldset->addField('sp_y', 'text', array(
            'label' => $helper->__('sp_y'),
            'required' => true,
            'name' => 'sp_y',
        ));
        $fieldset->addField('sp_z', 'text', array(
            'label' => $helper->__('sp_z'),
            'required' => true,
            'name' => 'sp_z',
        ));

		$fieldset->addField('approx_length', 'text', array(
			'label' => $helper->__('A. Length'),
			'required' => true,
			'name' => 'approx_length',
		));
		$fieldset->addField('approx_width', 'text', array(
			'label' => $helper->__('A. Width'),
			'required' => true,
			'name' => 'approx_width',
		));
		$fieldset->addField('approx_height', 'text', array(
			'label' => $helper->__('A. Height'),
			'required' => true,
			'name' => 'approx_height',
		));

		$form->setUseContainer(true);

		if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
			$form->setValues($data);
		} else {
			$form->setValues($model->getData());
		}

		return parent::_prepareForm();
	}

}