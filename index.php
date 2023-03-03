<?php
require('./model/database.php');
require('./model/item_db.php');
require('./model/category_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_items';
    }
}

if ($action == 'list_items') {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 0;

    }   if ($category_id == 0) {
        $category_name = "All Items";
        $categories = get_categories();
        $items = get_all_items();

    }   if($category_id > 0) {
        $category_name = get_category_name($category_id);
        $categories = get_categories();
        $items = get_items_by_category($category_id);
    }

    include('./view/item_list.php');


} else if ($action == 'delete_item') {
    $item_id = filter_input(INPUT_POST, 'item_id', 
            FILTER_VALIDATE_INT);
            
    if ($item_id == NULL || $item_id == FALSE) {
        $error = "Missing or incorrect product id or category id.";
        include('./errors/error.php');
    } else { 
        delete_item($item_id);
        header("Location: .?action=list_items");
    }


} else if ($action == 'show_category_delete_form') {
       $categories = get_categories();
       include('./view/category_delete.php'); 


} else if ($action == 'delete_category') {
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);
                
        if ($category_id == NULL || $category_id == FALSE) {
            $error = "Missing or incorrect product id or category id.";
            include('./errors/error.php');
        } else { 
            delete_category($category_id);
            header("Location: .?action=list_items");
        }


} else if ($action == 'show_item_add_form') {
    $categories = get_categories();
    include('./view/item_add.php');    


} else if ($action == 'add_item') {
    $category_ID = filter_input(INPUT_POST, 'category_id');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    
    if ($category_ID == NULL || $title == NULL || 
            $description == NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        include('./errors/error.php');
    } else { 
        add_item($category_ID, $title, $description);
        header("Location: .?action=list_items");
    }
}    

else if ($action == 'show_category_add_form') {
    $categories = get_categories();
    include('./view/category_add.php');    


} else if ($action == 'add_category') {
    $category_name = filter_input(INPUT_POST, 'category_name');
        
    if ($category_name == NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        include('./errors/error.php');
    } else { 
        add_category($category_name, $title, $description);
        header("Location: .?action=list_items");
    }
} 







?>