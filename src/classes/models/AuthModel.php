<?php
    class AuthModel extends Model {
        public function login($uname, $passwd) {
            $this->db->query('SELECT id, password FROM users WHERE username LIKE :uname;');
            $this->db->bind(':uname', $uname);
            $user = $this->db->single();

            if($this->db->rowCount() <= 0) {
                return false;
            }

            if($user == null) return false;

            $passwordHash = $user->password;

            if(password_verify($passwd, $passwordHash)) {
                return $user->id;
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