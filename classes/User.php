<?php
require_once 'Database.php';

class User extends Database
{
  public function signup($data)
  {

    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";

    return  $this->insert_data($query, $data);
  }

  public function login($data)
  {
    $query = "SELECT * FROM users WHERE username  =:username";
    $res = $this->fetch_data($query, ['username' => $data['username']]);
    if (!empty($res[0])) {
      $passCheck = password_verify($data['password'], $res[0]['password']);

      if ($passCheck) {
        return $res[0];
      } else {
        return false;
      }
    } else {
      return false;
    }
  }




  public function validation($username, $password, $password2 = '')
  {
    if (empty($username) && empty($password) && empty($password2)) {
      return "Please fill the all required fields!";
    }

    if ($password2 !== '')
      if ($password != $password2) {
        return "Password does not match!";
      }

    return true;
  }


  public function check_username($username)
  {
    $query = "SELECT * FROM users WHERE username = :username";
    $res = $this->check($query, ['username' => $username]);

    if ($res) {
      return "Username is already taken!";
    }
  }
}
