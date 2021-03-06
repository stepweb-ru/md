<?php

class sw_StockLocation_Block_Adminhtml_Blocks extends Mage_Adminhtml_Block_Widget_Grid_Container {

	protected function _construct() {
		parent::_construct();

		$helper = Mage::helper('swstocklocation');
		$this->_blockGroup = 'swstocklocation';
		$this->_controller = 'adminhtml_blocks';

		$this->_headerText = $helper->__('StockLocation Management');
		$this->_addButtonLabel = $helper->__('Add block');
	}

}
