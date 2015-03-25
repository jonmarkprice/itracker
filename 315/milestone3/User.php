<?
# aggregated by UserFile 
# or UserDatabase
class User() {

  # same as add_user(..)
  public function __construct($username, $fullname, $password_hash)
  {
    $string = "$username\t$fullname\t$password" . PHP_EOL;
    file_put_contents("users.csv", $string, FILE_APPEND);
  }

  # Sends password to $email
  private function send_password($password, $email)
  {    
    //$to = $_POST['reset_email'];
    $to = $email;
    $subject = "Inventory tracker password reset";
    $from = "jmp3748@truman.edu";
    $msg = "Your new password for $username is $new_password \n";
    mail( $to, $subject, $msg, 'From:' . $from );
  }

  private function generate_password($length)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'
                . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function reset_password($email)
  {
    $new_password = generate_password(5);
    change_password($new_password);
    send_password($new_password, $email);
  }

  function change_password($new_password)
  {
    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    # open file or database
    # find user with $username
    # set password to $new_password
  }

  function change_fullname($new_fullname)
  {
    $fullname = $new_fullname;
    # open file or database
    # find user with $username
    # change #full_name
  }


}
?>
