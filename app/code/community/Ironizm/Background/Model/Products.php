<?php

class Ironizm_Background_Model_Products 
{
   /**
     * Retrieve Categories Option array
     *
     * @return array
     */
	public function toOptionArray() 
	{
		//get a list of all active top level categories
		//$activeCategories = array();
		//foreach ($this->getStoreProducts() as $child) {
		//	if ($child->getIsActive()) {
		//		$activeCategories[] = $child;
		//	}
		//}
		//$activeCategoriesCount = count($activeCategories);
		//$hasActiveCategoriesCount = ($activeCategoriesCount > 0);
		//
		////no active categories - exit
		//if (!$hasActiveCategoriesCount) {
		//	return array();
		//}

		//build up an array of active categories as value / label array
		$ret = array();
		$ret[] = array(
			'value' => '',
			'label' => 'Select a Product'
		);
		foreach ($this->getStoreProducts() as $product) {			
			
				$ret[] = array(
					'value' => $product->getId(),
					'label' => $product->getName().' [ SKU # '.$product->getSku().' ]'
				);
		}
		return $ret;
	}

	

	/**
	 * Get categories of current store
	 *                       
	 * @return Varien_Data_Collection_Db
	 */
	public function getStoreProducts() 
	{
		$collection =  Mage::getModel('catalog/product')->getCollection()->addAttributeToSelect(array('name','id'))
						    ->addAttributeToFilter('status', 1) // enabled
						    ->addAttributeToFilter('visibility', 4) //visibility in catalog,search
						    ;
		return $collection;
	}
}