<?php

class Elgentos_MyFavorites_Block_Customer_Account_Favorites extends Mage_Core_Block_Template {
        
    public function getCustomer()
    {
        return Mage::getSingleton('customer/session')->getCustomer();
    }   
    
    public function getFavorites() {
        return Mage::helper('myfavorites')->calculateFavorites($this->getCustomer());
    } 
    
}
