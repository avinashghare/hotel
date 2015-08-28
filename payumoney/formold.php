<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "8DwjFY";

// Merchant Salt as provided by Payu
$SALT = "c4AYftqh";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://test.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}
$formError = 0;
$posted['key']=5089108;
if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
//$hashSequence = "key|txnid|amount|firstname|email|phone|address1|city|pincode|state|country|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
 $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
    print_r($posted);
  if(
          empty($posted['key'])
          || empty($txnid)
//          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['name'])
          || empty($posted['email'])
          || empty($posted['billingcontact'])
          || empty($posted['billingaddress'])
          || empty($posted['billingcity'])
          || empty($posted['billingpincode'])
          || empty($posted['billingstate'])
          || empty($posted['billingcountry'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
      
  ) {
      echo "in error";
    $formError = 1;
      
      
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
    <h2>PayU Form</h2>
    <br/>
    <?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="text" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="text" name="hash" value="<?php echo $hash ?>"/>
      <input type="text" name="txnid" value="<?php echo $txnid ?>" />
      <input type="text" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
      <b>Mandatory Parameters</b>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>Amount: <?php echo empty($posted['amount']);?></td>
          <td><input name="amount" id="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount']; ?>" /></td><br>
          <td>Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo (empty($posted['name'])) ? '' : $posted['name']; ?>" /></td><br>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td><br>
          <td>Phone: </td>
          <td><input name="phone" value="<?php echo (empty($posted['billingcontact'])) ? '' : $posted['billingcontact']; ?>" /></td><br>
        </tr>
        <tr>
          <td>Address: </td>
          <td colspan="3"><textarea name="address1"><?php echo (empty($posted['billingaddress'])) ? '' : $posted['billingaddress'] ?></textarea></td><br>
        </tr>
         <tr>
          <td>City: </td>
          <td><input name="city" id="city" value="<?php echo (empty($posted['billingcity'])) ? '' : $posted['billingcity']; ?>" /></td><br>
          <td>Zipcode: </td>
          <td><input name="zipcode" value="<?php echo (empty($posted['billingzipcode'])) ? '' : $posted['billingzipcode']; ?>" /></td><br>
        </tr>
        <tr>
          <td>State: </td>
          <td><input name="state" id="state" value="<?php echo (empty($posted['billingstate'])) ? '' : $posted['billingstate']; ?>" /></td><br>
          <td>Country: </td>
          <td><input name="country" value="<?php echo (empty($posted['billingcountry'])) ? '' : $posted['billingcountry']; ?>" /></td>
        </tr><br>
        <tr style="display:none">
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
        </tr><br>
        <tr style="display:none">
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" /></td>
        </tr><br>

        <tr style="display:none">
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr><br>

<!--
        <tr style="display:none">
          <td><b>Optional Parameters</b></td>
        </tr><br>
        <tr style="display:none">
          <td>Last Name: </td>
          <td><input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /></td>
          <td>Cancel URI: </td>
          <td><input name="curl" value="" /></td>
        </tr>
        <tr style="display:none">
          <td>UDF1: </td>
          <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
          <td>UDF2: </td>
          <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
        </tr>
        <tr style="display:none">
          <td>UDF3: </td>
          <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
          <td>UDF4: </td>
          <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
        </tr>
        <tr style="display:none">
          <td>UDF5: </td>
          <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
          <td>PG: </td>
          <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
        </tr>
-->
        <tr>
          <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Submit" /></td>
          <?php } ?>
        </tr>
    </form>
  </body>
</html>
