<?php

class ShareModel extends Model{
    public function Index(){
        $this->query('SELECT * FROM shares');
        $rows = $this->resultSet();

        echo '<br><br>model data<br><br>';
        print_r($rows);
        echo '<br><br>model data<br><br>';

        return $rows;
    }

    public function add(){
        return;
    }

}