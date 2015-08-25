<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Excel library for Code Igniter applications
* Based on: Derek Allard, Dark Horse Consulting, www.darkhorse.to, April 2006
* Tweaked by: Moving.Paper June 2013
*/
class exportorderreportbyadmin{
    
    function to_excel($array, $filename,$array2) {
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
//                echo "<a href='http://localhost/anima/images'>Demo</a>";
//                echo site_url();
                echo '<table border="1">';
        
//                echo "<tr>";
//                echo "<td colspan='5'></td>";
//        $image="<img src='".site_url('/image/index?name=topic-1350661050.jpg&height=25&width=100')."'></td>";
////        echo $image;
//        echo "<td colspan='2'>'$image'</td>";
////                echo "<td colspan='2'><img src='";
////                echo site_url('/image/name=topic-1350661050.jpg&height=20&width=20');
////                echo "'></td>";
////                echo "<td colspan='2'><img src='http://localhost/anima/uploads/nav.png' style='height:10px; width:10px;'></td>";
//                echo "<td colspan='7'></td>";
                echo "</tr>";
                    
                echo '<tr ><td colspan="3"></td>';
                echo '<td colspan="2">Dates</td>';
                echo '<td colspan="2">No Of People</td>';
                echo '<td colspan="7"></td></tr>';
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
                
                $array2value=$array2->row();
                $total=$array2value->total;
                $amount=$array2value->amount;
                $profit=$array2value->profit;
                
                echo "<tr ><td colspan='10'></td>";
                echo "<td>".$total."</td>";
                echo "<td colspan='1'></td>";
                echo "<td>".$amount."</td>";
                echo "<td>".$profit."</td>";
//                echo '<td colspan="2">No Of People</td>';
//                echo '<td colspan="7"></td></tr>';
                echo '</tr>';
        
                echo '</table>';
                
            
        }
    function writeRow($val) {
                echo '<td>'.utf8_decode($val).'</td>';              
    }

}
?>