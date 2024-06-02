<?php

/**
on 11/11/23, i commented out some lines in 

includes/db/output_pullsheets_bos.db.php

in an effort to have only the 1st place at each table print instead of 1st-3rd

test printing of bos pullsheet after 1st weeknight judging session to verify the correct entries are printing

if they are not, then remove the comments at the beginning of each commented out line and go back to manually scratching out the 2nd and 3rd place entries on the printout before giving to L.T.

*/


$query_bos = sprintf("SELECT * FROM %s",$prefix."judging_scores");
if ($type == "4") $query_bos .= sprintf(" WHERE (scoreType='%s' OR scoreType='%s')", "2", "3");
else 
$query_bos .= sprintf(" WHERE scoreType='%s'", $type);
//if ($style_type_info[1] == "1") 
$query_bos .= " AND scorePlace='1'";
//if ($style_type_info[1] == "2") $query_bos .= " AND (scorePlace='1' OR scorePlace='2')";
//if ($style_type_info[1] == "3") $query_bos .= " AND (scorePlace='1' OR scorePlace='2' OR scorePlace='3')";
$query_bos .= " ORDER BY scoreTable ASC";
$bos = mysqli_query($connection,$query_bos) or die (mysqli_error($connection));
$row_bos = mysqli_fetch_assoc($bos);
$totalRows_bos = mysqli_num_rows($bos);
?>