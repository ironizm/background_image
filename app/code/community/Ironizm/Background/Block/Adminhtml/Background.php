<?php
class Ironizm_Background_Block_Adminhtml_Background extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_background';
    $this->_blockGroup = 'background';
    $this->_headerText = Mage::helper('background')->__('Background Image Manager');
    $this->_addButtonLabel = Mage::helper('background')->__('Add Background Image');
    parent::__construct();
  }
}