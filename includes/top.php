<!doctype html>

<html>

<head>

	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>

	<meta name="viewport" content="width=320, initial-scale=1, user-scalable=yes">

    <title><?php echo $PAGE_TITLE; ?></title>

	<link rel="shortcut icon" href="../../static/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="../../static/css/general.css">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
	<link rel="stylesheet" type="text/css" href="../../static/css/swiper.css">
	<link rel="stylesheet" type="text/css" href="../../static/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../static/css/elements.css">
	<link rel="stylesheet" type="text/css" href="../../static/css/popup.css">

	<script language="javascript" type="text/javascript" src="../../static/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="../../static/js/jquery-ui.js"></script>
	<script language="javascript" type="text/javascript" src="../../static/js/bootstrap.js"></script>
	<script language="javascript" type="text/javascript" src="../../static/js/swiper.js"></script>

</head>


<body>

	<!------Mobile Header-->
	<div id="headerMobile" class="mobileOnly">

		<div class="content">

			<a href="../../page/home/">
				<div class="logo"></div>
			</a>

			<div class="burgerBtn clickable" status="0"></div>

			<div class="clear"></div>

		</div>

		<div id="menuMobile">

			<div class="textLeft">
				<a href="../../page/home/" class="small <?php if($CURRENT_SECTION=="HOME"){echo"green";}else{echo"blackGreen";} ?>"></a>
			</div>

		</div>

	</div>

	<!--Nav-->
	<nav id="headerDesktop" class="greyLightBg desktopOnly">

		<div class="content">

			<div class="logo">
				<a href="../../page/home/">
					<img src="../../static/images/logo.png" width="100%" />
				</a>
			</div>
			
			<ul class="navbar">
				<li>
					<a href="../../page/home/" class="small <?php if($CURRENT_SECTION=="OVERVIEW"){echo"green";}else{echo"blackGreen";} ?>">Overview</a>
				</li>
				<li>
					<a href="../../page/ourProcess/" class="small <?php if($CURRENT_SECTION=="OUR PROCESS"){echo"green";}else{echo"blackGreen";} ?>">Our Process </a>
				</li>
				<li>
					<a href="../../page/faq/" class="small <?php if($CURRENT_SECTION=="FAQ"){echo"green";}else{echo"blackGreen";} ?>">FAQ</a>
				</li>
				<li>
					<a href="../../page/contactus/" class="small <?php if($CURRENT_SECTION=="CONTACT US"){echo"green";}else{echo"blackGreen";} ?>">Contact us</a>
				</li>
			</ul>

			<div class="clear"></div>

		</div>

    </nav>
    

	<script>

		$(document).ready(function(){	

			$(".burgerBtn").click(function(){

				var status=$(this).attr("status");

				if(status=="0"){
					$("#menuMobile").animate({"right":"0px"},300);
					$(this).attr("status","1");
				}
				else{
					$("#menuMobile").animate({"right":"-500px"},300);
					$(this).attr("status","0");
				}

			});
			
			$("#contactTab,#contactTab2").click(function(){
				var top=$("#contact").offset().top;
				$("html,body").animate({"scrollTop":top},500);

			});

		})

	</script>
