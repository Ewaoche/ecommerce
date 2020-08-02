  <!-- Start Products  -->
  <div class="products-box">
        <div class="container">
            
            <div class="row">
              <div class="col-lg-12">            
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Login</h3>
                        </div>

                        <form action="/ecommerce/forms/login" method="post" name="submit">
                            
                            <div class="mb-3">
                                <label for="username">Phone Number *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="phone" id="phone" value="<?php if(isset($_SESSION['phone'])) { echo $_SESSION['phone'];}?>" placeholder="Phone Number" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your Phone Number is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php if(isset($_SESSION['phone'])) { echo $_SESSION['phone'];}?>" placeholder="Password">
                                <div class="invalid-feedback"> Please enter Your Password. </div>
                            </div>
                       
                            <div class="row">
                           
                                <div class="col-md-6 mb-3">
                                  <input type="submit" Value="Next" name="submit" style="background:#F90; color:#000; font-family:Lucida Console; border:none; width:100px; height:50px; cursor:pointer; "/>
                                </div>
                            </div></form></div>
            </div>             
            </div>
        </div>
    </div>
    <!-- End Products  -->