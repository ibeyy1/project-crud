<!DOCTYPE HTML>
<html>
<head>
    <title>View</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <style>
        .text-output span {
            display: block; /* Menampilkan setiap span di baris terpisah */
        }
    </style>
</head>
<body>
    <!-- container -->  
    <div class="container">
        <div class="page-header">
            <h1>View</h1>
        </div>
        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
//include database connection
include 'koneksi.php';
// read current record's data
try {
    // prepare select query
    $query = "SELECT id, title_shape, image, shape, x, y, width, height, radius, clickable, title, text_title, font_size, subtitle, text_subtitle, subtitle_font_size FROM shapes WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
    // this is the first question mark
    $stmt->bindParam(1, $id);
    // execute our query
    $stmt->execute();
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // values to fill up our form
    $title_shape = $row['title_shape'];
    $image = htmlspecialchars($row['image'], ENT_QUOTES);
    $shape = $row['shape'];
    $x = $row['x'];
    $y = $row['y'];
    $width = $row['width'];
    $height = $row['height'];
    $radius = $row['radius'];
    $clickable = $row['clickable'];
    $title= $row['title'];
    $text_title = $row['text_title'];
    $font_size = $row['font_size'];
    $subtitle = $row['subtitle'];
    $text_subtitle = $row['text_subtitle'];
    $subtitle_font_size = $row['subtitle_font_size'];   
}
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
       <!--we have our html table here where the record will be displayed-->
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Title</td>
        <td><?php echo htmlspecialchars($title_shape, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
    <td>Image</td>
    <td>
    <?php echo $image ? "<img src='uploads/{$image}' style='width:150px;' />" : "No image found.";  ?>
    </td>
    </tr>
    <tr>
        <td>Shape</td>
        <td><?php echo htmlspecialchars($shape, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>X</td>
        <td><?php echo htmlspecialchars($x, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Y</td>
        <td><?php echo htmlspecialchars($y, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Width</td>
        <td><?php echo htmlspecialchars($width, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Height</td>
        <td><?php echo htmlspecialchars($height, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Radius</td>
        <td><?php echo htmlspecialchars($radius, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Clickable</td>
        <td><?php echo htmlspecialchars($clickable, ENT_QUOTES);  ?></td>
    </tr>
    <td>Title</td>
    <td>
        <div class="text-output">
            <span>Text:<?php echo htmlspecialchars($text_title, ENT_QUOTES); ?></span>
            <span>Font Size: <?php echo htmlspecialchars($font_size, ENT_QUOTES); ?></span>
        </div>
    </td>
    </tr>
    <tr>
    <td>Subtitle</td>
    <td>
        <div class="text-output">
            <span>Text:<?php echo htmlspecialchars($subtitle, ENT_QUOTES); ?></span>
            <span>Font Size: <?php echo htmlspecialchars($subtitle_font_size, ENT_QUOTES); ?></span>
        </div>
    </td>
    </tr>
    <tr>
    <tr>
        <td></td>
        <td>
            <a href='index.php' class='btn btn-danger'>Back</a>
        </td>
    </tr>
</table>
    </div> <!-- end .container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>