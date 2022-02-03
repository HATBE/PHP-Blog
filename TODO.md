# TODO

## Backend
### REST API Endpoints
- SESSIONS
  - PATCH /sessions/{id}    -> renew session
  - DELETE /sessions/{id}   -> logout
  - POST /sessions          -> login
- USERS
  - GET /users              -> get all users
  - GET /users/page/{page}  -> get users with pagination
  - GET /users/{id}         -> get specific user
  - POST /users             -> Register
  - PATCH /users/{id}       -> edit use
  - DELETE /users/{id}      -> delete a user
- POSTS
  - GET /posts              -> get all posts
  - GET /posts/page/{page}  -> get posts with pagination
  - GET /posts/top/{amount} -> get the a number of top posts
  - GET /posts/random       -> get a random post
  - GET /posts/{id}         -> get specific post
  - POST /posts             -> Create Post
  - PATCH /posts/{id}       -> Edit Post
  - DELETE /posts/{id}      -> delete a post
## Frontent
