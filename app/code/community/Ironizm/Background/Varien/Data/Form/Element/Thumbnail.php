<?php
        
    class Ironizm_Background_Varien_Data_Form_Element_Thumbnail extends Varien_Data_Form_Element_Abstract {
        
    public function __construct($data) {
        parent::__construct($data);
        $this->setType('file');
    }
 
    public function getElementHtml() {
        $html = '';
        if ($this->getValue()) {
            $url = $this->_getUrl();
            if( !preg_match("/^http\:\/\/|https\:\/\//", $url) ) {
                $url = Mage::getBaseUrl('media') . $url;
            }
            $html = '<a onclick="imagePreview(\''.$this->getHtmlId().'_image\'); return false;" href="'.$this->getValue().'"><img id="'.$this->getHtmlId().'_image" style="border: 1px solid #d6d6d6;" title="'.$this->getValue().'" src="'.$this->getValue().'" alt="'.$this->getValue().'" width="100"></a> ';
        }
        $this->setClass('input-file');
        $html.= parent::getElementHtml();
        return $html;
    }
 
    protected function _getUrl() {
        return $this->getValue();
    }
 
    public function getName() {
        return  $this->getData('name');
    }
    
    }