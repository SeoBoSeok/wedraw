<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
	</div><!-- container End -->
</div><!-- wrapper End -->

<div id="sidr">
<?php include_once(G5_THEME_MSHOP_PATH.'/category.php'); // 분류 ?>
</div>

<div id="ft">
    <h2><?php echo $config['cf_title']; ?> 정보</h2>
    <div class="ft_wr">
    	<div id="ft_cs" class="ft_con">
            <h3><a href="<?php echo G5_BBS_URL; ?>/faq.php">CALL CENTER</a></h3>
            <div>
                <?php
                $save_file = G5_DATA_PATH.'/cache/theme/buzinga54/footerinfo.php';
                if(is_file($save_file))
                    include($save_file);
                ?>
                <strong class="cs_tel"><?php echo get_text($footerinfo['tel']); ?></strong>
                <p class="cs_info"><?php echo get_text($footerinfo['etc'], 1); ?></p>
                <a href="<?php echo G5_BBS_URL; ?>/qalist.php" class="qa_link">문의게시판</a>
            </div>
        </div>
        <div id="ft_bank" class="ft_con">
            <h3>BANK INFO</h3>
            <div>
                <?php
                $save_file = G5_DATA_PATH.'/cache/theme/buzinga54/footerinfo.php';
                if(is_file($save_file))
                    include($save_file);
                ?>
                <p class="name">예금주 : <?php echo get_text($footerinfo['depositor']); ?></p>
                <span class="account"><?php echo get_text($footerinfo['account'], 1); ?></span>
            </div>
        </div>
        <div class="ft_con">
            <?php echo latest('theme/shop_basic', 'notice', 5, 30); ?>
        </div>
        <div id="ft_if" class="ft_con">
            <h3>COMPANY</h3>
            <strong> <?php echo $default['de_admin_company_name']; ?></strong>
            <span>주소 : <?php echo $default['de_admin_company_addr']; ?></span><br>
            <span>사업자등록번호 : <?php echo $default['de_admin_company_saupja_no']; ?></span>
            <span>대표 : <?php echo $default['de_admin_company_owner']; ?></span>
            <span>전화 : <?php echo $default['de_admin_company_tel']; ?></span>
            <span>팩스 : <?php echo $default['de_admin_company_fax']; ?></span>
            <!-- <span>운영자 <?php echo $admin['mb_name']; ?></span><br> -->
            <span>통신판매업신고번호 : <?php echo $default['de_admin_tongsin_no']; ?></span>
            <span>개인정보 보호책임자 : <?php echo $default['de_admin_info_name']; ?></span>
            <?php if ($default['de_admin_buga_no']) echo '<span>부가통신사업신고번호 : '.$default['de_admin_buga_no'].'</span>'; ?>
        </div>
    </div>
    <ul id="ft_link">
        <!-- <li><a href="<?php echo get_pretty_url('content', 'company'); ?>">회사소개</a></li> -->
        <li><a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보</a></li>
        <li><a href="<?php echo get_pretty_url('content', 'provision'); ?>">이용약관</a></li>
    </ul>
	<p class="ft_copy">Copyright &copy; 2022 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.</p>
	<a href="#" id="ft_to_top"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></a>

   <script>
    $(function() {
        $("#ft_to_top").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });
    });
    </script>
</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/css3-animate-it.js"></script>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/animate.css">

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
