<?php

	@$section = $_GET['s'];

	switch ($section){

		case "home":

			$CURRENT_SECTION="HOME";

			$PAGE_TITLE="HOME | USP";

			include("../dynamic/pages/home.php");

		break;


		case "ourProcess":

			$CURRENT_SECTION="OUR PROCESS";

			$PAGE_TITLE="OUR PROCESS | USP";

			include("../dynamic/pages/ourProcess.php");

		break;


		case "faq":

			$CURRENT_SECTION="FAQ";

			$PAGE_TITLE="FAQ | USP";

			include("../dynamic/pages/faq.php");

		break;


		case "contactus":

			$CURRENT_SECTION="CONTACT US";

			$PAGE_TITLE="CONTACT US | USP";

			include("../dynamic/pages/contactus.php");

		break;

		
		default: echo "Page not found";

	}


?>