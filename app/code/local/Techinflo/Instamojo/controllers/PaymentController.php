<?php
/**
* Package: Techinflo_Instamojo
* Edition: Community
* Version: 1.0.0
* Developer: Sampath Kumar<Techinflo Team>
*/ 
class Techinflo_Instamojo_PaymentController extends Mage_Core_Controller_Front_Action {
	/**
	* Set redirect template once after customer places order
	*/
	public function redirectAction() {
		$this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template','instamojo',array('template' => 'instamojo/redirect.phtml'));
		$this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
	}
	
	/**
	* Set response received from instamojo payment gateway and display template
	*/
	public function responseAction() {
		  $payment_id = $this->getRequest()->getParam('payment_id');
		  $status = $this->getRequest()->getParam('status');
	      if($payment_id) {
				try{ 
				   if($status == "success"){ 			
						$response = Mage::helper('instamojo')->getPaymentDetail($payment_id); 
						Mage::getSingleton('checkout/session')->addSuccess('Payment Success: '. $payment_id);
						$order = Mage::getModel('sales/order')->getCollection()->addFieldToFilter('customer_email', $response["buyer_email"])->getLastItem();
						$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true, 'Payment Gateway has authorized the payment.');
						$order->sendNewOrderEmail();
						$order->setEmailSent(true);
						$order->save();
						$this->_redirect('checkout/onepage/success', array('_secure'=>true));	
						}else {
						 $this->_redirect('checkout/onepage/failure', array('_secure'=>true));
					}
			    } catch (Exception $e) {
					Mage::getSingleton('checkout/session')->addError('Payment Failed: '. $payment_id);
				}
		}else{  $this->cancelAction();
		      $this->_redirect('');
		}
	}	
	/*
	* cancel the order once after declining payment from the gateway
	*/
	public function cancelAction() {
        if (Mage::getSingleton('checkout/session')->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
            if($order->getId()) {
				$order->cancel()->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, 'Payment Gateway has declined the payment.')->save();
			}
        }
	}
}