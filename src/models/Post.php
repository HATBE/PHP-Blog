<?php

    require_once(__DIR__ . '/../Model.php');

    class Post extends Model {
        public function getPostById($id) {
            $this->db->query('SELECT users.username, posts.id, posts.title, posts.body, posts.date FROM users, posts WHERE users.id LIKE posts.userId AND posts.id LIKE :id;');
            $this->db->bind(':id', $id);

            $row = $this->db->single();
            
            return $row;
        }

        public function getAllPosts() {
            $this->db->query('SELECT users.username, posts.id, posts.title, posts.body, posts.date FROM users, posts WHERE users.id LIKE posts.userId ORDER BY posts.date DESC;');
            $results = $this->db->resultSet();

            return $this->db->rowCount() > 0 ? $results : null;
        }

        public function getAllPostsWithLimit($from, $to) {
            $this->db->query('SELECT users.username, posts.id, posts.title, posts.body, posts.date FROM users, posts WHERE users.id LIKE posts.userId ORDER BY posts.date DESC LIMIT :from, :to ;');
            $this->db->bind(':from', $from);
            $this->db->bind(':to', $to);
            $results = $this->db->resultSet();

            return $this->db->rowCount() > 0 ? $results : null;
        }

        public function getPostsCount() {
            $this->db->query('SELECT COUNT(*) as count FROM posts;');
            $count = $this->db->single();

            return $count->count;
        }

        public function getNewestPostId() {
            $this->db->query('SELECT id FROM posts ORDER BY date DESC LIMIT 1;');
            $result = $this->db->single();

            return $this->db->rowCount() > 0 ? $result->id : null;
        }

        public function exists($id) {
            $this->db->query('SELECT id FROM posts WHERE id LIKE :id;');
            $this->db->bind(':id', $id);
            $this->db->execute();
            
            return $this->db->rowCount() >= 1 ? true : false;
        }

        public function delete($id) {
            $this->db->query('DELETE FROM posts WHERE id LIKE :id;');
            $this->db->bind(':id', $id);
            $this->db->execute();
            
            return true;
        }

        public function deleteAllPostsFromUserId($id) {
            $this->db->query('DELETE FROM posts WHERE userId LIKE :id;');
            $this->db->bind(':id', $id);
            $this->db->execute();
            
            return true;
        }

        public function create($title, $body, $userId) {
            $this->db->query('INSERT INTO posts (title, body, userId) VALUES (:title, :body, :userId);');
            $this->db->bind(':title', $title);
            $this->db->bind(':body', $body);
            $this->db->bind(':userId', $userId);
            $this->db->execute();

            return $this->db->lastId();
        }

        public function update($title, $body, $id) {
            $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id LIKE :id');
            $this->db->bind(':title', $title);
            $this->db->bind(':body', $body);
            $this->db->bind(':id', $id);
            $this->db->execute();

            return true;
        }
    }