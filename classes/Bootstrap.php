<?php
class Bootstrap{
	private $controller;
	private $action;
	private $request;

	public function __construct($request){
        $this->request = $request;
        
		if($this->request['controller'] == ""){
			$this->controller = 'home';
		} else {
			$this->controller = $this->request['controller'];
        }
        
		if($this->request['action'] == ""){
			$this->action = 'index';
		} else {
			$this->action = $this->request['action'];
		}
    
        echo $this->controller;
    }

	public function createController(){
		// Check Class
		echo  '<br/>before if : '.$this->controller;

		if(class_exists($this->controller)){
			echo  '<br/>after if : '.class_exists($this->controller);
			echo  '<br/>parents : '.print_r(class_parents($this->controller));

			$parents = class_parents($this->controller);
			// Check Extend
			if(in_array("Controller", $parents)){
				if(method_exists($this->controller, $this->action)){
					return new $this->controller($this->action, $this->request);
				} else {
					// Method Does Not Exist
					echo '<h1>Method does not exist</h1>';
					return;
				}
			} else {
				// Base Controller Does Not Exist
				echo '<h1>Base controller not found</h1>';
				return;
			}
		} else {
			// Controller Class Does Not Exist
			echo '<h1>Controller class does not exist</h1>';
			return;
		}
	}
}