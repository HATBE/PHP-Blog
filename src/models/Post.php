<?php

    require_once(__DIR__ . '/../Model.php');

    class Post extends Model {
        public function getPostById($id) {
            $this->db->query('SELECT users.username, posts.id, posts.title, posts.body, posts.created_at FROM users, posts WHERE users.id LIKE posts.user_id AND posts.id LIKE :id;');
            $this->db->bind(':id', $id);

            $row = $this->db->single();
            
            return $row;
        }

        public function getAllPosts() {
            $this->db->query('SELECT users.username, posts.id, posts.title, posts.body, posts.created_at FROM users, posts WHERE users.id LIKE posts.user_id ORDER BY created_at DESC;');
            $results = $this->db->resultSet();

            return $this->db->rowCount() > 0 ? $results : null;
        }

        public function getAllPostsWithLimit($from, $to) {
            $this->db->query('SELECT users.username, posts.id, posts.title, posts.body, posts.created_at FROM users, posts WHERE users.id LIKE posts.user_id ORDER BY created_at DESC LIMIT :from, :to ;');
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
            $this->db->query('SELECT id FROM posts ORDER BY created_at DESC LIMIT 1;');
            $result = $this->db->single();

            return $this->db->rowCount() > 0 ? $result->id : null;
        }
    }