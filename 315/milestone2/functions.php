<?php
# Jonathan Price Cindy La
# long-term goal: use classes, etc.

function read_file()
{
  $lines = file( "users.csv", FILE_IGNORE_NEW_LINES );
  return $lines;
}

function user_exists( $username )
{
  # goal: check that username is unique
  $lines = read_file();
  foreach ($lines as $line)
  {
    $users = explode("\t", $line);
    if($users[0] == $username)
    {
      return true;
    }
  }
  return false;
}

function add_user( $username, $fullname, $password )
{
  $string = "$username\t$fullname\t$password" . PHP_EOL;
  file_put_contents("users.csv", $string, FILE_APPEND);
}

function gen_password($length = 10){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'
                   . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/*
function change_fname( $username, $fullname )
{
  $lines = read_file();
  foreach ($lines as $line)
  {
    $users = explode("\t", $line);
    if($users[0] == $username)
    {
      
    }
    else if($users[1] == $fullname
  }
  return false;
}
*/
/*
function over_write()
{
  # read file into $lines
  # find $line where $username = $_POST['new_username']
  # 
}*/

/*
class User() {

	$username;
	$fullname;
	$hash;

	function __construct($username, $fullname, $password_hash)
	{
		# should this also get values from user?

		$this->$username = $username;
		$this->fullname = $fullname;
		$this->hash = $password_hash;
	}

	function change_password()
	{

	}

	function change_fullname()
	{
		
	}

}
*/

?>
