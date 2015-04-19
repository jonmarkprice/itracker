<?php

// sanitize inputs and assign
$username = htmlspecialchars($_POST['username']);
$firstname = htmlspecialchars($_POST['firstname']);
$lastname = htmlspecialchars($_POST['lastname']);
$email = htmlspecialchars($_POST['email']);

echo $username . PHP_EOL;
echo $firstname . PHP_EOL;
echo $lastname . PHP_EOL;
echo $email . PHP_EOL;

