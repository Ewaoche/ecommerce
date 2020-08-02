


<h2>Hi, <?= $email ?></h2>
<?php if($desti_bank): ?>
  <h2>You want to tranfer <?= $Core->ToMoney($Amount) ?> to  <?= $desti_bank ?>  with Account Number <?= $desti_bankaccount ?></h2>
 
  <?php elseif($Amount):?>

<h2>You want to fund your wallet with  <?= $Core->ToMoney($Amount)  ?> ?</h2>

<?php endif;?>


<form action="" method="POST">
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <button name="sub" type="button" onclick="payPageWithPaystack()"> Proceed </button> 
  <li><a href="/ecommerce/transaction/payment/executescript" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>Question</a></li>

</form>

 
