<?php
include("shared/refresh.php");
include("shared/connectDB.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/histoire.css">
	<title>SANS SOUCI</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php") ?>

	<!--SECTION-->
		<section id="sectionGrid">
			<div></div><h1>HISTOIRE</h1><div></div>

			<div class="userInfo">
			<img src="img/icones/conversgm.png" width="70px" style="cursor: pointer;" onclick="showConversGm()"><br/>
			<img src="img/icones/d20.png" width="60px" style="cursor: pointer;" onclick="showDice()"><br/>
			Info active user, convers GM, outils divers.</div>



			<div class="mobileInfo" hidden>
				<span class="mobileInfoWriter">
					<a href="" style="font-weight: bold; color: black">ALMA</a> LVL100<br/>
					Malkavien Sang
				</span>
				<span class="mobileInfoUser">
					<img src="img/icones/conversgm.png" width="30px" style="cursor: pointer;" onclick="showConversGm()">
			<img src="img/icones/d20.png" width="37px" style="cursor: pointer;" onclick="showDice()">
				</span>

			</div>
			<div class="msgInfo">
				<a href="" style="font-weight: bold; color: black">ALMA</a><br/><br/>
				LVL100<br/>
				Malkavien<br/>
				Sang<br/><br/>
				messages : 42
			</div>
			<div class="msg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
			<div></div>

			<div>
			</div>
			<div class="msgGM">Espace narration, message du GM.</div>
			<div></div>

			<div class="mobileInfo" hidden>Infos minimum mobile</div>
			<div class="msgInfo">
				<a href="" style="font-weight: bold; color: black">ALMA</a><br/><br/>
				LVL100<br/>
				Malkavien<br/>
				Sang<br/><br/>
				messages : 42
			</div>
			<div class="msg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
			<div></div>

			<div class="mobileInfo" hidden>Infos version mobile</div>
			<div class="msgInfo">
				<a href="" style="font-weight: bold; color: black">ALMA</a><br/><br/>
				LVL100<br/>
				Malkavien<br/>
				Sang<br/><br/>
				messages : 42
			</div>
			<div class="msg">Lorem flemmard, content minimum.</div>
			<div></div>

			<div>
			</div>
			<div class="msgGM">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco </div>
			<div></div>

			<div class="mobileInfo" hidden>Infos minimum mobile</div>
			<div class="msgInfo">
				<a href="" style="font-weight: bold; color: black">ALMA</a><br/><br/>
				LVL100<br/>
				Malkavien<br/>
				Sang<br/><br/>
				messages : 42
			</div>
			<div class="msg">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
			<div></div>

		</section>



	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>



</body>
</html> 