<!DOCTYPE HTML>
<html>
<head>
    <title>Records</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <!-- custom css -->
    <style>
        .m-r-1em { margin-right:1em; }
        .m-b-1em { margin-bottom:1em; }
        .m-l-1em { margin-left:1em; }
        .mt0 { margin-top:0; }
        
        /* Center content in table cells */
        table th, table td{
            text-align: flex;
            vertical-align: middle;
        }

        table th {
            background: #f0f0f0;
            align-content: center; text-align: center; 
            
        }

        table td {
            align-content: center; text-align: center;
        }

        /* Adjust image size in table */
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            object-fit: cover; 
        }
    </style>
</head>
<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>View</h1>
        </div>
        <!-- PHP code to read records will be here -->
        <?php
            // include database connection
            include 'koneksi.php';
            // PAGINATION VARIABLES
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $records_per_page = 5;
            $from_record_num = ($records_per_page * $page) - $records_per_page;
            $action = isset($_GET['action']) ? $_GET['action'] : "";

            if($action=='deleted'){
                echo "<div class='alert alert-success'>Record was deleted.</div>";
            }

            // select data for current page
            $query = "SELECT id, title_shape, image, shape, x, y, width, height, radius, clickable, title, text_title, font_size, subtitle, text_subtitle, subtitle_font_size FROM shapes ORDER BY id DESC
                LIMIT :from_record_num, :records_per_page";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
            $stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
            $stmt->execute();
            $num = $stmt->rowCount();

            // link to create record form
            echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";

            if($num > 0){
                // start table
                echo "<table class='table table-hover table-responsive table-bordered'>";
                // table heading with rowspan and colspan
                echo "<tr>
                    <th rowspan='2'>Title</th>
                    <th rowspan='2'>Image</th>
                    <th rowspan='2'>Shape</th>
                    <th colspan='5'>Coords</th>
                    <th rowspan='2'>Clickable</th>
                    <th rowspan='2'>Title</th>
                    <th rowspan='2'>Subtitle</th>
                    <th rowspan='2'>Action</th>
                </tr>";
                echo "<tr>
                    <th>X</th>
                    <th>Y</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>Radius</th>
                </tr>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    echo "<tr>
                        <td>{$title_shape}</td>
                        <td><img src='uploads/{$image}' style='max-width: 50px; max-height: 50px;'></td>
                        <td>{$shape}</td>
                        <td>{$x}</td>
                        <td>{$y}</td>
                        <td>{$width}</td>
                        <td>{$height}</td>
                        <td>{$radius}</td>
                        <td>{$clickable}</td>
                        <td>
                            <span>Text:</span> {$text_title}<br>
                            <span>Font Size:</span> {$font_size}
                        </td>
                        <td>
                            <span>Text:</span> {$text_subtitle}<br>
                            <span>Font Size:</span> {$subtitle_font_size}
                        </td>
                        <td>
                            <a href='view.php?id={$id}' class='btn btn-info m-r-1em'>View</a>
                            <a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>
                            <a href='#' onclick='delete_user({$id});' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>";
                }
                echo "</table>";
                
                // PAGINATION
                $query = "SELECT COUNT(*) as total_rows FROM shapes";
                $stmt = $con->prepare($query);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_rows = $row['total_rows'];
                $page_url = "index.php?";
                include_once "paging.php";
            } else {
                echo "<div class='alert alert-danger'>No records found.</div>";
            }
        ?>
    </div> <!-- end .container -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- confirm delete record -->
    <script type='text/javascript'>
    function delete_user(id) {
        var answer = confirm('Are you sure?');
        if (answer) {
            window.location = 'delete.php?id=' + id;
        }
    }
    </script>
</body>
</html>
