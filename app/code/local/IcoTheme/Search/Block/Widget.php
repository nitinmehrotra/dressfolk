<?php
/**
 * @copyright   Copyright (C) 2015 IcoTheme.com. All Rights Reserved.
 */

class IcoTheme_Search_Block_Widget extends Mage_Core_Block_Template{
    protected function _construct(){
        parent::_construct();
        if (Mage::getStoreConfigFlag('icosearch/general/enable')){
            $this->setTemplate('icotheme/search/widget.phtml');
        }else{
            $this->setTemplate('catalogsearch/form.mini.phtml');
        }
    }

    public function getCategories(){
        $categories = array();
        $rootCategory = Mage::app()->getGroup()->getRootCategoryId();

        $collection = Mage::getResourceModel('catalog/category_collection')
            ->setStore(Mage::app()->getStore())
            ->addIsActiveFilter()
            ->addNameToResult()
            ->addFieldToFilter('parent_id', array('eq' => $rootCategory));

        foreach ($collection as $category){
            $categories[$category->getId()] = $this->escapeHtml($category->getName());
        }

        return $categories;
    }

    public function getCurrentCategory(){
        $module = $this->getRequest()->getModuleName();
        if ($module == 'catalogsearch'){
            return $this->getRequest()->getParam('cat');
        }
        return null;
    }
}
