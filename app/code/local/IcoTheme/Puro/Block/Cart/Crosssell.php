<?php
class IcoTheme_Puro_Block_Cart_Crosssell extends Mage_Checkout_Block_Cart_Crosssell
{
    public function setLimit($limit){
        $this->_maxItemCount = $limit;
    }
}