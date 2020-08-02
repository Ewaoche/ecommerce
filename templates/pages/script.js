function payPageWithPaystack(){
    const api = "pk_test_765a437d32253a34e3a51082aad3dcd54d5dc00a";
      var handler = PaystackPop.setup({
        key: api,
        email: radicemmy@gmail.com,
        amount: 50,
        currency: "NGN",
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        firstname: 'emmaunel',
        lastname: 'emmaunel'
        // label: "Optional string that replaces customer email"
        metadata: {
           custom_fields: [
              {
                  display_name: "First Name:",
                  variable_name: "first_name",
                  value: 'Emmanuel'
              },
               {
                  display_name: "Last Name:",
                  variable_name: "last_name",
                  value: 'Emmanuel'
              },
              
               {
                  display_name: "Amoun of money transfered",
                  variable_name: "Amount",
                  value: 50
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
