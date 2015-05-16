<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Excel library for Code Igniter applications
* Based on: Derek Allard, Dark Horse Consulting, www.darkhorse.to, April 2006
* Tweaked by: Moving.Paper June 2013
*/
class transactionbyhotel{
    
    function to_excel($array, $filename,$hotelname) {
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename.'.xls');

     //    Filter all keys, theyll be table headers
        $h = array();
        foreach($array->result_array() as $row){
            foreach($row as $key=>$val){
                if(!in_array($key, $h)){
                 $h[] = $key;   
                }
                }
                }
                //echo the entire table headers
                echo '<table border="1">';
                if($hotelname=="")
                {
                }
                else
                {
                    echo '<tr ><td colspan="9" style="color:white;font-size:20px;text-align:center;background:red;">'.$hotelname.'</td></tr>';
                }
                echo '<tr>';
                foreach($h as $key) {
                    $key = ucwords($key);
                    echo '<th>'.$key.'</th>';
                }
        
//                echo '</tr>';
//                
//                foreach($array->result_array() as $row){
//                     echo '<tr>';
//                    foreach($row as $val)
//                         $this->writeRow($val);   
//                }
//                echo '</tr>';
//                echo '</table>';
                echo '</tr>';
//                print_r($array->result_array());
                foreach($array->result_array() as $rows){
//                    foreach($rows as $row)
//                    {
                     echo '<tr>';
                    echo "<td>".$rows['id']."</td>";
                    echo "<td>".$rows['paidto']."</td>";
                    echo "<td>".$rows['hotel']."</td>";
                    echo "<td>".$rows['amount']."</td>";
//                    echo "<td>";
                    if($rows['paymentmethod']=='Cash')
                    {
//                        echo 'Cash';
                        echo "<td>".$rows['paymentmethod']."</td>";
                    }
                    else
                    {
                        echo "<td>".$rows['paymentmethod']."</td>";
                        echo "<td>".$rows['bankname']."</td>";
                        echo "<td>".$rows['branchname']."</td>";
                        echo "<td>".$rows['chequeno']."</td>";
                        echo "<td>".$rows['chequedate']."</td>";
//                        echo "Cheque"." ".$rows['bankname']." ".$rows['branchname']." ".$rows['branchname']." ".$rows['chequeno']." ".$rows['chequedate'];
                    }
//                    echo "</td>";
//                    foreach($row as $val)
//                         $this->writeRow($val);
//                }
                echo '</tr>';
                }
                echo '</table>';
                
            
        }
    function writeRow($val) {
                echo '<td>'.utf8_decode($val).'</td>';              
    }

}
?>