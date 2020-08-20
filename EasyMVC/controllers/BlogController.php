<?php

class BlogController extends Controller {
    
    function index() {
        echo "home page of BlogController";
    }
    
    function blog($name) {
        echo "Blog! $name";
    }
    
}

?>