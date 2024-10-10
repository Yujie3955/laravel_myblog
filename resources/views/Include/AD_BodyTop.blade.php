<style>
	body{
		background-color:#F2F2F2;
	}
	.SideMenu{
		background-color:#ffffff;
		height:100%;
		width:300px;
		top:0px;
	}
	.SideMenu>ul{
		padding:20px;
		margin:0px;
		line-height:50px;
		list-style:none;
	}
	.SideMenu>ul>li{
		/* border-bottom:1px #000000 solid; */
		font-size:20px;
		padding-left:10px;
	}
	.SideMenu>ul>li>a{
		/* border-bottom:1px #000000 solid; */
		color:#000000;
		text-decoration: none;
	}
	.Login_AdminPoint{
		width:100%; 
	}
	.Login-InfoShow{
		width:100%; 
		z-index:9999;
	}
	.Login-InfoShow_fix{
		position:fixed;
	}
	.AD_Layout{
		list-style:none;
		padding:0px;
		margin:0px;
	}
	.AD_Layout>li{
		padding:0px;
		margin:0px;
	}
	.RWDHamburger_Btn{
		font-size:30px;
		margin:5px;
		border:1px #757575 solid;
		padding:5px;
		padding-left:10px;
		padding-right:10px;
		border-radius:5px;
		display:none;
	}
	.DisRWD_Btn{
		font-size:30px;
		color:#ffffff;
		display:none;
	}
	.MenuList{
		width:20%;
	}
	.MenuLItemList>li>a{
		font-size:18px;
		color:#000000;
		text-decoration: none; 
		display:block;
	}
	@media screen and (max-width: 1200px) {
		.SideMenu {
			display: none;
			position:fixed;
			background-color:#616161;
			color:#ffffff;
			z-index:9999;
		}
		.SideMenu>ul>li> a{
			color:#ffffff;
			display:none;
		}
		.MenuLItemList>li>a{
			font-size:20px;
			color:#ffffff;
			display:none;
		}
		.MenuLItemList>li{
			display:none;
		}
		.RWDHamburger_Btn{
			display:inline-block;
		}
		.DisRWD_Btn{
			display:inline-block;
		}
		.MenuList{ 
			width:0%;
		}
		.ListSwitch{
			display:none;
		}
	}
	.Login_StudentInfo{
		background-color:#333333;
		color:#ffffff;
		font-size:25px;
		font-weight:bold;
		vertical-align:middle;
		padding-left:20px;
		padding-top:10px;
		padding-bottom:10px;
		width:100%;
	}
	.Btn_LoginOut{
		background-color:#178A36;
		width:100px;
		padding:5px;
		border-radius:2px;
		font-size:20px;
	}
	.Btn_IdentInfo{
		background-color:#1565C0;
		width:100px;
		padding:5px;
		border-radius:2px;
		font-size:20px;
	}
</style>
<div class="Login-InfoShow">
    <table style="width:100%;background-color:#ffffff;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-repeat:no-repeat; background-position:center top;">
        <tr>
            <td class="" style="background-repeat:no-repeat; background-position:left top;">
                <span class="RWDHamburger_Btn"><i class="fa-solid fa-bars"></i></span>
            </td>
        </tr>
    </table>
	<!--登入狀態列-->
	<div class="middle Login_StudentInfo align-items-center align-self-start">
		<div style="width:80%;text-align:left;">
			<div style="width:100%;">
				<div class="row">
				  <div class="col-lg-6">
						<a href='{{ route('AdHome') }}' class="text-white no-underline">
							Company
						</a>
				  </div>
				  <div class="col-lg-6 d-flex justify-content-end">
					<button type="button" data-bs-toggle="modal" data-bs-target="#ThisUserInfo"  class=" text-lg whitespace-nowrap">
						<img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-10 w-10 object-cover">
					</button>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal fade" style="width:100%;" id="ThisUserInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			    <div class="modal-content">
				<div class="modal-header" style="border:0px;">
				  <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#000000;"><i class="fa-solid fa-user"></i> &nbsp;帳號資訊</h1>
				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" style="border:0px;">
					<div class="flex justify-center">
						<img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-20 w-20 object-cover" style="border:1px #BDBDBD solid;">
					</div>
					
					<ul style="color:#000000;">
						<li style="font-size:20px;">{{ Auth::user()->name }}</li>
						<li style="font-size:20px;">{{ Auth::user()->email }}</li>
					</ul>
				</div>
				<div class="modal-footer">
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button type="button" class="Btn_IdentInfo" onclick="location.href='user/profile'">資訊調整</button>
						<button type="submit" class="Btn_LoginOut">登出系統</button>
					</form>
				</div>
			  </div>
			</div>
		</div>
	</div>
</div>
<script>
	window.addEventListener('scroll', function(e){
	var HeightY = window.pageYOffset || document.documentElement.scrollTop,
		scrollHeight = 700, //滾動距離
		header = document.querySelector(".Login-InfoShow");
		if (HeightY > scrollHeight) {
			$(".Login-InfoShow").addClass("Login-InfoShow_fix");
		} else {
			$(".Login-InfoShow").removeClass("Login-InfoShow_fix");
		}
	});
</script>
<!--選單-->
	<table style="width:100%;height:1000px;">
		<tr>
			<td class="MenuList" >
				<div class="SideMenu">
					<div style="width:100%;text-align:right;padding-right:20px;padding-top:10px;">
						<span class="DisRWD_Btn"><i class="fa-solid fa-xmark" style="color:#ffffff;display:none;"></i></span>
					</div>
					<ul>
						<li><a href="{{ route('FontHome') }}"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;回首頁</a></li>
						<li class="TestList">
							<a href="#"><i class="fa-solid fa-gear"></i>&nbsp;&nbsp;公告管理</a>
							<i class="fa-solid fa-angle-down ListSwitch"></i>
							<ul class="MenuLItemList">
								<li><a href="/bulletins">公告管理</a></li>
								{{-- <li><a href='{{ route('Bulletin.Index') }}'>公告類別管理</a></li> --}}
							</ul>
						</li>

						
						{{-- <li class="TestList">
							<a href="#"><i class="fa-solid fa-gear"></i>&nbsp;&nbsp;帳號管理</a>
							<i class="fa-solid fa-angle-down ListSwitch"></i>
							<ul class="MenuLItemList">
								<li><a href='../AdminIdent/AD_Index.php'>管理端帳號管理</a></li>
								<li><a href='../School/AD_Index.php'>學校帳號管理</a></li>
								<li><a href='../Student/AD_Index.php'>學生帳號管理</a></li>
							</ul>
						</li>
						<li class="TestList">
							<a href="#"><i class="fa-solid fa-address-card"></i>&nbsp;&nbsp;鑑定資料管理</a>
							<i class="fa-solid fa-angle-down ListSwitch"></i>
							<ul class="MenuLItemList">
								<li><a href='../Brochure/AD_Index.php'>簡章及承辦人</a></li>
								<li><a href='../Time/AD_Index.php'>時程管理</a></li>
								<li><a href='../Admission/AD_Index.php'>評量證內容管理</a></li>
								<li><a href='../Result/AD_Index.php'>結果公告內容管理</a></li>
							</ul>
						</li>
						<li class="TestList">
							<a href="#"><i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp;報名資料管理</a>
							<i class="fa-solid fa-angle-down ListSwitch"></i>
							<ul class="MenuLItemList">
								<li><a href='../SignupList/AD_Index.php'>報名表及報名解鎖</a></li>
								<li><a href='../SPStudent/AD_Index.php'>特殊身分</a></li>
								<li><a href='../ExaminationPlace/AD_Index.php'>試場服務</a></li>
								<li><a href=''>非本縣學生戶籍證明</a></li>
								<li><a href=''>書面審查資料管理</a></li>
							</ul>
						</li>
						<li class="TestList">
							<a href="#"><i class="fa-solid fa-chart-column"></i>&nbsp;&nbsp;成績管理</a>
							<i class="fa-solid fa-angle-down ListSwitch"></i>
							<ul class="MenuLItemList">
								<li><a href=''>書面審查成績</a></li>
								<li><a href=''>初選評量成績</a></li>
								<li><a href=''>複選評量成績</a></li>
								<li><a href=''>評鑑通過名單</a></li>
							</ul>
						</li> --}}
					</ul>
				</div>
			</td>
			<td class="align-top">
			<script>
				$('.RWDHamburger_Btn, .DisRWD_Btn').on('click', function(){
					if($(this).hasClass('RWDHamburger_Btn')){

						$('.SideMenu').animate({
							width: 'toggle'
						}, 'slow', function() {
							$('.SideMenu > div > span > .fa-xmark').stop().fadeIn('slow');
							$('.SideMenu > ul > li > a').stop().fadeIn('slow'); 
							$('.SideMenu > ul > li > .fa-angle-down').stop().fadeIn('slow');
							$('.SideMenu > ul > li > .fa-angle-up').stop().fadeIn('slow'); 
							$('.MenuLItemList > li > a').stop().fadeIn('slow');
							$('.MenuLItemList > li').stop().fadeIn('slow');
						});
					}else{
						$('.SideMenu > div > span > .fa-xmark').stop().fadeOut('slow');
						$('.SideMenu > ul > li > .fa-angle-down').stop().fadeOut('slow');
						$('.SideMenu > ul > li > .fa-angle-up').stop().fadeOut('slow');
						
						$('.SideMenu > ul > li > a').stop().fadeOut('slow');
						$('.MenuLItemList > li > a').stop().fadeOut('slow'); 
						$('.MenuLItemList > li').stop().fadeOut('slow'); 
						setTimeout(function() {
							$('.SideMenu').animate({
								width: 'toggle'
							}, 'slow');
						},500); 
					}
				});
				$(document).ready(function() {
					$(".ListSwitch").click(function() {
						$(this).siblings(".MenuLItemList").slideToggle();
						$(this).toggleClass('fa-angle-down fa-angle-up');
					});
					$('.ListSwitch').trigger('click');
				});
			</script>
			<style>
				.SecTitle{
					width:100%;
					font-size:30px;
					font-weight:bold;
					padding-top:10px;
					padding-bottom:20px;
					border-bottom:1px #999999 solid;
					margin-bottom:10px;
				}
			</style>
			<div style="width:95%;" class="p-0 m-0">
			<!--次標題-->
			<div class="SecTitle">
				<div width="100%">
				  <div class="row">
					<div class="col-lg-6">
						@if(isset($Flag_LastPage))
							@if($SecTitle_Action=='新增')
							<i class="fa-solid fa-arrow-left" onclick="location.href='../{{ $Flag_LastPage }}';"></i>
							@else
							<i class="fa-solid fa-arrow-left" onclick="location.href='../../{{ $Flag_LastPage }}';"></i>
							@endif
						@endif
						@if(isset($SecTitle_Action))
							{{ $SecTitle_Action }}
						@endif
						@if(isset($SecTitle))
						{{ $SecTitle }}
						@else
						管理端
						@endif
					</div>
					<div class="col-lg-6"></div>
				</div>
			</div>
		</div>
						
					
           