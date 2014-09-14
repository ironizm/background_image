<?php

class Ironizm_Background_Model_Cms
{
   /**
     * Retrieve Categories Option array
     *
     * @return array
     */
	public function toOptionArray() 
	{
		//get a list of all active top level categories
		$ret = array();
		$ret[] = array(
			'value' => '',
			'label' => 'Select a CMS page'
		);
		foreach ($this->getCmsCollection() as $child) {
			if ($child->getData()) {
                           $data= $child->getData();
				$ret[] = array(
                                'value' => $data['page_id'],
                                'label' =>  $data['title']);
			}
		}
                
		return $ret;
	}

	
	/**
	 * Get CMS of current store
	 *                       
	 * @return Varien_Data_Collection_Db
	 */
	public function getCmsCollection() 
	{
		$collection = Mage::getModel('cms/page')->getCollection();
							$collection->load();
		return $collection;
	}
}