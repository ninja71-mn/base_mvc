<?php


class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function balanceLimit($uid)
    {
        $this->db->query('SELECT balance_temp.*, users.username FROM balance_temp INNER JOIN users ON 
balance_temp.b_balancer=users.u_id
 WHERE b_uid=:uid ORDER BY b_date DESC LIMIT 3 
');
        $this->db->bind(":uid",$uid);
        $row=$this->db->resultSet();
        $count=$this->db->rowCount();
        if ($count==3){
            return $row;
        }else{
            $need=3-$count;
            $this->db->query('SELECT balances.*, users.username FROM balances 
            INNER JOIN users ON 
balances.b_balancer=users.u_id WHERE b_uid=:uid ORDER BY b_date DESC LIMIT '.$need);
            $this->db->bind(":uid",$uid);
            $row+=$this->db->resultSet();
            return $row;
        }

    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        $hashed_password = $row->pass;
        if (password_verify(md5($password), $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (username,email,pass,date) VALUES (:username ,:email ,:pass , :date)');
        // Bind value
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['password']);
        $this->db->bind(':date', time());

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function searchUsers($data)
    {
        $data = str_replace(' ', '_', strtolower($data));
        $this->db->query("SELECT * FROM users WHERE username like :name AND type !=:type AND verify=:verify AND type !=:admin");

        $this->db->bind(':name', '%' . $data . '%');
        $this->db->bind(':type', 'master');
        $this->db->bind(':admin', 'admin');
        $this->db->bind(':verify', '1');

        return $this->db->resultSet();
    }

    public function userInfo($id)
    {
        $this->db->query('SELECT * FROM users WHERE u_id=:id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        if ($row){
            return $row;
        }else{
            return false;
        }
    }

}