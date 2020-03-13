<form id="orderform" action="checkout.php" class="billing-form bg-light p-3 p-md-5" method="post">
					<h3 class="mb-4 billing-heading">Billing Details</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
	                	<label for="firstname">Firt Name</label>
	                  <input id="firstname" name="firstname" type="text" class="form-control" placeholder="">
	                  <p class="shippingError error" id="firstname_error">* Required field</p>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname">Last Name</label>
	                  <input id="lastname" name="lastname" type="text" class="form-control" placeholder="">
	                  <p class="shippingError error" id="lastname_error">* Required field</p>
	                </div>
                </div>
                <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
		            	  <label for="province">Province</label>
		            		<div class="select-wrap">
		                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
		                  <select name="province" id="province" class="form-control">
		                  	<option value="AB">AB</option>
		                  	<option value="BC">BC</option>
		                  	<option value="MB">MB</option>
		                    <option value="NB">NB</option>
		                    <option value="NL">NL</option>
		                    <option value="NS">NS</option>
		                    <option value="ON">ON</option>
		                    <option value="PE">PE</option>
		                    <option value="QC">QC</option>
		                    <option value="SK">SK</option>
		                    <option value="NT">NT</option>
		                    <option value="NU">NU</option>
		                    <option value="YT">YT</option>
		                  </select>
		                </div>
		            	</div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="address">Street Address</label>
	                  <input id="address" name="address" type="text" class="form-control" placeholder="House number and street name">
	                  <p class="shippingError error" id="address_error">* Required field</p>
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                  <input id="address2" name="address2" type="text" class="form-control" placeholder="Appartment, suite, unit etc: (optional)">
	                  <p class="shippingError error" id="address2_error">&#8203;</p>
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity">Town / City</label>
	                  <input id="towncity" name="towncity" type="text" class="form-control" placeholder="">
	                  <p class="shippingError error" id="towncity_error">* Required field</p>
	                  <p class="shippingError error" id="address2_error">&#8203;</p>
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
		            		<label for="postal">Postcode</label>
	                  <input id="postal" name="postal" type="text" class="form-control" placeholder="">
	                  <p class="shippingError error" id="postal_error">* Required field</p>
	                  <p class="shippingError error" id="postalformat_error">* Invalid postal code</p>
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Phone</label>
	                  <input id="phone" name="phone" type="text" class="form-control" placeholder="">
	                  <p class="shippingError error" id="phone_error">* Required field</p>
	                  <p class="shippingError error" id="phoneformat_error">* Invalid Phone Number</p>
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="email">Email Address</label>
	                  <input id="email" name="email" type="text" class="form-control" placeholder="">
	                  <p class="shippingError error" id="email_error">* Required field</p>
	                  <p class="shippingError error" id="emailformat_error">* Invalid email address</p>
	                </div>
                </div>
                <div class="w-100"></div>

                <div class="col-md-6">
	                <div class="form-group">
	                	<p class="text-center"><button type="reset" class="btn btn-primary py-3 px-4">Clear Billing Details</button></p>
	                </div>
                </div>
                <div class="col-md-6">
	                <div class="form-group">
	                	<p class="text-center"><button type="submit" class="btn btn-primary py-3 px-4">Proceed To Pay</button></p>
	                </div>
                </div>

                <div class="col-md-3"><!-- 
                	<button class="btn-warning radius" type="reset" id="clear">Clear Billing Details</button> -->
                </div>
                
                <!-- <div class="col-md-12">
                	<div class="form-group mt-4">
						<div class="radio">
						  <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
						  <label><input type="radio" name="optradio"> Ship to different address</label>
						</div>
					</div>
                </div> -->
	            </div>
	          </form><!-- END -->