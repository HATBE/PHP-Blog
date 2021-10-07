<?php
    require_once(__DIR__ . '/../Model.php');

    class User extends Model {
        public function getAllUsers() {
            $this->db->query('SELECT id, username FROM users');
            $results = $this->db->resultSet();

            return $this->db->rowCount() > 0 ? $results : null;
        }

        public function getUserById($id) {
            $this->db->query('SELECT id, username, password FROM users WHERE id LIKE :id');
            $this->db->bind(':id', $id);
            $results = $this->db->single();

            return $this->db->rowCount() > 0 ? $results : null;
        }
        
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

        public function exists($uname) {
            $this->db->query('SELECT id FROM users WHERE username LIKE :username;');
            $this->db->bind(':username', $uname);
            $this->db->execute();
            
            return $this->db->rowCount() >= 1 ? true : false;
        }

        public function existsId($id) {
            $this->db->query('SELECT id FROM users WHERE id LIKE :id;');
            $this->db->bind(':id', $id);
            $this->db->execute();
            
            return $this->db->rowCount() >= 1 ? true : false;
        }

        public function register($uname, $passwd) {
            $this->db->query('INSERT INTO users (username, password) VALUES (:username, :password);');
            $this->db->bind(':username', $uname);
            $this->db->bind(':password', $passwd);
            $this->db->execute();

            return true;
        }

        public function delete($id) {
            $this->db->query('DELETE FROM users WHERE id LIKE :id;');
            $this->db->bind(':id', $id);
            $this->db->execute();

            return true;
        }

        public function update($uname, $passwd, $id) {
            $this->db->query('UPDATE users SET username = :username, password = :password WHERE id LIKE :id;');
            $this->db->bind(':username', $uname);
            $this->db->bind(':password', $passwd);
            $this->db->bind(':id', $id);
            $this->db->execute();

            return true;
        }
    }