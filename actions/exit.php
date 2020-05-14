<?php

	//error_reporting(0);
	
	setcookie('user', "", time() - 3600, "/laba_3/");
	setcookie('hash', "", time() - 3600, "/laba_3/");
	
	header("Location: $_SERVER[HTTP_REFERER]");