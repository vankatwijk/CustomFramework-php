<?php
require 'classes/Database.php';

//uses our pdo database class
$database = new Database;
$database->query('SELECT * FROM posts');
$rows = $database->resultset();
print_r($rows);

//sanitize the inputes from ex: $_POST['title'], ensures everything is a string
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if($post['submit']){
    echo 'SUBMITTED';

    $title = $post['title'];
    $body = $post['body'];

}

?>

<h1>Add Post</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<input type="text" name="title" placeholder="Add a Title... " /><br/>
<label>Post body</label><br/>
<textarea name="body"></textarea><br/><br/>
<input type="submit" name="submit" />
</form>


<h1>Posts</h1>
<div>
<?php foreach($rows as $row) : ?>
    <div>
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['body']; ?></p>
    </div>
<?php endforeach; ?>
</div>