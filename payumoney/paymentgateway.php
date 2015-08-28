<!--
<?php

$posted = array();

if(!empty($_GET)) {
  foreach($_GET as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}
print_r($posted);
?>
<html>
  <head>
  <script>
    function submitPayuForm() {
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()" style="display:none">
    <h2>PayU Form</h2>
    <form action="http://localhost/hotel/payumoney/PayUMoney_form.php" method="post" name="payuForm">
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
        </tr>
        <tr>
          <td>Product Info: </td>
          <td colspan="3"><textarea name="productinfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea></td>
        </tr>
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
            <td colspan="4"><input type="submit" value="Submit" /></td>
        </tr>
      </table>
    </form>
  </body>
</html>-->






<?php

$posted = array();

if(!empty($_GET)) {
  foreach($_GET as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}
print_r($posted);
?>
<html>
  <head>
  <script>
    function submitPayuForm() {
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()" style="display:none">
    <h2>PayU Form</h2>
    <form action="http://localhost/hotel/payumoney2/payumoney_aggregator_form.php" method="post" name="payuForm">
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
        </tr> 
        
        <tr>
          <td>Product Info: </td>
          <td colspan="3"><textarea name="productinfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea></td>
        </tr> 
          <tr>
          <td>Address: </td>
          <td colspan="3"><textarea name="address1"><?php echo (empty($posted['address1'])) ? '' : $posted['address1'] ?></textarea></td>
        </tr>
            <tr>
          <td>City: </td>
          <td><input name="city" id="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" /></td>
          <td>Zipcode: </td>
          <td><input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></td>
        </tr>  
          <tr>
          <td>State: </td>
          <td><input name="state" id="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
          <td>Country: </td>
          <td><input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" /></td>
        </tr>
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?php echo (empty($posted['furl'])) ? '' : base64_decode($posted['furl']) ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
            <td colspan="4"><input type="submit" value="Submit" /></td>
        </tr>
      </table>
    </form>
  </body>
</html>
