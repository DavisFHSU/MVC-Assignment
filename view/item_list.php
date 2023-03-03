<?php include './view/header.php'; ?>
<main>
    <h1>To Do List</h1>

    <form action="./index.php" method="get"
              id="add_product_form2">

            <label>Category:</label>
            <select name="category_id">
            <option value= 0>View All Categories</option>
                <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>
            <input type="submit" value="Submit">
</form>
                </section>

    
        <!-- display a table -->
        <br>
        <br>
        <h2>Category:<?php echo $category_name; ?></h2>
            <table>
            <tr>
                <th>Title</th>
                <th>Decription</th>
                <th>Category Name</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($items as $item) : ?>
            <tr>
                <td><?php echo $item['Title']; ?></td>
                <td><?php echo $item['Description']; ?></td>
                <td><?php echo $item['categoryName']; ?></td>
                <td><form action="?action=delete_item" method="post">
                    <input type="hidden" name="item_id"
                           value="<?php echo $item['ItemNum']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <p class="last_paragraph">
            <a href="?action=show_item_add_form">Add Item</a>
            <br>
            <br>
            <a href="?action=show_category_add_form">Add Category</a>
            <br>
            <br>
            <a href="?action=show_category_delete_form">Delete Category- Warning this may cause orphaned items.</a>
        </p>
    </section>
</main>
<?php include './view/footer.php'; ?>