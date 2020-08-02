<?php

//Write your custome class/methods here
namespace Apps;
use \Apps\Model;
use stdClass;
use \Apps\Session;

class Core extends Model{
	
	public function __construct(){
		parent::__construct();
	}
	
   public function getMenus(){
	   $getMenus = mysqli_query($this->dbCon, "SELECT * FROM ecom_pages ");
	   return $getMenus;
   }

   public function RegisterCustomers($fname, $lname, $email, $phone, $password,  $account_name, $account_number , $gender){
	$RegisterCustomers =  mysqli_query($this->dbCon, "INSERT INTO ecom_customers(fname, lname, email, phone, password,  account_name, account_number , gender) VALUES('$fname', '$lname', '$email', '$phone', '$password',  '$account_name', '$account_number', '$gender')");
   }

   public function getCustomer($phone){
	   $getCustomer = mysqli_query($this->dbCon, "SELECT * FROM  ecom_customers WHERE phone = '$phone'");
	   $getCustomer = mysqli_fetch_object($getCustomer);
	   return $getCustomer;
   }
   public function getCustomerByName($firstname){
	   $getCustomerByName = mysqli_query($this->dbCon, "SELECT * FROM  ecom_customers WHERE fname = '$firstname'");
	   $getCustomerByName = mysqli_fetch_object($getCustomerByName);
	   return $getCustomerByName;
   }

   public function getAdmin(){
	   $getAdmin = mysqli_query($this->dbCon, "SELECT * FROM ecom_admin");
	   $getAdmin = mysqli_fetch_object($getAdmin);
	   return $getAdmin;

   }

  public function ToMoney($amount){
	$amount = number_format($amount,2,".",",");
	return "&#x20A6;" . $amount;
   }

   public function creditWallet($firstname, $lastname, $amount, $reference){
	$creditWallet = mysqli_query($this->dbCon, "INSERT INTO ecom_customer_wallet(firstname, lastname, amount, reference) VALUES('{$firstname}', '{$lastname}', '{$amount}', '{$reference}')");
	
   }
   
   


 

   public function GenOTP($length=10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return strtoupper($randomString);
}



public function updateCustomerWallet( $withdrable_money, $Money){
	 mysqli_query($this->dbCon," UPDATE ecom_customers SET withdrable_money =  withdrable_money + '$Money' WHERE withdrable_money ='$withdrable_money'");
	return (int)mysqli_affected_rows($this->dbCon);
}

public function getWallet($reference){
	$getWallet  = mysqli_query($this->dbCon, "SELECT * FROM ecom_customer_wallet WHERE reference = '{$reference }'");
	$getWallet = mysqli_fetch_object($getWallet);
	return $getWallet;

   }

   public function getWithdrableAmount($firstname, $lastname){
	   $getWithdrableAmount = mysqli_query($this->dbCon, "SELECT * FROM  ecom_customers  WHERE fname = '$firstname' && lname = '$lastname' ");
	   $getWithdrableAmount = mysqli_fetch_object($getWithdrableAmount);
	   return $getWithdrableAmount;
   }

 

}
?>
