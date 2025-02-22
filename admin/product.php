<!-- Add New Menu Item Form -->
<form action="add_menu_item.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Item Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" name="price" step="0.01" placeholder="Price" required>
    <input type="file" name="image" required>
    <button type="submit">Add Item</button>
</form>

<!-- List of Menu Items -->
<table>
    <tr>
        <th>Item Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM menu_items");
    while ($item = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$item['name']}</td>
                <td>{$item['description']}</td>
                <td>{$item['price']}</td>
                <td><a href='edit_item.php?id={$item['id']}'>Edit</a> | <a href='delete_item.php?id={$item['id']}'>Delete</a></td>
              </tr>";
    }
    ?>
</table>
