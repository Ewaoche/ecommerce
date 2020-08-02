
    <?php if(isset($firstname)):?>

        <div class="row gutter ">
         <div class="col-lg-5 col-md-5 col-sm-9 col-xs-12 ">
             <div class="panel no-border height2 panel-bg-two ">
                 <div class="panel-body ">
                     <div class="user-profile clearfix">
                         <div class="user-img"><img src="<?= $assets ?>dashboard/user.png" alt="" srcset=""><span class="completed-info hide">1</span></div>
                         <h5 style="margin:5px auto">Welcome To Home Manager</h5>
                         <h2 style="margin:5px auto"><?=  (isset($firstname))? $firstname : $username ?> <?=  (isset($lastname))? $lastname :'' ?><br /><font color=\"#F30\"></font> </h2>
                     </div>
                 </div>
             </div>
         </div>
         
         <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
         </div>
  
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
             <div class="row gutter">
                 <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                     <div class="panel no-border height1 yellow-bg">
                         <div class="panel-body text-center">
                             <a class="user-stats text-center"> 
                                 <div><i class="icon-cog2 icon-4x text-white"></i></div>
                                 <h3 class= "text-center"><strong>Account Information</strong></h3>
                                 <h3><?= (isset($withdrable))? $Core->ToMoney($withdrable) : ""  ?></h3>
                                 <h5>Withdrable Money</h5>
                             </a>
                         </div>		
                     </div>
                 </div>
            
             </div>
         </div>
     
     </div>
     <?php elseif(isset($username)):?>
     
    <h2> All Customers below!</h2>
  <table>
    <tr>
        <th> Summary </th>
    </tr>
    <tr>
        <td>First Name :  </td>
    </tr>
    <tr>
        <td>Last Name : </td>
    </tr>
    <tr>
        <td>Amount : </td>
    </tr>
    <tr>
        <td>Reference Code : </td>
    </tr>
    <tr>
        <td>Date :  </td>
    </tr>
    
    <tr>
        <td><a href="#">Download Now!</a> </td>
    </tr>
</table>


<?php endif;?>