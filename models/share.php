<?php

class ShareModel extends Model{
    public function Index(){
        $this->query('SELECT * FROM shares ORDER BY create_date');
        $rows = $this->resultSet();

        echo '<br><br>model data<br><br>';
        print_r($rows);
        echo '<br><br>model data<br><br>';

        return $rows;
    }

    public function add(){
        // sanitize POST
        $post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

        if($post['submit']){

            $this->query('INSERT INTO shares (title,body,link, user_id) VALUES(:title,:body,:link, :user_id)');
            $this->bind(':title',$post['title']);
            $this->bind(':body',$post['body']);
            $this->bind(':link',$post['link']);
            $this->bind(':user_id',1);

            $this->execute();

            //verify
            echo PDO::lastInsertId() .'lastid';

            if($this->lastInsertId()){
                //Redirect
                header('Location: '.ROOT_URL.'shares');
            }
        }
        return;
    }

}