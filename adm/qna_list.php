<?php
$sub_menu = "100980";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');

// 테이블이 없다면 생성
// if(!sql_query(" DESC qna_list ", false)) {
// sql_query(" CREATE TABLE `qna_list` (
//   `id` int(11) NOT NULL auto_increment,
//   `name` varchar(255) default NULL,
//   `email` varchar(255) default NULL,
//   `phone` varchar(255) default NULL,
//   `area` varchar(255) default NULL,
//   `subject` varchar(255) NOT NULL,
//   `agree_YN` TINYINT(1) NULL,
//   `contents` longtext default NULL,
//   `create_time` timestamp NULL default NULL,
//     PRIMARY KEY  (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ", false);
// }

$sql_common = " from apply ";
$sql_search = " where (1) ";
if ($stx) {
  $sql_search .= " and ( ";
  switch ($sfl) {
      default :
          $sql_search .= " ({$sfl} like '%{$stx}%') ";
          break;
  }
  $sql_search .= " ) ";
}
if (!$sst) {
    $sst  = "id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['PHP_SELF'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '사전신청 명단';
include_once('./admin.head.php');

$colspan = 9;
?>
<style>
tbody tr{text-align: center;}
</style>
<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
<div class="sch_last">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
      <option value="program"<?php echo get_selected($sfl, "program"); ?>>프로그램</option>
      <option value="rsv_tel"<?php echo get_selected($sfl, "rsv_tel"); ?>>연락처</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    <input type="submit" class="btn_submit" value="검색">
</div>
</form>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
	문의 수<?php echo number_format($total_count) ?>개
</div>

<form name="fsearch" id="fsearch"  action="./qna_update.php" class="local_sch01 local_sch" method="post" onsubmit="return fboardlist_submit(this);">

<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="<?php echo $token ?>">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" width="30" id="mb_list_chk">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" width="100">프로그램</th>
        <th scope="col" width="30">분 류<br>1:내국인<br>2:외국인</th>
        <th scope="col" width="100">성 함</th>
        <th scope="col" width="100">연락처</th>
        <th scope="col" width="100">이메일</th>
        <th scope="col" width="50">인 원</th>
        <th scope="col" width="100">문의시간</th>
        <th scope="col" width="150">주 소</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $one_update = '<a href="./qna_form.php?w=u&amp;qa_id='.$row['id'].'&amp;'.$qstr.'">관리</a>';
		    $one_delete = '<a onclick="list_delete('.$row['id'].');" >삭제</a>';

        $bg = 'bg'.($i%2);

    ?>

    <tr class="<?php echo $bg; ?>">
        <input type="hidden" name="qa_id[<?php echo $i ?>]" value="<?php echo $row['id'] ?>" id="id_<?php echo $i ?>">
        <td><input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>"></td>
        <td><?php echo $row["program"]?></td>
        <td><?php echo $row["rsv_region"]?></td>
        <td><?php echo $row["rsv_name"]?></td>
        <td><?php echo $row["rsv_tel"]?></td>
        <td><?php echo $row["rsv_email"]?></td>
        <td><?php echo $row["ride_adult_cnt"]?></td>
        <td><?php echo $row["create_time"]?></td>
        <td><?php echo $row["rsv_address"] . " " . $row["rsv_detailAddress"]; ?></td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>
<!-- <div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div> -->

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['PHP_SELF'].'?'.$qstr.'&amp;page='); ?>

<script>
function list_delete( no )
{
	if( confirm( "삭제하시겠습니까?" ) )
	{
		location.href = "./qna_update.php?w=d&qa_id=" + no + "&<?php echo $qstr?>";

		return false;
	}

	return false;
}

function fboardlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

$(function(){
    $(".board_copy").click(function(){
        window.open(this.href, "win_board_copy", "left=100,top=100,width=550,height=450");
        return false;
    });
});
</script>

<?php
include_once('./admin.tail.php');
?>