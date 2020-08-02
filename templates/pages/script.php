
<script>
  function payPageWithPaystack(){
  const api = "pk_test_765a437d32253a34e3a51082aad3dcd54d5dc00a";
    var handler = PaystackPop.setup({
      key: api,
      email: "<?= $email ?>",
      amount: <?= $Core->ToMoney($Amount)  ?>,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      firstname: "<?= $firstname; ?>",
      lastname: "<?= $lastname; ?>",
      // label: "Optional string that replaces customer email"
      metadata: {
         custom_fields: [
            {
                display_name: "First Name:",
                variable_name: "first_name",
                value: "<?= $firstname; ?>"
            },
             {
                display_name: "Last Name:",
                variable_name: "last_name",
                value: "<?= $lastname; ?>"
            },
            
             {
                display_name: "Amoun of money transfered",
                variable_name: "Amount",
                value: "<?= $Core->ToMoney($Amount)  ?>  "
            }
         ]
      },
      callback: function(response){
           const referenced = response.reference;
		  window.location.href='success.php?successfullypaid='+ referenced;
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }

  payPageWithPaystack();
</script>
