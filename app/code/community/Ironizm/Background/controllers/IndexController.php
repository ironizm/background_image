<?php
class Ironizm_Background_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/background?id=15 
    	 *  or
    	 * http://site.com/background/id/15 	
    	 */
    	/* 
		$background_id = $this->getRequest()->getParam('id');

  		if($background_id != null && $background_id != '')	{
			$background = Mage::getModel('background/background')->load($background_id)->getData();
		} else {
			$background = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($background == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$backgroundTable = $resource->getTableName('background');
			
			$select = $read->select()
			   ->from($backgroundTable,array('background_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$background = $read->fetchRow($select);
		}
		Mage::register('background', $background);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}