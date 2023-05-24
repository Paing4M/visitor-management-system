<?php

require 'Database.php';

class Visitor extends Database
{

  public function add_visitor($data = [])
  {
    if (isset($data)) {
      $query = "INSERT INTO visitors (id_number , name , 	contact ,	email ,	reason ,	status , encode, 	entered_date , exited_date) VALUES (:id_number, :name, :contact, :email, :reason, :status, :encode , NOW() , NULL)";

      return $this->insert_data($query, $data);
    }
  }

  public function update_visitor($data)
  {
    if (isset($data)) {
      $query = "UPDATE visitors SET  	name = :name , contact = :contact , email = :email , reason = :reason , encode =:encode WHERE id = :id";

      return $this->insert_data($query, $data);
    }
  }

  public function check_exist_visitor_id($id)
  {
    $query = "SELECT * FROM visitors WHERE id_number = :id";

    return $this->check($query, ['id' => $id]);
  }


  public function fetch_all_visitor($limit = '', $offset = '', $startDate = '', $endDate = '')
  {
    $query = '';
    if ($limit !== '' && $offset !== '') {
      if ($startDate !== '' && $endDate !== '') {
        $query = "SELECT * FROM visitors WHERE entered_date BETWEEN $startDate AND $endDate LIMIT $limit OFFSET $offset";
      } else {

        $query = "SELECT * FROM visitors LIMIT $limit OFFSET $offset";
      }
    } else {
      $query = "SELECT * FROM visitors ";
    }
    return $this->fetch_data($query);
  }


  public function fetch_unexited_visitor()
  {
    $query = "SELECT * FROM visitors WHERE status = 1";
    return $this->fetch_data($query);
  }


  public function fetch_exited_visitor()
  {
    $query = "SELECT * FROM visitors WHERE status = 0";
    return $this->fetch_data($query);
  }


  public function fetch_single_visitor($id)
  {
    $query = "SELECT * FROM visitors WHERE id = :id";
    return $this->fetch_data($query, ['id' => $id])[0];
  }


  public function visitor_exit($id)
  {
    $query = "UPDATE visitors SET status = 0 ,exited_date = NOW()  WHERE id = :id";
    return  $this->insert_data($query, ['id' => $id]);
  }

  public function delete_visitor($id)
  {
    $query = "DELETE FROM visitors WHERE id = :id";
    return  $this->insert_data($query, ['id' => $id]);
  }

  public function search_visitor($search, $limit, $offset)
  {

    $query = "SELECT * FROM visitors WHERE name LIKE '%$search%' OR contact LIKE '%$search%' OR  reason LIKE '%$search%' LIMIT $limit OFFSET $offset ";
    return $this->fetch_data($query);
  }
}
