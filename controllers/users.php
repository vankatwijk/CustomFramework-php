<?php

class Users extends Controller{
    protected function Index(){
        $viewmodel = new UserModel();
        $this->ReturnView($viewmodel->Index(), true);
    }
}
?>