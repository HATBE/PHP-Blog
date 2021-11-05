<?php
    class PostModel extends Model {
        private $parsedown;

        public function __construct() {
            $this->db = new Database();
            $this->parsedown = new Parsedown();
            $this->parsedown->setSafeMode(true);
        }


        public function getPostsLimit($page = 1) {
            $page = $page === null || !is_numeric($page) ? 1 : filter_var($page, FILTER_SANITIZE_NUMBER_INT);

            $count = $this->getFullCount();
            $maxPage = ceil($count / ITEMS_PER_PAGE);
            $page = $page < 1 ? 1 : $page; // correct if page is under limit
            $page = $page > $maxPage ? $maxPage : $page; // correct if page is over limit
            $start = ($page * ITEMS_PER_PAGE) - ITEMS_PER_PAGE;
            $elements = $page >= $maxPage ? $count % ITEMS_PER_PAGE : ITEMS_PER_PAGE; // in case the last page has not full count of elements
            $elements = $maxPage <= 1 ? $count : $elements;

            $posts['meta'] = [
                'page' => $page,
                'maxPage' => $maxPage,
                'count' => $count,
                'elements' => $elements
            ];

            $this->db->query('SELECT posts.id as pid, users.username, posts.title, posts.body, posts.date from posts INNER JOIN users ON users.id LIKE posts.user_fk ORDER BY posts.date DESC LIMIT :from, :to;');
            $this->db->bind(':from', $start);
            $this->db->bind(':to', ITEMS_PER_PAGE);
            $posts['posts'] = $this->db->resultSet();

            foreach($posts['posts'] as $post) {
                $post->body = strlen($post->body) > 400 ? substr($post->body, 0, 400) . '...' : $post->body;
                $post->body = strip_tags($this->parsedown->text($post->body));
                $post->date = date('d.m.Y H:i', strtotime($post->date));
            }
            return $posts;
        }

        public function getPostByIdMd($id) {

            $post = $this->getPostById($id);

            $post->body = $this->parsedown->text($post->body);

            return $post;
        }

        public function getPostById($id) {
            $id = $id === null || !is_numeric($id) ? null : filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            if($id == null) return null;

            $this->db->query('SELECT posts.id as pid, users.username, posts.title, posts.body, posts.date FROM posts INNER JOIN users ON users.id LIKE posts.user_fk WHERE posts.id LIKE :id;');
            $this->db->bind(':id', $id);
            $post = $this->db->single();

            if($post == null) return null;

            $post->date = date('d.m.Y H:i', strtotime($post->date));

            return $post;
        }

        public function create($title, $body, $userId) {
            $this->db->query('INSERT INTO posts (title, body, user_fk) VALUES (:title, :body, :userId);');
            $this->db->bind(':title', $title);
            $this->db->bind(':body', $body);
            $this->db->bind(':userId', $userId);
            $this->db->execute();

            return $this->db->lastId();
        }

        public function deleteAllPostsFromUserId($id) {
            $this->db->query('DELETE FROM posts WHERE user_fk LIKE :id;');
            $this->db->bind(':id', $id);
            $this->db->execute();
            
            return true;
        }

        public function update($title, $body, $id) {
            $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id LIKE :id');
            $this->db->bind(':title', $title);
            $this->db->bind(':body', $body);
            $this->db->bind(':id', $id);
            $this->db->execute();

            return true;
        }

        public function existsId($id) {
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

        public function getFullCount() {
            $this->db->query('SELECT COUNT(id) c FROM posts;');
            $count = $this->db->single();

            return $count->c;
        }

    }