<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Excel library for Code Igniter applications
* Based on: Derek Allard, Dark Horse Consulting, www.darkhorse.to, April 2006
* Tweaked by: Moving.Paper June 2013
*/
class exporttransactionreportbyhotel{
    
    function to_excel($array, $filename,$array2) {
//        header('Content-type: application/vnd.ms-excel');
//        header('Content-Disposition: attachment; filename='.$filename.'.xls');

        $array2value=$array2->row();
        $amount=$array2value->amount;
        $hotelname=$array2value->hotelname;
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
                echo "<tr><td colspan='11' style='color:white;font-size:20px;text-align:center;background:red;'>".$hotelname."</td>";
                echo '</tr>';
                echo '<tr>';
                foreach($h as $key) {
                    $key = ucwords($key);
                    echo '<th>'.$key.'</th>';
                }
                echo '</tr>';
                
                foreach($array->result_array() as $row){
                     echo '<tr>';
                    foreach($row as $val)
                         $this->writeRow($val);   
                }
                echo '</tr>';
                echo '</table>';
                
            
        }
    function writeRow($val) {
                echo '<td>'.utf8_decode($val).'</td>';              
    }

}
?>