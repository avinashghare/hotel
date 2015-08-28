<?php  
//Merchant key here as provided by Payu 
    $MERCHANT_KEY="8DwjFY" ; 
//Merchant Salt as provided by Payu
    $SALT="c4AYftqh" ; 
//End point - change to https://secure.payu.in for LIVE mode 
$PAYU_BASE_URL="https://test.payu.in" ; 
$action=''; 
$posted=array(); 
if(!empty($_POST)) { 
    foreach($_POST as $key=> $value) {
        $posted[$key] = $value; 
    } 
}
$formError = 0; 
if(empty($posted['txnid'])) { 
    //Generate random transaction id 
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20); 
}
else {
    $txnid = $posted['txnid'];
} 
$hash = ''; 
  $hashSequence = "key|txnid|amount|productinfo|firstname|email|address1|city|state|zipcode|country|phone|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
$posted['key']=5089108;
if(empty($posted['hash']) && sizeof($posted) > 0)
    { 
       echo $posted['key'];
        if( empty($posted['key']) 
           || empty($txnid) 
           || empty($posted['amount'])
           || empty($posted['productinfo'])
           || empty($posted['firstname']) 
           || empty($posted['email']) 
           || empty($posted['address1']) 
           || empty($posted['city']) 
           || empty($posted['state']) 
           || empty($posted['zipcode']) 
           || empty($posted['country']) 
           || empty($posted['phone'])
           || empty($posted['surl']) 
           || empty($posted['furl']) 
           || empty($posted['service_provider']) )
////Hash Sequence 
//    $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
//$posted['key']=5089108;
//if(empty($posted['hash']) && sizeof($posted) > 0)
//    { 
//       echo $posted['key'];
//        if( empty($posted['key']) || empty($txnid) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl']) || empty($posted['service_provider']) )
        { 
    $formError = 1;
} 
        else
        { 
    $posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]')); 
    $hashVarsSeq = explode('|', $hashSequence); $hash_string = ''; 
    foreach($hashVarsSeq as $hash_var) {
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : ''; $hash_string .= '|';
    } 
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string)); 
    $action = $PAYU_BASE_URL . '/_payment'; 
} 
} 
elseif(!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
} ?>
<html>

<head>
    <script>
        var hash = '<?php echo $hash ?>';

        function submitPayuForm() {
            if (hash == '') {
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
    <p><b>Mandatory Parameters</b>
    </p>
    <?php if($formError) { ?>

    <span style="color:red">Please fill all mandatory fields.</span>
    <br/>
    <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
        <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
        <input type="hidden" name="hash" value="<?php echo $hash ?>" />
        <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
        <table>
            <!--
            <tr>
                <td><b>Mandatory Parameters</b>
                </td>
            </tr>
-->
            <tr style="padding-bottom:10px;">
                <td style="width:40%">Amount:
                    <?php echo $posted[ 'amount'];?>
                </td>
                <td style="width:60%">
                    <input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" style="width:100%" />
                </td>
            </tr>
            <tr style="padding-bottom:10px;">
                <td style="width:40%">First Name: </td>
                <td style="width:60%">
                    <input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" style="width:100%" />
                </td>
            </tr>
            <tr style="padding-bottom:10px;">
                <td style="width:40%">Email: </td>
                <td style="width:60%">
                    <input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" style="width:100%" />
                </td>
            </tr>
            <tr style="padding-bottom:10px;">
                <td style="width:40%">Phone: </td>
                <td style="width:60%">
                    <input name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" style="width:100%" />
                </td>
            </tr>
            <tr style="display:none">
                <td>Product Info: </td>
                <td colspan="3">
                    <textarea name="productinfo">
                        <?php echo (empty($posted[ 'productinfo'])) ? '' : $posted[ 'productinfo'] ?>
                    </textarea>
                </td>
            </tr>
            <tr style="display:none">
                <td>Success URI: </td>
                <td colspan="3">
                    <input name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" />
                </td>
            </tr>
            <tr style="display:none">
                <td>Failure URI: </td>
                <td colspan="3">
                    <input name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" />
                </td>
            </tr>

            <tr style="display:none">
                <td colspan="3">
                    <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                </td>
            </tr>

            <tr style="display:none">
                <td><b>Optional Parameters</b>
                </td>
            </tr>
            <tr style="display:none">
                <td>Last Name: </td>
                <td>
                    <input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" />
                </td>
                <td>Cancel URI: </td>
                <td>
                    <input name="curl" value="" />
                </td>
            </tr>
            <tr style="padding-bottom:10px;">
                <td>Address1: </td>
                <td>
                    <input name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" />
                </td>

            </tr>
            <tr style="padding-bottom:10px;">
                <td>City: </td>
                <td>
                    <input name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" />
                </td>
                <td>State: </td>
                <td>
                    <input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" />
                </td>
            </tr>
            <tr style="padding-bottom:10px;">
                <td>Country: </td>
                <td>
                    <input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" />
                </td>
                <td>Zipcode: </td>
                <td>
                    <input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" />
                </td>
            </tr>
            <tr style="display:none">
                <td>UDF1: </td>
                <td>
                    <input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
                </td>
                <td>UDF2: </td>
                <td>
                    <input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
                </td>
            </tr>
            <tr style="display:none">
                <td>UDF3: </td>
                <td>
                    <input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" />
                </td>
                <td>UDF4: </td>
                <td>
                    <input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" />
                </td>
            </tr>
            <tr style="display:none">
                <td>UDF5: </td>
                <td>
                    <input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" />
                </td>
                <td>PG: </td>
                <td>
                    <input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" />
                </td>
            </tr>
            <tr>
                <?php if(!$hash) { ?>
                <td colspan="4">
                    <input type="submit" value="Submit" style="width:100% ; color:#FFF; border-color: #236bb2;
background-color: #3185D7;   padding: 0 12px;  min-width: 52px;  min-height: 47px; " />
                </td>
                <?php } ?>
            </tr>
        </table>
    </form>
</body>

</html>