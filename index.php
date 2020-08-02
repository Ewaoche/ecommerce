<?php
define('DOT', '.');
require_once DOT . "/bootstrap.php";

//Home page//
$Route->add('/ecommerce/', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    
    $Template->assign("title", "ecommerce | Home");
    $getMenus = $Template->assign('getMenus', $Core->getMenus());
    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->render("home");
    
}, 'GET');
//Register page//
$Route->add('/ecommerce/pages/{slug}', function ($slug) {

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    
    $Template->assign("title", "{$slug}");
    $getMenus = $Template->assign('getMenus', $Core->getMenus());

    $Template->addheader("layouts.header");
    $Template->addfooter("layouts.footer");
    $Template->assign('menuslug', $slug);

    $Template->render("pages.{$slug}");

    
}, 'GET');

//Main Register page//
$Route->add('/ecommerce/forms/{action}', function ($action) {

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    $Template->assign("title", "{$action}");

    if($action == 'register'){

        $registerdata = $Core->post($_POST);
        //  $Core->debug($registerdata);
   
       $Core->RegisterCustomers($registerdata->fname, $registerdata->lname, $registerdata->email, $registerdata->phone, $registerdata->password,  $registerdata->account_name, $registerdata->account_number, $registerdata->gender );
       $Template->redirect('/ecommerce/pages/login');

    }
    elseif($action == 'login'){
        if(isset($_POST['submit'])){

              

            $Logindata = $Core->post($_POST);
    
            $customer_phone = $Logindata->phone;
            $customer_password = $Logindata->password;
            $getCustomer = $Core->getCustomer($customer_phone);

            $admin_password = $Logindata->password;
            $admin_phone = $Logindata->phone;

            $getAdmin = $Core->getAdmin();

            //   $Core->debug( $getAdmin);

            if($getCustomer->phone === $customer_phone && $getCustomer->password === $customer_password){

                if((int)$getCustomer->id){
                

                    $Template->data[auth_session_key] = true;
                    $Template->data["id"] = $getCustomer->id;
                   $Template->data["firstname"] = $getCustomer->fname;
                   $Template->data["lastname"] = $getCustomer->lname;
                   $Template->data["email"] = $getCustomer->email;
                   $Template->data["phone"] = $getCustomer->phone;
                   $Template->data["withdrable"] = $getCustomer->withdrable_money;
                   
                   $Template->save();

                   $Template->addheader("layouts.dashboardheader");
                    $Template->addfooter("layouts.dashboardfooter");
                    
                    

                   $Template->redirect('/ecommerce/dashboard');

                   }
                   

            }
            elseif( $getAdmin->phone == $Logindata->phone && $getAdmin->password == $Logindata->password){
                
                $Template->data[auth_session_key] = true;
                $Template->data["id"] = $getCustomer->id;
               $Template->data["username"] = $getAdmin->username;                         
                $Template->save();

               $Template->addheader("layouts.dashboardheader");
                $Template->addfooter("layouts.dashboardfooter");
                
               
               $Template->redirect('/ecommerce/dashboard');
            }
            else{
                $Template->redirect('/ecommerce/pages/login');

            }
          
    
        }


    }

    
}, 'POST');

$Route->add('/ecommerce/dashboard', function () {

    $Core = new Apps\Core;
    $Template = new Apps\Template('/ecommerce/');

    

    $Template->assign("title", " dashboard");
    $Template->addheader("layouts.dashboardheader");
    $Template->addfooter("layouts.dashboardfooter");

    

   
      // admin data
      if(isset($Template->data["username"])){
        $Template->assign("username",$Template->data["username"]);

      }
      else{
        $Template->assign("firstname",$Template->data["firstname"]);
        $Template->assign("lastname",$Template->data["lastname"]);
        $Template->assign("email",$Template->data["email"]);
    
        $Template->assign("withdrable",$Template->data["withdrable"]);
        // $Template->assign("Amount",$Template->data["Amount"]);

      }
      $Template->data[auth_session_key] = true;
   
      $Template->data["Amount"] = 0; 
      $Template->data["desti_bank"] = ''; 
      $Template->data["desti_bankaccount"] = ''; 
                          
      $Template->save();

      $Template->render("dashboard");

}, 'GET');


$Route->add('/ecommerce/exit', function(){
    $Template = new Apps\Template;
    $Template->expire();
    $Template->redirect('/ecommerce/');
},'GET');

$Route->add('/ecommerce/transaction/forms/{action}', function($action){
    $Template = new Apps\Template('/ecommerce/');
    $Core = new Apps\Core;

    $paymentform = $Core->post($_POST);
    $Amount = $paymentform->amount;

    $desti_bank = $paymentform->desti_bank;
    $desti_bankaccount = $paymentform->desti_bankaccount;

    $Template->data[auth_session_key] = true;
   
    //session funding account info
    $Template->data["Amount"] = $Amount; 

    //session transfer info
    $Template->data['desti_bank'] = $desti_bank;
    $Template->data['desti_bankaccount'] = $desti_bankaccount;

                  
    $Template->save();


    $Template->redirect('/ecommerce/transaction/pay');

   
},'POST');

$Route->add('/ecommerce/transaction/{transac}', function($transac){
    $Template = new Apps\Template('/ecommerce/');
    $Core = new Apps\Core;

   $Template->assign("title", "{$transac}");
  
    $Template->assign("firstname",$Template->data["firstname"]);
    $Template->assign("lastname",$Template->data["lastname"]);
    $Template->assign("email",$Template->data["email"]);
    $Template->assign("phone",$Template->data["phone"]);

     //assign desti  value to transfer money to page
    $Template->assign("desti_bank",$Template->data["desti_bank"]);
    $Template->assign("desti_bankaccount",$Template->data["desti_bankaccount"]);

    
     //assign amount value to fund my account to page
    $Template->assign("Amount",$Template->data["Amount"]);

   
    $Template->addheader("layouts.dashboardheader");
    $Template->addfooter("layouts.dashboardfooter");

    $Template->render("pages.{$transac}");

},'GET');


$Route->add('/ecommerce/transaction/pay', function(){
    $Template = new Apps\Template;
    $Core = new Apps\Core;
    
   $Template->assign("title", "funding");
    $Template->addheader("layouts.dashboardheader");
    $Template->addfooter("layouts.dashboardfooter");
    $Template->render("pages.pay");

     

},'GET');


$Route->add('/ecommerce/transaction/payment/executescript', function(){
    $Core = new Apps\Core;
    $Template = new Apps\Template;

    $Template->addheader("layouts.dashboardheader");
    $Template->addfooter("layouts.dashboardfooter");
    $Template->render('/ecommerce/transaction/payment/success');


}, 'GET');

$Route->add('/ecommerce/transaction/payment/success', function(){
    $Core = new Apps\Core;
    $Template = new Apps\Template;
    // $_GET['reference']
    $otp = $Core->GenOTP();
    $reference = $otp;
    $firstname = $Template->data["firstname"];
    $lastname = $Template->data["lastname"];
    $Amount =   $Template->data["Amount"];

    $desti_bank =   $Template->data["desti_bank"];
    $desti_bankaccount =   $Template->data["desti_bankaccount"];

    if($desti_bankaccount == '' &&  $desti_bank == ''){

        $getWithdrableAmount = $Core->getWithdrableAmount($firstname, $lastname);
        $Core->debug($getWithdrableAmount);

    }
        
    $Core->creditWallet($firstname, $lastname, $Amount, $reference);

    $getWallet = $Core->getWallet($reference );
    $getCustomerByName = $Core->getCustomerByName($firstname);

       $withdrable_money = $getCustomerByName->withdrable_money;
       $amount = $getWallet->amount;  

    $Core->updateCustomerWallet($withdrable_money , $amount);

    $Template->assign('getWallet', $getWallet);

    $Template->assign('firstname', $firstname);
    $Template->assign('lastname', $lastname);
    $Template->addheader("layouts.dashboardheader");
    $Template->addfooter("layouts.dashboardfooter");
    
    $Template->render('pages.success');


}, 'GET');

$Route->run('/');
