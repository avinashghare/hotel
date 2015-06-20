<!DOCTYPE html>
<html lang=''>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <title>Reservation Confirmation</title>
    <link rel='shortcut icon' href=''>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css'>
    <style>
        @font-face {
            font-family: 'Verdana';
            src: url('fonts/Verdana.ttf');
            font-weight: normal;
        }
        
        @font-face {
            font-family: 'Monotype Corsiva';
            src: url('fonts/MTCORSVA.ttf');
            font-weight: normal;
        }
        
        body {
            padding-top: 50px;
            font-family: 'Tinos', serif;
        }
        
        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
        
        .hd {
            background: #948a54;
            text-align: center;
            font-family: 'monotype corsiva';
            color: #ffff00;
        }
        
        .hd p {
            font-size: 35px;
            text-decoration: underline;
            border: 1px solid black;
        }
        
        .dear p {
            font-family: 'verdana';
            font-size: 17px;
        }
        
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border: 1px solid black;
            border-collapse: separate;
            font-family: 'verdana';
            font-size: 17px;
        }
        
        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border: 1px solid black;
        }
        
        .fot p {
            font-family: 'verdana';
            font-size: 17px;
        }
        
        .fots {
            padding-top: 30px;
        }
        
        .fots p {
            font-family: 'monotype corsiva';
            font-size: 25px;
            line-height: 20px;
        }
        .cont{
        padding-top: 10px;
        }
        .cont p {
  font-family: 'times new roman';
  font-size: 15px;
            font-weight: bold;
}
    </style>

    <link href='http://fonts.googleapis.com/css?family=Tinos:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <!--[if IE]>
        <script src='https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js'></script>
        <script src='https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js'></script>
    <![endif]-->

</head>

<body>

    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='hd'>
                    <p>Reservation Confirmation</p>
                </div>
                <div class='dear'>
                    <p style='font-weight:bold'>
                        Dear <?php echo $table->username;?>,
                    </p>
                    <p>Thank you for your reservation request and we are pleased to confirm that we are holding the following accommodations for you. Please review this information to insure your understanding is the same as ours:-</p>
                </div>
                <div class='tbl'>
                    <table class='table table-striped'>

                        <tbody>
                            <tr>
                                <th>Resort Name</th>
                                <th><?php echo $table->hotelname;?></th>


                            </tr>



                            <tr>
                                <td>COMPANY NAME: -</td>
                                <td></td>

                            </tr>
                            <tr>
                                <th>CONTACT PERSON:-</th>
                                <th><?php echo $table->username;?></th>
                            </tr>
                            <tr>
                                <th>Guest PERSON (If Any):-</th>
                                <th><?php echo $table->guestname;?></th>
                            </tr>
                            <tr>
                                <td>Guest Mobile number:<?php echo $table->mobile;?></td>
                                <td>Voucher No:- <?php echo $table->vouchernumber;?></td>

                            </tr>
                            <tr>
                                <th>Check In Date:</th>
                                <th><?php echo $table->checkin;?></th>


                            </tr>
                            <tr>
                                <th>Check Out Date:-</th>
                                <th><?php echo $table->checkout;?></th>


                            </tr>
                            <tr>
                                <td>Number of Guests:</td>
                                <td><?php echo $table->adult;?> Adults + <?php echo $table->children;?> Child</td>

                            </tr>
                            <tr>
                                <td>Tariff per person:-</td>
                                <td></td>

                            </tr>
                            <tr>
                                <td>Check-in Time:</td>
                                <th><?php echo $table->checkintime;?></th>

                            </tr>
                            <tr>
                                <td>Check-out Time:</td>
                                <th><?php echo $table->checkouttime;?></th>

                            </tr>
                            <tr>
                                <th>No of Rooms</th>
                                <th><?php echo $table->rooms;?></th>
                            </tr>
                            <tr>
                                <th>Total :- Full Amt. Paid
                                    <br> Advance :- Full Amt. Paid
                                    <br> Balance :- Rs. 0/-
                                </th>
                                <td></td>
                            </tr>
                            <tr>
                                <td>FOOD PACKAGE:</td>
                                <th><?php echo $table->foodpackage;?></th>
                            </tr>
                            <tr>
                                <td>Extra:</td>
                                <th><?php echo $table->extra;?></th>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Note: Please carry valid Photo Id & Address Proof
                                    <br> Like –Aadhar card, Driving license, Passport or
                                    <br> Voter ID (except Pancard) Of all guests.. Issued by
                                    <br>Central /State Government..</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class='fot'>
                    <p>We are eagerly anticipating your arrival and would like to advise you of the following in order to help you with your trip planning:</p>
                    <p>We look forward to the pleasure of having you as our guest at My Holidays. If you have any Quarry & questions, please call us at <span style='font-weight:bold'>9920847014/15  Between Monday to Saturday Between 10.00 Am to 6.00 Pm</span> Cordially,</p>
                </div>
                <div class='fots'>
                    <p>Sincerely</p>
                    <p>My Holidays</p>
                </div>
                <div class='fots'>
                    <p>Signature</p>
                    <p><?php echo $table->adminname;?></p>
                </div>
                <div class='cont'>
                    <p>NOTE:- IF THE PAX INCREASES, KINDLY PAYTHE AMOUNT  IN THE MY HOLIDAYS BANK ACCOUNT OR MY HOLIDAYS OFFICE  AND INFORM ATLEAST BEFORE 36 HOURS. IF THE PAX DECREASES FOR ANY REASON MY HOLIDAYS WILL NOT ABLE TO GIVE YOU ANY CANCELLATION AMOUNT WHICH HAS DEPOSITED BY YOU.ONCE  YOU DONE THE BOOKING  IT CAN NOT BE CANCELLED,CAN NOT  BE FILTER OR POSPONED IN ANY CERCUMSTANCES.</p>
                    <p style='font-family:'monotype corsiva';font-size:22px;padding-bottom:10px;color:#984806;'><?php echo $table->hoteladdress;?></p>
                </div>
            </div>
        </div>
    </div>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
    <script>
        $(window).load(function () {
            window.print();
        });
    </script>
</body>

</html>