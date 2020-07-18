<?php

function addCategory() 
{
    global $connect;
    if(isset($_POST['submit'])) 
    {
        $title = $_POST['cat_title'];

        if($title == "" || empty($title)) 
        {
            echo "<span class='text-danger'>This field cannot be empty!</span>";
        } 
        else 
        {
            $query = "INSERT INTO categories(cat_title) VALUES ('$title')";
            $result = mysqli_query($connect, $query);
            if(!$result) 
            {
                die("<p class='text-danger'>Sorry, category could not be added!</p>");
            }
            header("Location: categories.php");
        }
    }
}


function showCategories()
 {
    global $connect;
    $query = "SELECT * FROM categories";
    $categories = mysqli_query($connect, $query);
    while($row = mysqli_fetch_assoc($categories))
     {
        $catTitle = $row['cat_title'];
        $catID = $row['cat_id'];
        echo "<tr><td>".$catID."</td>";
        echo "<td>".$catTitle;
        echo "<a class='float-right text-danger' style='text-decoration: none' href='categories.php?delete={$catID}'>DELETE</a>";
        echo "<a class='float-right text-primary' style='text-decoration: none' href='categories.php?edit={$catID}'>EDIT&emsp;</a></td></tr>";
    }
}


function deleteCategory() 
{
    global $connect;
    if(isset($_GET['delete'])) 
    {
        $delID = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$delID} ";
        $deleteCat = mysqli_query($connect, $query);
        header("Location: categories.php");

    }
}

?>