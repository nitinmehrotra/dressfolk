<?php
/**
* Package: Techinflo_Instamojo
* Edition: Community
* Version: 1.0.0
* Developer: Sampath Kumar<Techinflo Team>
*/ 

class Techinflo_Instamojo_Helper_Data extends Mage_Core_Helper_Abstract
{	/**
	* Get/Generate signature key for the current order object
	* @return type string
	*/
    public function generateSecureKey(){
	    $_order = $this->getCurrentOrder();
		//$orderIncId = $this->getOrderIncId($_order);
		$userName = $this->getUserName($_order);
		$privateSalt = $this->getPrivateSalt();
		$orderAmt = $this->getGrandTotal($_order);
		$userEmail = $this->getUserEmail($_order); 
		$userPhone = $this->getUserPhone($_order);
		//$message = $orderAmt.'|'.$userEmail.'|'.$orderIncId.'|'.$userName.'|'.$userPhone;
		$message = $orderAmt.'|'.$userEmail.'|'.$userName.'|'.$userPhone;
		$signature = hash_hmac('sha1', $message, $privateSalt);
		return $signature;
	}
	/**
	* Get customer full name using the current order object
	* @return type string
	*/
	public function getUserName($_order){
		if(is_object($_order)){
			$userName = $_order->getCustomerFirstname(). ' ' .$_order->getCustomerLastname();
			return $userName;
		}
		return;
	}
	/**
	* Get current order customer email id using order object
	* @retrun type string
	*/
	public function getUserEmail($_order){
		if(is_object($_order)){
			$userEmail = $_order->getCustomerEmail();
			return $userEmail;
		}
		return;
	}
	/**
	* Get current order customer telephone number using order object
	* @return type string
	*/
	public function getUserPhone($_order){
		if(is_object($_order)){
			$userPhone = $_order->getShippingAddress()->getTelephone();
			return $userPhone;
		}
		return;
	}
	/**
	* Get instamojo private salt element from configuration settings
	* @return type string
	*/
	public function getPrivateSalt(){
		$salt = Mage::getStoreConfig('payment/instamojo/salt');
		return $salt;
	}
	/**
	* Get instamojo private api key element from configuration settings
	* @return type string
	*/
	public function getPrivateApiKey(){
		$apikey = Mage::getStoreConfig('payment/instamojo/apikey');
		return $apikey;
	}
	/**
	* Get instamojo private auth token element from configuration settings
	* @return type string
	*/
	public function getPrivateAuth(){
		$authtoken = Mage::getStoreConfig('payment/instamojo/auth');
		return $authtoken;
	}
	/**
	* Get order increment id using order object
	* @return type long int
	*/
	public function getOrderIncId($_order){
	   if(is_object($_order)){
			$IncrementId = $_order->getIncrementId();
			return $IncrementId;	
       }
	   return;
	} 
	/**
	* Get grand total using the order object
	* @return type float
	*/
    public function getGrandTotal($_order){
		if(is_object($_order)){
			$grandTotal = str_replace(',', '', number_format($_order->getBaseGrandTotal(), 2));
			return $grandTotal;
		}
		return;
    }	
	/**
	* Get Instampjo payment link from configuration settings
	* @return type string
	*/
	public function getLinkUrl(){
		$linkUrl = Mage::getStoreConfig('payment/instamojo/linkurl');
		return $linkUrl;
	}
	/**
	* Get current user order id using checkout session
	* @return long int
	*/
	public function getCurrentOrderId(){
		$_id = Mage::getSingleton('checkout/session')->getLastRealOrderId();
		return $_id;
	}
	/** 
	* Load current user order using last real order id
	*  @return type object
	*/
	public function getCurrentOrder(){
		$_orderid = $this->getCurrentOrderId();
		if($_orderid){
			$_order = Mage::getModel('sales/order')->loadByIncrementId($_orderid);
			return $_order;
		}
		return;
	}
	
	/**
	* Get instamojo payment details using the payment id
	* @ return type array 
	*/
	public function getPaymentDetail($payment_id){
		if($payment_id){
			$apikey = $this->getPrivateApiKey();
			$authtoken = $this->getPrivateAuth();
			$ch = curl_init('http://www.instamojo.com/api/1.1/payments/'.$payment_id);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Api-Key: '. $apikey,
			'X-Auth-Token: '. $authtoken
			));
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
			curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");     
			$response = json_decode(curl_exec($ch));
			curl_close($ch);
			$responseArr = (array)$response->payment;
			$payment_info =array();
			foreach($responseArr as $key=>$value){
				if(!is_object($value))
					$payment_info[$key]=$value;
			}
			return $payment_info;
		}
	   return;
	}
}