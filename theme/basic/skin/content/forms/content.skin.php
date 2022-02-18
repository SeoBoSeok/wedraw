<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
echo '<link rel="stylesheet" href="'.$content_skin_url.'/style.css">';
$_program = array("monday" => "공주근대건축만들기", "tuesday" => "공주문화재야행스트링아트",  "wednesday" => "소원종이등만들기", "thursday" => "가죽그립톡만들기", "friday" => "도자기모빌만들기", "saturday" => "천문대관측프로그램", "sunday" => "1박2일숙박프로그램");
$_program_detail = $_GET["program"];
// if(empty($_program_detail)) {
//     echo '<script>alert("잘못된 접근입니다"); window.location.href = "/bbs/board.php?bo_table=online&type=forms";</script>';
// }
$_open = true;
?>
<!-- <div class="sub-layout">
    <div class="container">
        <div class="text-center mt-5 fs-30">사전신청</div>
        <div class="text-center fs-15 fc-gray"><span>HOME</span> &gt; <span>공지사항</span> &gt; <span>사전신청</span></div>
    </div>
</div> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container">
    <div class="row">
        <div class="col" style="padding: 100px 0; text-align: center;">

        <?php if($_open) { ?>

        <a href="<?php echo G5_URL.'/bbs/content.php?co_id=formscheck'; ?>"><button type="button" class="btn btn-info btn-lg float-right">사전신청확인</button></a>
        


        <div id="contents">
        <div class="apply">
            <div class="inner_box">

                <div class="dep3_box" id="dep3_01">
                <div class="sub_title pt-5">
                    <div class="line_wrap">
                        <div class="text_wrap">사전 프로그램 예약신청</div>
                    </div>
                </div>

                <div class="form_wrap">

                <form id="reserveForm" action="/api/apply.php" method="POST" enctype="multipart/form-data">
                    <!-- <input type="hidden" name="token" value="157901435960e9c7036484b"> -->
                    <?php
                    if(!($_program_detail == "saturday" || $_program_detail == "sunday")) {
                    ?>
                    <input type="hidden" name="token" value="<?php echo $_program_detail; ?>">
                    <input type="hidden" id="ride_adult_cnt" name="ride_adult_cnt" value="1" />
                    <?php
                    }
                    ?>
                    <table>
                    <tbody>
                    <tr>
                        <td class="ttl">프로그램</td>
                        <td class="box6 ride_count">
                            <div class="box6_01">
                                <input type="text" id="rsv_program" class="rsv_program" name="rsv_program" value="<?php echo $_program[$_program_detail]; ?>" readonly />
                            </div>
                        </td>
                    </tr>
                    <?php
                    if($_program_detail == "saturday") {
                    ?>
                    <tr>
                        <td class="ttl">프로그램 시간</td>
                        <td class="box6 ride_count">
                            <div class="box6_01">
                                <label for="time_1"><input type="radio" id="time_1" name="token" value="saturday1"><span>11월 05일 20:00~20:50</span></label><br />
                                <label for="time_2"><input type="radio" id="time_2" name="token" value="saturday2"><span>11월 05일 21:10~22:00</span></label><br />
                                <label for="time_3"><input type="radio" id="time_3" name="token" value="saturday3"><span>11월 07일 20:00~20:50</span></label><br />
                                <label for="time_4"><input type="radio" id="time_4" name="token" value="saturday4"><span>11월 07일 21:10~22:00</span></label>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <?php
                    if($_program_detail == "sunday") {
                    ?>
                    <tr>
                        <td class="ttl">프로그램 시간</td>
                        <td class="box6 ride_count">
                            <div class="box6_01">
                                <label for="time_5"><input type="radio" name="token" id="time_5" value="sunday1"><span>11. 05.(금) 14:00~11.06.(토) 13:10</span></label><br />
                                <label for="time_6"><input type="radio" name="token" id="time_6" value="sunday2"><span>11. 06.(토) 14:00~11.07.(일) 13:10</span></label>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>                    
                    <tr>
                        <td class="ttl">예약자 정보</td>
                        <td class="box5">
                            <div class="box5_02">
                                <span>예약자명</span>
                                <input type="text" name="rsv_name" placeholder="예약자명을 입력해 주세요.">
                            </div>
                            <div class="box5_03">
                                <span>예약자 연락처</span>
                                <div class="tel1">
                                    <!-- <input type="text" class="tel1_01" name="rsv_tel1" maxlength="3" onkeyup="numChk(this)" placeholder="연락처를 입력해 주세요."> -->
                                    <select name="rsv_tel1">
                                        <option value="010">010</option>
                                    </select>
                                    <span>-</span>
                                    <input type="text" class="tel1_02" name="rsv_tel2" maxlength="4" onkeyup="numChk(this)">
                                    <span>-</span>
                                    <input type="text" class="tel1_03" name="rsv_tel3" maxlength="4" onkeyup="numChk(this)">
                                </div>
                            </div>

                            <div class="box5_04">
                                <span>주소</span>
                                <!-- <input type="text" id="sample6_postcode" placeholder="우편번호"> -->
                                <input type="text" id="rsv_address" name="rsv_address" placeholder="주소" readonly onclick="sample6_execDaumPostcode()"><br>
                                <input type="text" id="rsv_detailAddress" name="rsv_detailAddress" placeholder="상세주소" style="margin-top: 5px;">
                                <input type="button" onclick="sample6_execDaumPostcode()" value="주소 찾기"><br>
                                <!-- <input type="text" id="sample6_extraAddress" placeholder="참고항목"> -->
                                <!-- <input type="text" id="rsv_address" name="rsv_address">
                                <button type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기">주소검색</button> -->
                            </div>
                            <!-- s:개인정보처리방침 -->
                            <div>
                            <fieldset>
                            <!-- <legend>개인정보처리방침</legend> -->
                            <div class="privacy"><span class="agr-tit1">제1조 (개인정보 수집에 대한 동의)</span><strong></strong>(이하 회사)는 이용자들이 회사의 개인정보취급방침 또는 이용약관의 내용에 대하여 “동의”버튼 또는 “취소”버튼을 클릭할 수 있는 절차를 마련하여, “동의”버튼을 클릭하면 개인정보 수집에 대해 동의한 것으로 봅니다. <span class="agr-tit1">제2조 (개인정보 수집항목)</span> 온라인 문의를 통한 상담을 위해 처리하는 개인정보 항목은 아래와 같습니다.<br>
                            수집항목 : 성명, 주소, 전화번호 <span class="agr-tit1">제3조 (개인정보의 이용목적)</span> 회사는 이용자의 사전 동의 없이는 이용자의 개인 정보를 공개하지 않으며, 원활한 고객상담, 각종 서비스의 제공을 위해 아래와 같이 개인정보를 수집하고 있습니다. 모든 정보는 상기 목적에 필요한 용도 이외로는 사용되지 않으며 수집 정보의 범위나 사용 목적, 용도가 변경될 시에는 반드시 사전 동의를 구할 것입니다.<br>
                            <br>
                            - 성명 : 제품상담에 따른 본인 확인<br>
                            - 이메일, 전화번호 : 제품상담 및 이벤트 관련 고지사항 전달, 새로운 서비스 및 신상품 정보 제공(DM, SMS, 이메일 등 이용)<br>
                            <br>
                            이용자는 개인정보의 수집/이용에 대한 동의를 거부할 수 있습니다. 다만, 동의를 거부하는 경우 온라인 문의를 통한 상담은 불가하며 서비스 이용 및 혜택 제공에 제한을 받을 수 있습니다. <span class="agr-tit1">제4조 (개인정보의 보유 및 이용기간)</span> 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다.<br>
                            그리고 상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계법렵의 규정에 의하여 보존할 필요가 있는 경우 회사는 관계법령에서 정한 일정한 기간 동안 정보를 보관합니다.<br>
                            이 경우 회사는 보관하는 정보를 그 보관의 목적으로만 이용하며 보존기간은 아래와 같습니다.<br>
                            <br>
                            - 계약 또는 청약철회 등에 관한 기록 : 5년(전자상거래등에서의 소비자보호에 관한 법률)<br>
                            - 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년(전자상거래등에서의 소비자 보호에 관한 법률)<br>
                            - 시용정보의 수집/처리 및 이용 등에 관한 기록 : 3년(신용정보의 이용 및 보호에 관한 법률)<br>
                            - 회사는 귀중한 이용자의 개인정보를 안전하게 처리하며, 유출의 방지를 위하여 다음과 같은 방법을 통하여 개인정보를 파기합니다.<br>
                            - 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.<br>
                            - 전자적 파일 형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다
                            <style type="text/css">.agr-tit1{display: block;margin: 15px 0 10px 0;font-size: 13px;color: #666;font-weight:bold;border-bottom: 1px solid #ddd;padding-bottom:13px;}
                            input[type=submit] {width: 200px; padding: 10px 0;}
                            @media screen and (max-width: 750px){
                            .agr-tit1{margin: 15px 0 10px 0;font-size: 13px;padding-left: 15px;}
                            .agr-tit2{margin: 20px 0;font-size: 13px;}
                            .agr-tit3{margin: 20px 0;font-size: 13px;}
                            }
                            </style>
                            </fieldset>
                            </div>
                            <div class="box5_05">
                                <label><input type="checkbox" name="agree" id="agree" /> 개인정보 수집 동의</label>
                            </div>
                        </td>
                    </tr>
                    <?php
                    if ($_program_detail == "saturday" || $_program_detail == "sunday") {
                    ?>
                    <tr>
                        <td class="ttl">참여인원(본인+인원)</td>
                        <td class="box6 ride_count">
                            <div class="box6_01">
                                <select name="ride_adult_cnt" id="ride_adult_cnt">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                <span class="txt">성인(초등학생 이상 기준)</span>
                            </div>
                            
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <!-- <tr>
                        <td class="ttl">예약 인원</td>
                        <td class="box6 ride_count">
                            <div class="box6_01">
                                <select name="ride_adult_cnt" id="ride_adult_cnt">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                </select>
                                <span class="txt">성인(중학생 이상 기준)</span>
                            </div>
                            
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <td class="ttl">예약자 명단</td>
                        <td class="box7">
                            <div class="type_choice hidden">
                                <input type="radio" name="type_choice" id="direct" value="default" checked="">
                                <label for="direct">직접</label>
                                <input type="radio" name="type_choice" id="groupName" value="group">
                                <label for="groupName">단체명</label>
                                <input type="radio" name="type_choice" id="csvbtn" value="csv">
                                <label for="csvbtn">CSV</label>
                            </div>
                            <div class="direct choice_box" id="rider_list"></div>
                            <div class="groupName choice_box hidden">
                                <input type="text" name="group_name">
                            </div>
                            <div class="csvbtn choice_box hidden">
                                <div class="title">
                                    <span>파일 업로드</span>
                                    <a href="/kor/images/file/list_form.csv" class="down_btn">파일 양식 다운</a>
                                    <br class="m_show">
                                    <span class="txt">* 양식을 다운받아 작성하여 올려주시기 바랍니다.</span>
                                </div>
                                <div class="fileBox">
                                    <input type="text" class="fileName" readonly="readonly">
                                    <label for="uploadBtn" class="btn_file">찾아보기</label>
                                    <input type="file" id="uploadBtn" class="uploadBtn" name="csv_file">
                                </div>
                            </div>
                            <div class="txt">※ 코로나19로 탑승자 명단을 정확히 작성해 주세요. (이름/전화번호/성별/연령/지역)</div>
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <td class="ttl">특이사항</td>
                        <td class="box10"><textarea name="memo"></textarea></td>
                    </tr> -->
                    </tbody>
                </table>

                <div class="bottom_txt" style="padding-right: 20px;">
                <?php
                if ($_program_detail == "saturday" || $_program_detail == "sunday") {
                ?>
                ※ 예약 확정되신 분에 한하여 11.02.(화)부터 문자 안내드립니다. <br />
                <?php
                if ($_program_detail == "sunday") {
                    echo '(여행자보험 가입 문의 등 상세 내용 안내 연락이 취해짐)';
                    echo '<br />';
                }
                ?>
                <?php
                }
                ?>
                ※ 전화번호당 한번만 참여 가능합니다.<br />
                ※ 연락처 및 주소 오기로 인한 미수령시에는 책임지지 않습니다.<br />
                </div>
                    <div class="btn_box">
                    <!-- <button class="rv_btn hidden" type="submit">예약하기</button> -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" id="reservation_check">
                    예약 하러가기
                    </button>
                </div>
        
            </form>

                </div>
            </div>
        </div>
    </div>

        <?php } else { ?>

        <img src="/images/main/prepare.png" alt="2021공주문화재야행 업데이트 준비중" style="width: 100%;">

        <?php } ?>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">예약 내역 확인</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        예약자 : <span class="check_name"></span><br />
        연락처 : <span class="check_tel"></span><br />
        주소 : <span class="check_address"></span><br />
        개인정보 동의 : <span class="check_agree">Y</span><br />
        참여인원 : <span class="check_count"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
        <button type="button" class="btn btn-primary" id="reservation_go">예약하기</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="successModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">예약 되었습니다</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        예약자 : <span class="check_name"></span><br />
        연락처 : <span class="check_tel"></span><br />
        주소 : <span class="check_address"></span><br />
        개인정보 동의 : <span class="check_agree">Y</span><br />
        참여인원 : <span class="check_count"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="failModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">이미 예약 하셨습니다</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        연락처 : <span class="check_tel"></span> 으로 이미 예약하셨습니다.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    // document.getElementById("rsv_extraAddress").value = extraAddr;
                
                } else {
                    // document.getElementById("rsv_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                // document.getElementById('sample6_postcode').value = data.zonecode;
                document.getElementById("rsv_address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("rsv_detailAddress").focus();
            }
        }).open();
    }
    // if (!$('input:checkbox[name=agree1]').is(':checked')) {
    //     alert("개인정보처리방침에 동의해주세요.");
    //     return false;
    // }
</script>
<script>
    document.getElementById("reservation_check").addEventListener("click", function(){
        if(!$('input[name=rsv_name]').val()) {
            alert('이름을 입력해주세요');
            $('input[name=rsv_name]').focus();
            return;
        }
        if(!$('input[name=rsv_tel2]').val()) {
            alert('전화번호를 확인해주세요');
            $('input[name=rsv_tel2]').focus();
            return;
        }
        if(!$('input[name=rsv_address]').val()) {
            alert('주소를 입력해주세요');
            return;
        }
        // console.log($('input:checkbox[name=agree]:checked').val());
        // if ($('input[name=agree]').val())
        if ($('input:checkbox[name=agree]:checked').val()) {
            $('.check_name').text($('input[name=rsv_name]').val());
            $('.check_tel').text($('select[name=rsv_tel1]').val() + "-" + $('input[name=rsv_tel2]').val() + "-" + $('input[name=rsv_tel3]').val());
            $('.check_address').text($('#rsv_address').val() + " " + $('#rsv_detailAddress').val());
            $('.check_count').text($('#ride_adult_cnt').val());
            $('#exampleModalCenter').modal('show');
        } else {
            alert("개인정보 수집 동의에 체크하셔야 합니다");
        }
    });
    $(document).ready(function(){
        $('#reservation_go').click(function(){   //submit 버튼을 클릭하였을 때
            $('#exampleModalCenter').modal('hide');
            // let sendData = "username="+$('input[name=username]').val();   //폼의 이름 값을 변수 안에 담아줌
            var sendData = $('#reserveForm').serialize();
            $.ajax({
                type:'post',   //post 방식으로 전송
                url:'/api/apply.php',   //데이터를 주고받을 파일 주소
                data: sendData,   //위의 변수에 담긴 데이터를 전송해준다.
                dataType:'json',   //html 파일 형식으로 값을 담아온다.
                success : function(data){   //파일 주고받기가 성공했을 경우. data 변수 안에 값을 담아온다.
                    // $('#message').html(data);  //현재 화면 위 id="message" 영역 안에 data안에 담긴 html 코드를 넣어준다. 
                    console.log(data);
                    if (data.result === "success") {
                        $('#successModalCenter').modal("show");
                        $('input[name=rsv_name]').val("");
                        $('input[name=rsv_tel1]').val("");
                        $('input[name=rsv_tel2]').val("");
                        $('input[name=rsv_tel3]').val("");
                        $('input[name=rsv_address]').val("");
                        $('input[name=rsv_detailAddress]').val("");
                        $('input[name=agree]').attr("checked", false);
                    } else {
                        if (data.result === "fail") {
                            $('#failModalCenter').modal("show");
                        } else {
                            alert(data.msg);
                        }
                    }
                }
            });
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>