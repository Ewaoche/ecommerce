
<div class="container">
<img src="<?= $assets ?>dashboard/img/eggs.jpg" alt="Cover Book">


<form action="/ecommerce/transaction/forms/payment" method="POST">

<label class= "text-center">First Name</label>
<input type="text" value= "<?= $firstname ?>" placeholder="First Name" name="first_name" required><br>

<label class= "text-center">Last Name</label>
<input type="text" value= "<?= $lastname ?>" placeholder="Last Name" name="last_name" required><br>


<label style= " margin-right: 180px;" >Credit Your Wallet</label>
<input  type="text"  placeholder="Enter the  Amount in Naira" name="amount" required><br>

<label style= " margin-right: 180px;">Email</label>
<input type="email" value= "<?= $email ?>" placeholder="Email" name="email" required>

<button class= "text-center">Credit!</button> 
</form> 
</div>