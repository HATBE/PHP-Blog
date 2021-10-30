<?php
    class PostModel extends Model {
        public function getIndexPosts($page = 1) {
            $page = $page === null || !is_numeric($page) ? 1 : filter_var($page, FILTER_SANITIZE_NUMBER_INT);

            $count = $this->getFullCount();
            $maxPage = ceil($count / ITEMS_PER_PAGE);
            $page = $page < 1 ? 1 : $page; // correct if page is under limit
            $page = $page > $maxPage ? $maxPage : $page; // correct if page is over limit
            $start = ($page * ITEMS_PER_PAGE) - ITEMS_PER_PAGE;
            $elements = $page >= $maxPage ? $count % ITEMS_PER_PAGE : ITEMS_PER_PAGE; // in case the last page has not full count of elements

            $posts['meta'] = [
                'page' => $page,
                'maxPage' => $maxPage,
                'count' => $count,
                'elements' => $elements
            ];

            $posts['posts'] = $this->getPostsLimit($start, ITEMS_PER_PAGE);

            foreach($posts['posts'] as $post) {
                $post->body = strlen($post->body) > 400 ? substr($post->body, 0, 400) . '...' : $post->body;
                $post->date = date('d.m.Y H:i', strtotime($post->date));
            }
            return $posts;
        }

        // PRIV

        private function getFullCount() {
            $this->db->query('SELECT COUNT(id) c FROM posts;');
            $count = $this->db->single();

            return $count->c;
        }

        private function getPostsLimit(int $from, int $to) {
            $this->db->query('SELECT posts.id as pid, users.username, posts.title, posts.body, posts.date from posts INNER JOIN users ON users.id LIKE posts.user_fk ORDER BY posts.date DESC LIMIT :from, :to;');
            $this->db->bind(':from', $from);
            $this->db->bind(':to', $to);
            $posts = $this->db->resultSet();

            return $posts;
        }

        private function getPostById(int $id) {
            $this->db->query('SELECT posts.id as pid, users.username, posts.title, posts.body, posts.date FROM posts INNER JOIN users ON users.id LIKE posts.user_fk WHERE posts.id LIKE :id;');
            $this->db->bind(':id', $id);
            $post = $this->db->single();

            return $post;
        }


    }