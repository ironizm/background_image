<?php

class Ironizm_Background_Model_Mysql4_Background_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('background/background');
    }
}