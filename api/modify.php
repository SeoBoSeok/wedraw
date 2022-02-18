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
$id = $_POST['id'];
$rsv_address = $_POST['rsv_address'];
$rsv_detailAddress = $_POST['rsv_detailAddress'];
$ride_adult_cnt = $_POST['ride_adult_cnt'];
$memo = $_POST['memo'];
$agree = $_POST['agree'];

$return = array();

if ($id < 447) {
  $return["result"] = "fail";
  $return["msg"] = "이미 발송된 상품이어서 더이상 주소 수정이 불가능합니다.";
  echo json_encode( $return );
  exit;
}

sql_fetch("set names utf8;"); 
$sql = "
  UPDATE apply SET rsv_address = '$rsv_address', rsv_detailAddress = '$rsv_detailAddress', memo = 'update' WHERE id = '$id'
";
$result = sql_query( $sql );
$return["result"] = "success";
$return["data"] = $result;
$return["sql"] = $sql;
echo json_encode( $return );

// if($cnt1['cnt'] > 0) {
//   $return["result"] = "success";
//   $sql = "
//     SELECT id, program, rsv_name, rsv_address, rsv_detailAddress, rsv_tel, ride_adult_cnt FROM apply WHERE rsv_name = '$rsv_name' AND rsv_tel = '$rsv_tel' AND program = '$program'
//   ";
//   $result = sql_query( $sql );
//   for ($i=0; $row=sql_fetch_array($result); $i++) {
//     $return["data"] = array(
//       "id" => $row['id'],
//       "program" => $row['program'],
//       "rsv_name" => $row['rsv_name'],
//       "rsv_address" => $row['rsv_address'],
//       "rsv_detailAddress" => $row['rsv_detailAddress'],
//       "rsv_tel" => $row['rsv_tel'],
//       "ride_adult_cnt" => $row['ride_adult_cnt'],
//     );
//   }
//   echo json_encode( $return );
//   exit;
// } else {
//   $return["result"] = "fail";
//   echo json_encode( $return );
//   exit;
// };


