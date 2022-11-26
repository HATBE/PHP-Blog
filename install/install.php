<?php
    if(!is_writable(__DIR__ . '/../config/')) {
        echo "Error! no permissions on /config!";
        exit();
    }
    if(isset($_POST['submit'])) {
        if(!isset($_POST['dbhost']) || !isset($_POST['dbuser']) || !isset($_POST['dbpass']) || !isset($_POST['dbname']) || !isset($_POST['url']) || !isset($_POST['keywords']) || !isset($_POST['description']) || !isset($_POST['title']) || !isset($_POST['slogan'])) {
            echo "please fill in all inputs";
            exit();
        }
        $dbhost = $_POST['dbhost'];
        $dbuser = $_POST['dbuser'];
        $dbpass = $_POST['dbpass'];
        $dbname = $_POST['dbname'];
        $url = substr($_POST['url'], -1) !== '/' ? $_POST['url'] . '/': $_POST['url'];
        $keywords = $_POST['keywords'];
        $description = $_POST['description'];
        $title = $_POST['title'];
        $slogan = $_POST['slogan'];

        $config = "<?php
        // database
        define('DB_HOST', '".$dbhost."');
        define('DB_USER', '".$dbuser."');
        define('DB_PASS', '".$dbpass."');
        define('DB_NAME', '".$dbname."');
    
        // page settings
        define('ROOT_PATH', '".$url."'); // domain (must end with a \"/\"!)
        define('DEFAULT_KEYWORDS', '".$keywords."');
        define('DESCRIPTION', '".$description."');
        define('PAGE_TITLE', '".$title."');
        define('PAGE_SLOGAN', '".$slogan."');
    
        define('ITEMS_PER_PAGE', 4);";

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        if (mysqli_connect_errno()) {
            echo "Connection to database failed";
            exit();
        }

        $sql = "SHOW TABLES IN $dbname";
        $result = $conn->query($sql);

        if($result->num_rows !== 0) {
            echo "Database is not empty, delete all tables!";
            exit();
        }

        mysqli_select_db($conn, $dbname);

        $templine = '';
        $lines = file(__DIR__ . '/blog.sql');

        foreach ($lines as $line) {
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            $templine .= $line;
            if (substr(trim($line), -1, 1) == ';') {
                mysqli_query($conn, $templine);
                $templine = '';
            }

        }

        file_put_contents(__DIR__ . '/../config/config.php', $config);

        file_put_contents(__DIR__ . '/../install/.installed', 'true');
        header('Location: ' . $url);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <title>Installation</title>
    </head>
    <body>

    <div class="container">
        <h1>Installation</h1>
        <form method="post">
            <span>Please Create the Database!</span>
            <div class="mb-3">
                <label class="form-label">DB Host*</label>
                <input name="dbhost" type="text" value="localhost" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">DB User*</label>
                <input name="dbuser" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">DB Password*</label>
                <input name="dbpass" type="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">DB Name*</label>
                <input name="dbname" type="text" class="form-control" required>
            </div>
            <hr>
            <div class="mb-3">
                <label class="form-label">Title*</label>
                <input name="title" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">URL/Path*</label>
                <input name="url" value="<?= isset($_SERVER['HTTPS']) ? 'https://' : 'http://' ?><?= $_SERVER['HTTP_HOST']?>/" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Keywords*</label>
                <input name="keywords" type="text" class="form-control" required>
                <div class="form-text">Separate with ","</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description*</label>
                <input name="description" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Slogan*</label>
                <input name="slogan" type="text" class="form-control" required>
            </div>

            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
        
    </body>
</html>