<?php

function joinex_process_checkout(){

if(isset($_POST['name'])){

$name = sanitize_text_field($_POST['name']);

}

}

add_action('init','joinex_process_checkout');