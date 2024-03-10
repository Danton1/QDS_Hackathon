<?php
if (isset($_SESSION["id"])) {
    include("header_logged_in.php");
} else {
    include("header_logged_out.php");
}
?>