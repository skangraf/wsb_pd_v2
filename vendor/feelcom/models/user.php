<?php
class User extends Model{

    public function register(){

        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $password = sha1($post['password']);

        if($post['submit']){

            if($post['name'] == '' || $post['email'] == '' || $post['password'] == ''){
                Messages::setMsg('Proszę wypełnić wszystkie pola', 'error');
                return;
            }

            // Insert into MySQL
            $this->query('INSERT INTO accounts (name, email, password) VALUES(:name, :email, :password)');
            $this->bind(':name', $post['name']);
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $this->execute();

            // Verify
            if($this->lastInsertId()){
                return true;
            }
        }

        return false;
    }

    public function login(){

        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $password = sha1($post['password']);

        if($post['submit']){

            // Compare Login
            $this->query('SELECT * FROM accounts WHERE email = :email AND password = :password');
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $row = $this->single();



            if($row){
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "email" => $row['email']
                );
                return true;
            }
        }
        return false;
    }

    public function capabilities($id=0){

        if($_SESSION['is_logged_in']){

            $res = array();

            if ($id==0){
                $id = filter_var($_SESSION['user_data']['id'],FILTER_SANITIZE_NUMBER_INT);
            }
            else {
                $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
            }


            $this->query('SELECT A.name FROM capabilities A JOIN capabilities_user B ON B.capabilities_id = A.id WHERE user_id =:id');
            $this->bind(':id', $id);
            $results = $this->resultSet();

            if(!empty($results)){
                $i=0;
                foreach ($results as $row){
                    $res[$i] = $row['name'];
                    $i++;
                }
            }

            return $res;

        }

        return false;

    }

    public function getUsers(){

        $userCan = $this->capabilities();

        if($_SESSION['is_logged_in'] && in_array('admin',$userCan)){

            $this->query('SELECT id,name,email,enabled,expiry FROM accounts');

            return $this->resultSet();

        }

        return false;

    }

}