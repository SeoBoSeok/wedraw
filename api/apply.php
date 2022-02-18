<?php
include_once ('../common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

// echo print_r($_POST);
// Array ( [token] => 157901435960e9c7036484b [certi] => naver [rsv_region] => 1 [rsv_name] => 1 [rsv_tel1] => 2 [rsv_tel2] => 3 [rsv_tel3] => 4 [rsv_email] => [ride_adult_cnt] => 1 [type_choice] => default [group_name] => [memo] => 5 ) 1

// CREATE TABLE `gongju`.`apply` (
//   `id` INT NOT NULL AUTO_INCREMENT,
//   `token` VARCHAR(45) NULL,
//   `program` VARCHAR(100) NULL,
//   `rsv_region` TINYINT(1) NULL,
//   `rsv_name` VARCHAR(45) NULL,
//   `rsv_tel` VARCHAR(15) NULL,
//   `rsv_email` VARCHAR(100) NULL,
//   `ride_adult_cnt` INT NULL,
//   `memo` VARCHAR(350) NULL,
//   PRIMARY KEY (`id`));

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
$program = $_POST['rsv_program'];
$rsv_region = $_POST['rsv_region'];
$rsv_name = trim($_POST['rsv_name']);
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

$cnt1 = sql_fetch ("
  SELECT count(id) as cnt FROM apply WHERE token = '$token' AND rsv_tel = '$rsv_tel'
");
$cnt2 = sql_fetch ("
SELECT sum(ride_adult_cnt) as cnt FROM apply WHERE token = '$token'
");
$cnt3 = sql_fetch ("
SELECT count(id) as cnt FROM apply WHERE token = '$token'
");
if($cnt1['cnt'] > 0) {
  $return["result"] = "fail";
  echo json_encode( $return );
  exit;
};
if($cnt2['cnt'] > 99) {
  $return["result"] = "full";
  $return["msg"] = "참여 제한 인원 100명 초과로 예약이 마감되었습니다.";
  echo json_encode( $return );
  exit;
};

if ($program == "천문대관측프로그램") {
  if(($cnt2['cnt'] + $ride_adult_cnt) > 15) {
    $return["result"] = "full";
    $return["msg"] = "참여 제한인원 초과로 " . $ride_adult_cnt . "명은 예약하실 수 없습니다. 죄송합니다.";
    echo json_encode( $return );
    exit;
  }
}

if ($program == "1박2일숙박프로그램") {
  if(($cnt2['cnt'] + $ride_adult_cnt) > 19) {
    $return["result"] = "full";
    $return["msg"] = "참여 제한인원 초과로 " . $ride_adult_cnt . "명은 예약하실 수 없습니다. 죄송합니다.";
    echo json_encode( $return );
    exit;
  }
  if ($cnt3['cnt'] > 4) {
    $return["result"] = "full";
    $return["msg"] = "참여 제한 가족 초과로 예약하실 수 없습니다. 죄송합니다.";
    echo json_encode( $return );
    exit;
  }
}

$sql = "
insert into apply
  set
    token     	= '$token',
    program     	= '$program',
    rsv_region     		= '$rsv_region',
    rsv_name            = '$rsv_name',
    rsv_tel          = '$rsv_tel',
    rsv_email    = '$rsv_email',
    rsv_address  = '$rsv_address',
    rsv_detailAddress  = '$rsv_detailAddress',
    ride_adult_cnt		= '$ride_adult_cnt',
    agree = '$agree',
    memo  			= '$memo',
    create_time  = current_timestamp()
  ";

sql_query( $sql );

$return["result"] = "success";
$return["username"] = $name;

echo json_encode( $return );

// goto_url($_SERVER['HTTP_REFERER']);


