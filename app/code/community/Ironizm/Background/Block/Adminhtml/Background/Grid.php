<?php

class Ironizm_Background_Block_Adminhtml_Background_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('backgroundGrid');
      $this->setDefaultSort('background_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('background/background')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('background_id', array(
          'header'    => Mage::helper('background')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'background_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('background')->__('Page Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));
      
      
       
        $this->addColumn('bg_type', array(
          'header'    => Mage::helper('background')->__('Page Type'),
          'align'     =>'left',
          'index'     => 'bg_type',
      ));
    
      $this->addColumn('filename', array(
          'header'    => Mage::helper('background')->__('Image '),
          'align'     =>'left',
	  'filter'    => false,
          'index'     => 'filename',
	  'renderer' => 'Ironizm_Background_Block_Adminhtml_Template_Grid_Renderer_Image',
      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('background')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

      $this->addColumn('status', array(
          'header'    => Mage::helper('background')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('background')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('background')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('background_id');
        $this->getMassactionBlock()->setFormFieldName('background');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('background')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('background')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('background/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('background')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('background')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}