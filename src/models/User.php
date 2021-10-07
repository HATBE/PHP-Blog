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

        public function existsUname($uname) {
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