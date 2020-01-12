<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION['email']);
unset($_SESSION['usertype']);
// Delete all session variables
 session_destroy();

// Jump to login page
header('Location: index.php');

?>