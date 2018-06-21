<?php
function dateFormat($date){
  $datesplit = explode("/", $date);
  switch ($datesplit[1])
  {
    case "01" : $month="มกราคม"; break;
    case "02" : $month="กุมภาพันธ์"; break;
    case "03" : $month="มีนาคม"; break;
    case "04" : $month="เมษายน"; break;
    case "05" : $month="พฤษภาคม"; break;
    case "06" : $month="มิถุนายน"; break;
    case "07" : $month="กรกฎาคม"; break;
    case "08" : $month="สิงหาคม"; break;
    case "09" : $month="กันยายน"; break;
    case "10" : $month="ตุลาคม"; break;
    case "11" : $month="พฤศจิกายน"; break;
    case "12" : $month="ธันวาคม"; break;
  }
 return $newdate = $datesplit[0]." ".$month." ".$datesplit[2];
}

function newUserId($uid)
{
  $uidlength = strlen((string)$uid);
  if ($uidlength == 1){
   $new_uid = "RB0000".$uid;
  }else if ($uidlength == 2) {
         $new_uid = "RB000".$uid;
  }else if ($uidlength == 3) {
   $new_uid = "RB00".$uid;
 }else if ($uidlength == 4) {
   $new_uid = "RB0".$uid;
 }else if ($uidlength == 5) {
   $new_uid = "RB".$uid;
 }else {
   $new_uid = null;
 }
 return $new_uid;
}

function matchRole($data){
  if ($data == "student"){
    $rename = "นักศึกษา";
  } else if ($data == "teacher"){
    $rename = "อาจารย์";
  } else if ($data == "personnel"){
    $rename = "บุคลากร";
  } else {
    $rename = null;
  }
  return $rename;
}

function genUid($uid=''){
   $uidlength = strlen((string)$uid);
   if ($uidlength == 1){
     $new_uid = "RB0000".$uid;
   }else if ($uidlength == 2) {
           $new_uid = "RB000".$uid;
   }else if ($uidlength == 3) {
     $new_uid = "RB00".$uid;
   }else if ($uidlength == 4) {
     $new_uid = "RB0".$uid;
   }else if ($uidlength == 5) {
     $new_uid = "RB".$uid;
   }else {
     $new_uid = null;
   }
   return $new_uid;
}

function extractUid($newuid=''){
  $uidsub = substr($newuid,2);
  $fulltext = str_split($newuid);
  if (strlen($newuid) == 7 && $fulltext[0].$fulltext[1] == "RB"){
    $arr1 = str_split($uidsub);
    if ($arr1[0] != 0){
      $uid = $arr1[0].$arr1[1].$arr1[2].$arr1[3].$arr1[4];
    }
    else if ($arr1[1] != 0){
      $uid = $arr1[1].$arr1[2].$arr1[3].$arr1[4];
    }
    else if ($arr1[2] != 0){
      $uid = $arr1[2].$arr1[3].$arr1[4];
    }
    else if ($arr1[3] != 0){
      $uid = $arr1[3].$arr1[4];
    }
    else if ($arr1[4] != 0){
      $uid = $arr1[4];
    }
    return $uid;
  } else {
    return 0;
  }
}

?>
