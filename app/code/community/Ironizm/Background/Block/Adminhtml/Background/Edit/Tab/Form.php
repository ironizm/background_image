<?php

class Ironizm_Background_Block_Adminhtml_Background_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('background_form', array('legend'=>Mage::helper('background')->__('Item information')));
     
     Mage::registry('background_data')->getId() ?  $value= true : $value= false;
      
      $fieldset->addField('bg_type', 'select', array(
          'label'     => Mage::helper('background')->__('Page Type '),
          'name'      => 'bg_type',
	  'class'      => 'bgtype',	  
	  'onchange' => 'checkSelectedItem(this.value)',
	  'disabled' => $value,
          'values'    => array(
              array(
                  'value'     => "default",
                  'label'     => Mage::helper('background')->__('Default [For all Pages]'),
              ),

              array(
                  'value'     => "cms",
                  'label'     => Mage::helper('background')->__('CMS Page'),
              ),
	      array(
                  'value'     => "category",
                  'label'     => Mage::helper('background')->__('Category'),
              ),
	      array(
                  'value'     => "product",
                  'label'     => Mage::helper('background')->__('Product'),
              ),
	      array(
                  'value'     => "cart",
                  'label'     => Mage::helper('background')->__('Cart'),
              ),
	      array(
                  'value'     => "onepage",
                  'label'     => Mage::helper('background')->__('Onepage'),
              ),
          ),      
	  ))->setAfterElementHtml("
                         <script type=\"text/javascript\">
                            
							function checkSelectedItem(selectAttribute){
								
								$$('.filterOptions').each(function(s) {
									$(s).up('tr').setStyle({ display: 'none' });
								});
								
								if(selectAttribute=='onepage' || selectAttribute=='cart'  || selectAttribute=='default' ){
								$$('[name=\"title\"]')[0].value = selectAttribute.charAt(0).toUpperCase()+ selectAttribute.substr(1).toLowerCase();
								return 0;
								
								}
								$(selectAttribute).up('tr').setStyle({ display: '' });
								
							}
							
							document.observe('dom:loaded', function() {
								$$('.filterOptions').each(function(s) {
									$(s).up('tr').setStyle({ display: 'none' });
									if($$('[name=\"title\"]')[0].value=='')
									$$('[name=\"title\"]')[0].value = 'Default';
								});
								
								var bannerType= $('bg_type')[$('bg_type').selectedIndex].value;
								
								if(bannerType !='default' && bannerType!='cart' && bannerType !='onepage'){ 
								$(bannerType).up('tr').setStyle({ display: '' });
								}
								var selectThis = $$('[name=\"page_id_value\"]')[0].value;
								
								$$('select#'+bannerType+' option').each(function(o) {
								  if(o.readAttribute('value') == selectThis) { 
									o.selected = true;
								  }
								});
								
							});
                         </script>");
      
      $fieldset->addField('page_id_value', 'hidden', array(
			'label'     => Mage::helper('background')->__('Page Type Value'),
			'class'     => 'page_id_value',
			'name'      => 'page_id_value',
			
		));     
       $fieldset->addField('title', 'hidden', array(
          'label'     => Mage::helper('background')->__('Title'),                
          'name'      => 'title',
	  'class'     => 'title',
      ));
      
      
      $fieldset->addField(
		    'category', 
			'select', 
			array(
				'label' 	=> Mage::helper('background')->__('Category'),								
				'name' 		=> 'page_id_cat',
				//'onclick' 	=> "return false;",
				'onchange' 	=> "checkSelectItemCat(this.value,category.options[category.selectedIndex].innerHTML)",
				'style'      => 'width:450px',
				'class' => 'filterOptions category',
				'values'    => Mage::getSingleton('Ironizm_Background_Model_Categories')->toOptionArray(),
				'disabled' => $value,
				'readonly' => false,
				'after_element_html' => '<small>Please select one Category</small>',
				'tabindex' => 1,			
			))->setAfterElementHtml("
                         <script type=\"text/javascript\">                            
							function checkSelectItemCat(selectAttribute,textVal){							
								$$('[name=\"title\"]')[0].value = textVal;								
								$$('[name=\"page_id_value\"]')[0].value = selectAttribute;
							}														
                         </script>"
			 );
		
      
      $fieldset->addField(
		    'cms', 
			'select', 
			array(
				'label' 	=> Mage::helper('background')->__('CMS'),								
				'name' 		=> 'page_id_cms',
				//'onclick' 	=> "return false;",
				'onchange' 	=> "checkSelectItemCms(this.value,cms.options[cms.selectedIndex].innerHTML)",				
				'class' => 'filterOptions cms',
				'values'    =>Mage::getSingleton('Ironizm_Background_Model_Cms')->toOptionArray(),
				'disabled' => $value,
				'readonly' => false,
				'after_element_html' => '<small>Please select one Cms page</small>',
				'tabindex' => 1,
			))->setAfterElementHtml("
                         <script type=\"text/javascript\">                            
							function checkSelectItemCms(selectAttribute,textVal){							
								$$('[name=\"title\"]')[0].value = textVal;								
								$$('[name=\"page_id_value\"]')[0].value = selectAttribute;
							}														
                         </script>"
			);
      $fieldset->addField(
		    'product', 
			'select', 
			array(
				'label' 	=> Mage::helper('background')->__('Product'),								
				'name' 		=> 'page_id',
				//'onclick' 	=> "return false;",
				'onchange' 	=> "checkSelectItemPrd(this.value,product.options[product.selectedIndex].innerHTML)",	
				'class' => 'filterOptions product',
				'values'    => Mage::getSingleton('Ironizm_Background_Model_Products')->toOptionArray(),
				'disabled' => $value,
				'readonly' => false,
				'after_element_html' => '<small>Please select one Product</small>',
				'tabindex' => 1,
			))->setAfterElementHtml("
                         <script type=\"text/javascript\">                            
							function checkSelectItemPrd(selectAttribute,textVal){							
								$$('[name=\"title\"]')[0].value = textVal;								
								$$('[name=\"page_id_value\"]')[0].value = selectAttribute;
							}														
                         </script>"
			);
      

      
      $fieldset->addType('thumbnail','Ironizm_Background_Varien_Data_Form_Element_Thumbnail');
 
      $fieldset->addField('image_url', 'thumbnail', array(
	  'label'     => Mage::helper('background')->__('Thumbnail'),
	  'name'      => 'filename',
	  'style'   => "display:none;",
      ));
		
		
		
      $fieldset->addField('filename', 'file', array(
		'label'     => Mage::helper('background')->__('Background Image'),
		'note'      => $note,
		'name'      => 'filename',
		//'after_element_html' => $img,
	 )); 
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('background')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('background')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('background')->__('Disabled'),
              ),
          ),
      ));
     
      //$fieldset->addField('content', 'editor', array(
      //    'name'      => 'content',
      //    'label'     => Mage::helper('background')->__('Content'),
      //    'title'     => Mage::helper('background')->__('Content'),
      //    'style'     => 'width:700px; height:500px;',
      //    'wysiwyg'   => false,
      //    'required'  => true,
      //));
     
      if ( Mage::getSingleton('adminhtml/session')->getBackgroundData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getBackgroundData());
          Mage::getSingleton('adminhtml/session')->setBackgroundData(null);
      } elseif ( Mage::registry('background_data') ) {
          $form->setValues(Mage::registry('background_data')->getData());
      }
      return parent::_prepareForm();
  }
}