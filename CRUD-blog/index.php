<?php
require 'classes/Database.php';

//uses our pdo database class
$database = new Database;

//sanitize the inputes from ex: $_POST['title'], ensures everything is a string
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if($_POST['delete']){
    $delete_id = $_POST['delete_id'];
    $database->query('DELETE FROM posts WHERE id = :id');
    $database->bind(':id', $delete_id);
    $database->execute();
}

if($post['submit']){
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];

    //insert new post into the db
    $database->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->bind(':id', $id);
    $database->execute();

    echo $database->lastInsertId();
    if($database->lastInsertId()){
        echo '<p>Post Added</p>';
    }
}

//get all post from the database
$database->query('SELECT * FROM posts');
$rows = $database->resultset();
//print_r($rows);


?>

<h1>Add Post</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <label>Post ID</label><br/>
    <input type="text" name="id" placeholder="Specify Id" /><br/>
    <label>Post Title</label><br/>
    <input type="text" name="title" placeholder="Add a Title... " /><br/>
    <label>Post Body</label><br/>
    <textarea name="body"></textarea><br/><br/>
    <input type="submit" name="submit" />
</form>


<h1>Posts</h1>
<div>
<?php foreach($rows as $row) : ?>
    <div>
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['body']; ?></p>
        </br>
        
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
            <input type="submit" value="Delete" name="delete">
        </form>
    </div>
<?php endforeach; ?>
</div>