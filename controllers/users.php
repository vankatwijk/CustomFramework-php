<?php

class users extends Controller{
    protected function register(){
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->register(), true);
    }
}
?>