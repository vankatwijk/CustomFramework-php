<?php

class home extends Controller{
    protected function Index(){
        $viewmodel = new HomeModel();
        $this->ReturnView($viewmodel->Index(), true);
    }
}
?>