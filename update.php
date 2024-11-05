<!DOCTYPE HTML>
<html>
<head>
    <title>Update Record - PHP CRUD Tutorial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Update</h1>
        </div>

        <?php
        // Get passed parameter value, in this case, the record ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
        include 'koneksi.php';

        try {
            // Prepare select query
            $query = "SELECT id, title_shape, image, shape, x, y, width, height, radius, clickable, text_title, font_size, text_subtitle, subtitle_font_size FROM shapes WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Values to fill up our form
            $title_shape = $row['title_shape'];
            $image = $row['image'];
            $shape = $row['shape'];
            $x = $row['x'];
            $y = $row['y'];
            $width = $row['width'];
            $height = $row['height'];
            $radius = $row['radius'];
            $clickable = $row['clickable'];
            $text_title = $row['text_title'];
            $font_size = $row['font_size'];
            // $subtitle = $row['subtitle'];
            $text_subtitle = $row['text_subtitle'];
            $subtitle_font_size = $row['subtitle_font_size'];
        } catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }

        // Check if form was submitted
        if ($_POST) {
            try {
                // Handle image upload
                if (isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
                    $image = $_FILES['image']['name'];
                    $target_directory = "uploads/";
                    $target_file = $target_directory . basename($image);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Check if file is an image
                    $check = getimagesize($_FILES['image']['tmp_name']);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES['image']['size'] > 2000000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    } else {
                        // If everything is ok, try to upload file
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                            // If the new image is uploaded, we set the new image name
                            $image = htmlspecialchars(strip_tags($image));
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
                

                // Write update query
                $query = "UPDATE shapes
                          SET title_shape=:title_shape, image=:image, shape=:shape, x=:x, y=:y, width=:width, height=:height, radius=:radius, clickable=:clickable, text_title=:text_title, font_size=:font_size, text_subtitle=:text_subtitle, subtitle_font_size=:subtitle_font_size
                          WHERE id = :id";

                // Prepare query for execution
                $stmt = $con->prepare($query);

                // Posted values
                $title_shape = htmlspecialchars(strip_tags($_POST['title_shape']));
                $shape = htmlspecialchars(strip_tags($_POST['shape']));
                $x = htmlspecialchars(strip_tags($_POST['x']));
                $y = htmlspecialchars(strip_tags($_POST['y']));
                $width = htmlspecialchars(strip_tags($_POST['width']));
                $height = htmlspecialchars(strip_tags($_POST['height']));
                $radius = htmlspecialchars(strip_tags($_POST['radius']));
                $clickable = htmlspecialchars(strip_tags($_POST['clickable']));
                $text_title = htmlspecialchars(strip_tags($_POST['text_title']));
                $font_size = htmlspecialchars(strip_tags($_POST['font_size']));
                // $Subtitle = htmlspecialchars(strip_tags($_POST['subtitle']));
                $text_subtitle = htmlspecialchars(strip_tags($_POST['text_subtitle']));
                $subtitle_font_size = htmlspecialchars(strip_tags($_POST['subtitle_font_size']));

                // Bind the parameters
                $stmt->bindParam(':title_shape', $title_shape);
                $stmt->bindParam(':image', $image);
                $stmt->bindParam(':shape', $shape);
                $stmt->bindParam(':x', $x);
                $stmt->bindParam(':y', $y);
                $stmt->bindParam(':width', $width);
                $stmt->bindParam(':height', $height);
                $stmt->bindParam(':radius', $radius);
                $stmt->bindParam(':clickable', $clickable);
                $stmt->bindParam(':text_title', $text_title);
                $stmt->bindParam(':font_size', $font_size);
                // $stmt->bindParam(':Subtitle', $Subtitle);
                $stmt->bindParam(':text_subtitle', $text_subtitle);
                $stmt->bindParam(':subtitle_font_size', $subtitle_font_size);
                $stmt->bindParam(':id', $id);

                // Execute the query
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                }
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <!-- HTML form for updating record -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post" enctype="multipart/form-data">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Title</td>
                    <td><input type='text' name='title_shape' value="<?php echo htmlspecialchars($title_shape, ENT_QUOTES); ?>" class='form-control'></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>
                            <img src="uploads/<?php echo htmlspecialchars($image, ENT_QUOTES); ?>" alt="Existing Image" style="max-width: 150px; max-height: 150px;"/><br>
                            <input type="file" name="existing_image" value="<?php echo htmlspecialchars($image); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Shape</td>
                    <td>
                        <select name='shape' class='form-control'>
                            <option value='' disabled selected></option>
                            <option value='rectangle' <?php echo $shape == 'rectangle' ? 'selected' : ''; ?>>Rectangle</option>
                            <option value='circle' <?php echo $shape == 'circle' ? 'selected' : ''; ?>>Circle</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>X</td>
                    <td><input type='number' name='x' class='form-control' value="<?php echo htmlspecialchars($x, ENT_QUOTES); ?>"></td>
                </tr>
                <tr>
                    <td>Y</td>
                    <td><input type='number' name='y' class='form-control' value="<?php echo htmlspecialchars($y, ENT_QUOTES); ?>"></td>
                </tr>
                <tr>
                    <td>Width</td>
                    <td><input type='number' name='width' class='form-control' value="<?php echo htmlspecialchars($width, ENT_QUOTES); ?>"></td>
                </tr>
                <tr>
                    <td>Height</td>
                    <td><input type='number' name='height' class='form-control' value="<?php echo htmlspecialchars($height, ENT_QUOTES); ?>"></td>
                </tr>
                <tr>
                    <td>Radius</td>
                    <td><input type='number' name='radius' class='form-control' value="<?php echo htmlspecialchars($radius, ENT_QUOTES); ?>"></td>
                </tr>
                <tr>
                    <td>Clickable</td>
                    <td>
                        <select name='clickable' class='form-control'>
                            <option value='Yes' <?php echo $clickable == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value='No' <?php echo $clickable == 'No' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Title</td>
                    <td>
                    <label>Text</label></br>
                    <input type='text' name='text_title' class='form-control' value="<?php echo htmlspecialchars($text_title, ENT_QUOTES); ?>">
                    <label>font size</label></br>
                    <input type='number' name='font_size' class='form-control' value="<?php echo htmlspecialchars($font_size, ENT_QUOTES); ?>">
                    </td>
                </tr>
                <tr>
                    <td>Subtitle</td>
                    <td>
                    <label>Text</label></br>
                    <input type='text' name='text_subtitle' class='form-control' value="<?php echo htmlspecialchars($text_subtitle, ENT_QUOTES); ?>">
                    <label>Subtitle Font Size</label></br>
                    <input type='number' name='subtitle_font_size' class='form-control' value="<?php echo htmlspecialchars($subtitle_font_size, ENT_QUOTES); ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Update' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
