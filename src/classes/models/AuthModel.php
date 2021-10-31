<?php
    class AuthModel extends Model {
        public function login($uname, $passwd) {
            $user = $this->getUser($uname);

            if($user == null) return false;

            $passwordHash = $user->password;

            if(password_verify($passwd, $passwordHash)) {
                return $user->id;
            } else {
                return false;
            }
        }

        // PRIV

        private function getUser($uname) {
            $this->db->query('SELECT id, password FROM users WHERE username LIKE :uname;');
            $this->db->bind(':uname', $uname);
            $row = $this->db->single();

            if($this->db->rowCount() <= 0) {
                return false;
            }

            return $row;
        }
    }