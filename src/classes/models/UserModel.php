<?php
    class UserModel extends Model {
        public function getUserById($id) {
            $user = $this->getUserByIdFromDb($id);
            unset($user['password']);

            return $user;
        }

        // PRIV

        private function getUserByIdFromDb($id) {
            $this->db->query('SELECT id, username, password  FROM users WHERE id LIKE :id;');
            $this->db->bind(':id', $id);
            $user = $this->db->single();

            return $user;
        }
    }