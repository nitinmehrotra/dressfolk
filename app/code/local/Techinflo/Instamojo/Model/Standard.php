<?php
/**
* Package: Techinflo_Instamojo
* Edition: Community
* Version: 1.0.0
* Developer: Sampath Kumar<Techinflo Team>
*/ 

class Techinflo_Instamojo_Model_Standard extends Mage_Payment_Model_Method_Abstract {
	protected $_code = 'instamojo';
	
	protected $_isInitializeNeeded      = true;
	protected $_canUseInternal          = true;
	protected $_canUseForMultishipping  = false;
	
	public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('instamojo/payment/redirect', array('_secure' => true));
	}
}
?>