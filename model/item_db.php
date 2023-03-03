<?php
function get_items_by_category($category_id) {
    global $db;
    $query =    'SELECT categories.categoryName, todoitems.Description,
                todoitems.Title, todoitems.ItemNum 
                FROM categories, todoitems
                WHERE todoitems.categoryID = categories.categoryID
                AND todoitems.categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":category_id", $category_id);
    $statement->execute();
    $items1 = $statement->fetchAll();
    $statement->closeCursor();
    return $items1;
}

function get_all_items() {
    global $db;
    $query = 'SELECT categories.categoryName, todoitems.Description,
    todoitems.Title, todoitems.ItemNum 
    FROM categories, todoitems
    WHERE todoitems.categoryID = categories.categoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $items2 = $statement->fetchAll();
    $statement->closeCursor();
    return $items2;
}

function delete_item($item_num) {
    global $db;
    $query = 'DELETE FROM todoitems
              WHERE ItemNum = :item_num';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_num', $item_num);
    $statement->execute();
    $statement->closeCursor();
}

function add_item($category_id, $title, $description) {
    global $db;
    $query = 'INSERT INTO todoitems
                 (categoryID, Description, Title)
              VALUES
                 (:categoryID, :description, :title)';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryID', $category_id);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':title', $title);
    $statement->execute();
    $statement->closeCursor();
}
?>