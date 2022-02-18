<?php
include_once ('../common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

// token: 157901435960e9c7036484b
// certi: naver
// rsv_region: 1
// rsv_name: 1
// rsv_tel1: 2
// rsv_tel2: 3
// rsv_tel3: 4
// rsv_email: 
// ride_adult_cnt: 1
// type_choice: default
// group_name: 
// csv_file: (binary)
// memo: 5

$result = $_REQUEST;
$token = $_POST['token'];
$program = $_POST['program'];
$rsv_region = $_POST['rsv_region'];
$rsv_name = $_POST['rsv_name'];
$rsv_tel = "";
$rsv_tel .= strval($_POST['rsv_tel1']);
$rsv_tel .= "-";
$rsv_tel .= strval($_POST['rsv_tel2']);
$rsv_tel .= "-";
$rsv_tel .= strval($_POST['rsv_tel3']);
$rsv_email = $_POST['rsv_email'];
$rsv_address = $_POST['rsv_address'];
$rsv_detailAddress = $_POST['rsv_detailAddress'];
$ride_adult_cnt = $_POST['ride_adult_cnt'];
$memo = $_POST['memo'];
$agree = $_POST['agree'];

$return = array();

sql_fetch("set names utf8;"); 
$cnt1 = sql_fetch ("
  SELECT count(id) as cnt FROM apply WHERE rsv_name = '$rsv_name' AND rsv_tel = '$rsv_tel' AND program = '$program'
");
if($cnt1['cnt'] > 0) {
  $return["result"] = "success";
  $sql = "
    SELECT id, program, rsv_name, rsv_address, rsv_detailAddress, rsv_tel, ride_adult_cnt FROM apply WHERE rsv_name = '$rsv_name' AND rsv_tel = '$rsv_tel' AND program = '$program'
  ";
  $result = sql_query( $sql );
  for ($i=0; $row=sql_fetch_array($result); $i++) {
    $return["data"] = array(
      "id" => $row['id'],
      "program" => $row['program'],
      "rsv_name" => $row['rsv_name'],
      "rsv_address" => $row['rsv_address'],
      "rsv_detailAddress" => $row['rsv_detailAddress'],
      "rsv_tel" => $row['rsv_tel'],
      "ride_adult_cnt" => $row['ride_adult_cnt'],
    );
  }
  echo json_encode( $return );
  exit;
} else {
  $return["result"] = "fail";
  echo json_encode( $return );
  exit;
};

// $sql = "
// insert into apply
//   set
//     token     	= '$token',
//     program     	= '$program',
//     rsv_region     		= '$rsv_region',
//     rsv_name            = '$rsv_name',
//     rsv_tel          = '$rsv_tel',
//     rsv_email    = '$rsv_email',
//     rsv_address  = '$rsv_address',
//     rsv_detailAddress  = '$rsv_detailAddress',
//     ride_adult_cnt		= '$ride_adult_cnt',
//     agree = '$agree',
//     memo  			= '$memo',
//     create_time  = current_timestamp()
//   ";

// sql_query( $sql );

// $return["result"] = "success";
// $return["username"] = $name;

// echo json_encode( $return );

// goto_url($_SERVER['HTTP_REFERER']);


