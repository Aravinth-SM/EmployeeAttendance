<?php

$date = '2013-06-19';
$t1 = '5:46:03';
$t2 = '21:47:52';
$strStart = $date.' '.$t1; 
$strEnd   = $date.' '.$t2; 
$dteStart = new DateTime($strStart); 
$dteEnd   = new DateTime($strEnd);
$dteDiff  = $dteStart->diff($dteEnd);
$ans = $dteDiff->format("%H:%I:%S");
echo "ans - >".$ans;

?>