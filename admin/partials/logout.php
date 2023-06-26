<?php
include('../config/constants.php');
//1. destroy the ssession 
session_destroy();//unsets $_SESSION['user']
//2.redirect to login page 
header('location:'.SITEURL.'admin/login.php');
?>