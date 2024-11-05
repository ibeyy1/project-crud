<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
        <?php
// include database connection
include 'koneksi.php';

if ($_POST) {
    try {
        // insert query
        $query = "INSERT INTO shapes
        SET title_shape=:title_shape, shape=:shape, image=:image, x=:x, y=:y, width=:width, height=:height, radius=:radius, clickable=:clickable, text_title=:text_title, font_size=:font_size,text_subtitle=:text_subtitle, subtitle_font_size=:subtitle_font_size, created_at=:created_at";

        // prepare query for execution
        $stmt = $con->prepare($query);

        // posted values
        $title_shape = htmlspecialchars(strip_tags($_POST['title_shape']));
        $shape = htmlspecialchars(strip_tags($_POST['shape']));
        $x = htmlspecialchars(strip_tags($_POST['x']));
        $y = htmlspecialchars(strip_tags($_POST['y']));
        $width = htmlspecialchars(strip_tags($_POST['width']));
        $height = htmlspecialchars(strip_tags($_POST['height']));
        $radius = htmlspecialchars(strip_tags($_POST['radius']));
        $clickable = htmlspecialchars(strip_tags($_POST['clickable']));
        // $title = htmlspecialchars(strip_tags($_POST['title']));
        $text_title = htmlspecialchars(strip_tags($_POST['text_title']));
        $font_size = htmlspecialchars(strip_tags($_POST['font_size']));
        // $subtitle = htmlspecialchars(strip_tags($_POST['subtitle']));
        $text_subtitle = htmlspecialchars(strip_tags($_POST['text_subtitle']));
        $subtitle_font_size = htmlspecialchars(strip_tags($_POST['subtitle_font_size']));

        // new 'image' field
        $image = !empty($_FILES["image"]["name"])
            ? time() . "_" . $_FILES["image"]["name"]
            : "";

        // bind the parameters
        $stmt->bindParam(':title_shape', $title_shape);
        $stmt->bindParam(':shape', $shape);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':x', $x);
        $stmt->bindParam(':y', $y);
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':radius', $radius);
        $stmt->bindParam(':clickable', $clickable);
        // $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text_title', $text_title);        
        $stmt->bindParam(':font_size', $font_size);
        // $stmt->bindParam(':subtitle', $subtitle);
        $stmt->bindParam(':text_subtitle', $text_subtitle);
        $stmt->bindParam(':subtitle_font_size', $subtitle_font_size);
      

        // specify when this record was inserted to the database
        $created_at = date('Y-m-d H:i:s');
        $stmt->bindParam(':created_at', $created_at);

        // Execute the query
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Record was saved.</div>";

            // now, if image is not empty, try to upload the image
            if ($image) {
                // make sure that file is a real image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    // submitted file is an image
                } else {
                    echo "<div class='alert alert-danger'>Submitted file is not an image.</div>";
                }

                // make sure certain file types are allowed
                $allowed_file_types = array("jpg", "jpeg", "png", "gif");
                $file_type = pathinfo($image, PATHINFO_EXTENSION);
                if (!in_array($file_type, $allowed_file_types)) {
                    echo "<div class='alert alert-danger'>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                }

                // make sure submitted file is not too large, can't be larger than 1 MB
                if ($_FILES['image']['size'] > (1024000)) {
                    echo "<div class='alert alert-danger'>Image must be less than 1 MB in size.</div>";
                }

                // make sure the 'uploads' folder exists
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // if no errors, try to upload the file
                if (move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/' . $image)) {
                    // it means photo was uploaded
                } else {
                    echo "<div class='alert alert-danger'>Unable to upload photo.</div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
            echo "<div class='alert alert-danger'>" . $stmt->errorInfo()[2] . "</div>";
        }
    } catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
<!-- html form here where the product information will be entered -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Title</td>
            <td><input type='text' name='title_shape' class='form-control' /></td>
        </tr>
        <tr>
            <td>Shape</td>
            <td>
            <select name='shape' class='form-control'>
                    <option value='' disabled selected>Select a shape</option>
                    <option value='circle'>Circle</option>
                    <option value='rectangle'>Rectangle</option>
            </select>
            </td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="image" /></td>
        </tr>
        <tr>
            <td>X</td>
            <td><input type='text' name='x' class='form-control' /></td>
        </tr>
        <tr>
            <td>Y</td>
            <td><input type='text' name='y' class='form-control' /></td>
        </tr>
        <tr>
            <td>Width</td>
            <td><input type='text' name='width' class='form-control' /></td>
        </tr>
        <tr>
            <td>Height</td>
            <td><input type='text' name='height' class='form-control' /></td>
        </tr>
        <tr>
            <td>Radius</td>
            <td><input type='text' name='radius' class='form-control' /></td>
        </tr>
        <tr>
            <td>Clickable</td>
            <td>
                <fieldset>
                <select name='clickable' class='form-control'>
                    <option value='' disabled selected></option>
                    <option value='Yes'>Yes</option>
                    <option value='No'>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Title</td>
            <td>
                <fieldset>
                <label>text</label></br>
                <input type='text' name='text_title' class='form-control' />
                <label>font size</label></br>
                <input type='text' name='font_size' class='form-control' />
                </fieldset>
            </td>
        </tr>
        <tr>
            <td>Subtitle</td>            
            <td>
                <fieldset>
                <label>text</label></br>
                <input type='text' name='text_subtitle' class='form-control' />
                <label>font size</label></br>
                <input type='text' name='subtitle_font_size' class='form-control' />
            </fieldset>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to read products</a>
            </td>
        </tr>
    </table>
</form>
    </div> <!-- end .container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>