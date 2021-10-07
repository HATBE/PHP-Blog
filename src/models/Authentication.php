<?php
    require_once(__DIR__ . '/../Model.php');

    class Authentication extends Model {
        public function login($uname, $passwd) {
            $this->db->query('SELECT id, password FROM users WHERE username LIKE :uname;');
            $this->db->bind(':uname', $uname);
            $row = $this->db->single();

            if($this->db->rowCount() <= 0) {
                return false;
            }

            $passwordHash = $row->password;

            if(password_verify($passwd, $passwordHash)) {
                return $row->id;
            } else {
                return false;
            }
        }
        
        public function register($uname, $passwd) {
            $this->db->query('INSERT INTO users (username, password) VALUES (:username, :password);');
            $this->db->bind(':username', $uname);
            $this->db->bind(':password', $passwd);
            $this->db->execute();

            return true;
        }
    }