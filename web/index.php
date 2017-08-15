<?php

include_once "mysql.php";
include_once "config.php";

include_once "handle-error.php";

header("Content-type: text/json");

$conn = dbconnect($CFG_database, $CFG_username, $CFG_password);

$action = $_GET['action'];

switch($action) {
	case "status":
		include "run-status.php";
		break;
	case "ban":
		include "run-ban.php";
		break;
	case "unban":
		include "run-unban";
		break;
	case "store":
		include "run-store.php";
		break;
	default:
		return_error("Invalid action");
		break;
}

?>
