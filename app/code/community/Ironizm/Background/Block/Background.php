<?php
class Ironizm_Background_Block_Background extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getBackground()     
     { 
        if (!$this->hasData('background')) {
            $this->setData('background', Mage::registry('background'));
        }
        return $this->getData('background');
        
    }
    
     protected function _getCollection()
    {
		$collection=Mage::getResourceModel('background/background_collection')
		->addFieldToFilter('status',1);
			
		$ccontrollername = Mage::app()->getFrontController()->getRequest()->getControllerName();
		$cmodulename = Mage::app()->getFrontController()->getRequest()->getModuleName();

		if($ccontrollername=='category' || $ccontrollername=="product"){
			 $currentcategory = Mage::registry('current_category');
			 if( $ccontrollername=="product"){				
				$currentproduct=Mage::registry('current_product'); //echo "<pre>";
				$id=$this->getRequest()->getParams();
				
				$pageid= isset($currentproduct) ? $currentproduct->getId() : $id['id'] ;
				
				$collection->addFieldToFilter('page_id_value',"{$pageid}");
				$collection->addFieldToFilter('bg_type',"product");
			}else{				
				$collection->addFieldToFilter('page_id_value',"{$currentcategory->getEntityId()}");
				$collection->addFieldToFilter('bg_type',"category");
			}
					  
		}
		
		if($cmodulename=="cms"){
			$pageid = Mage::getSingleton('cms/page')->getId();
			$collection->addFieldToFilter('page_id_value',"{$pageid}");
			$collection->addFieldToFilter('bg_type',"{$cmodulename}");
		}
		
		if($ccontrollername=="cart"){
			
			
			$collection->addFieldToFilter('bg_type',"{$ccontrollername}");
		}
		if($ccontrollername=="onepage"){
			
			
			$collection->addFieldToFilter('bg_type',"{$ccontrollername}");
		}
		if($collection->getSize()==0)
		{ 	$collection=Mage::getResourceModel('background/background_collection')
				     ->addFieldToFilter('status',1)
				     ->addFieldToFilter('bg_type',"default");
		}
		
		
		
		$collection->getSelect()->order('background_id','ASC');
		$collection->getSelect()->limit(1);
		
		return $collection;
	
    }

    public function getBackgroundCollection()
    {	   
	    if (is_null($this->_backgroundCollection)) {
            $this->_backgroundCollection = $this->_getCollection();
        }
        return $this->_backgroundCollection;
    }

    public function getImageUrl($url)
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'backgroundImage/'.$url;
    }	
    
}
