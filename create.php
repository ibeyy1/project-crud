<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrapValidator.min.css"> -->
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
        <?php
            include 'koneksi.php';

            if ($_POST) {
                try {
                    $query = "INSERT INTO shapes
                    SET title_shape=:title_shape, shape=:shape, image=:image, x=:x, y=:y, width=:width, height=:height, radius=:radius, clickable=:clickable, text_title=:text_title, font_size=:font_size, text_subtitle=:text_subtitle, subtitle_font_size=:subtitle_font_size, created_at=:created_at";

                    $stmt = $con->prepare($query);

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
                    $text_subtitle = htmlspecialchars(strip_tags($_POST['text_subtitle']));
                    $subtitle_font_size = htmlspecialchars(strip_tags($_POST['subtitle_font_size']));
                    $created_at = date('Y-m-d H:i:s');

                    $image = !empty($_FILES["image"]["name"])
                        ? time() . "_" . $_FILES["image"]["name"]
                        : "";

                    $stmt->bindParam(':title_shape', $title_shape);
                    $stmt->bindParam(':shape', $shape);
                    $stmt->bindParam(':image', $image);
                    $stmt->bindParam(':x', $x);
                    $stmt->bindParam(':y', $y);
                    $stmt->bindParam(':width', $width);
                    $stmt->bindParam(':height', $height);
                    $stmt->bindParam(':radius', $radius);
                    $stmt->bindParam(':clickable', $clickable);
                    $stmt->bindParam(':text_title', $text_title);        
                    $stmt->bindParam(':font_size', $font_size);
                    $stmt->bindParam(':text_subtitle', $text_subtitle);
                    $stmt->bindParam(':subtitle_font_size', $subtitle_font_size);
                    $stmt->bindParam(':created_at', $created_at);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record was saved.</div>";
                        if ($image) {
                            $check = getimagesize($_FILES["image"]["tmp_name"]);
                            $allowed_file_types = array("jpg", "jpeg", "png", "gif");
                            $file_type = pathinfo($image, PATHINFO_EXTENSION);

                            if ($check === false || !in_array($file_type, $allowed_file_types) || $_FILES['image']['size'] > (1024000)) {
                                echo "<div class='alert alert-danger'>Image must be a valid JPG, JPEG, PNG, or GIF file under 1 MB.</div>";
                            } elseif (!move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/' . $image)) {
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
        
        <form id="contact_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <!-- Form elements here --> 
            <table class="table">
  <td>title</td>
  <td>
  <div class="form-group">
        <input name="title_shape" placeholder="Title" class="form-control" type="text" required>
        <div class="help-block"></div>
    </div>
  </td>
    </div>
        <tr>
            <td>Shape</td>
            <td><div class="form-group">
                <select name='shape' class='form-control'>
                        <option value='' disabled selected>Select a shape</option>
                        <option value='circle'>Circle</option>
                        <option value='rectangle'>Rectangle</option>
                </select>
                <div class="help-block"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>Image</td>
            <td>
            <div class="form-group">
                <input type="file" name="image" class="form-control" required />
                <div class="help-block"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>X</td>
            <td><div class="form-group">
                    <input type='text' name='x' class='form-control' placeholder='X' required />
                    <div class="help-block"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Y</td>
            <td><div class="form-group">
                    <input type='text' name='y' class='form-control' placeholder='Y' required />
                    <div class="help-block"></div>
               </div>
            </td>
        </tr>
        <tr>
            <td>Width</td>
            <td><div class="form-group">
                    <input type='text' name='width' class='form-control' placeholder='Width' required />
                    <div class="help-block"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Height</td>
            <td> <div class="form-group">
                    <input type='text' name='height' class='form-control' placeholder='Height' required />
                    <div class="help-block"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Radius</td>
            <td><div class="form-group">
                     <input type='text' name='radius' class='form-control' placeholder='Radius' required />
                     <div class="help-block"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Clickable</td>
            <td>
            <div class="form-group">
                <select name='clickable' class='form-control' required>
                <option value='' disabled selected>Select an option</option>
                <option value='Yes'>Yes</option>
                <option value='No'>No</option>
                </select>
            <div class="help-block"></div>
            </td>
        </tr>
        <tr>
            <td>Title</td>
            <td>
                <div class="form-group">
                    <fieldset>
                    <label>text</label></br>
                    <input type='text' name='text_title' class='form-control' placeholder='Title Text'/>
                    <div class="help-block"></div>
                    </div>
                    <div class="form-group">
                    <label>font size</label></br>
                    <input type='text' name='font_size' class='form-control' placeholder='Font Size' />
                    </fieldset>
                    <div class="help-block"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Subtitle</td>            
            <td>
                <div class="form-group">
                    <fieldset>
                    <label>text</label></br>
                    <input type='text' name='text_subtitle' class='form-control' placeholder='Subtitle Text' />
                    <div class="help-block"></div>
                    </div>
                    <div class="form-group">
                    <label>font size</label></br>
                    <input type='text' name='subtitle_font_size' class='form-control' placeholder='Subtitle Font Size'/>
                    <div class="help-block"></div>
                </fieldset>
                
                </div>
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

            <!-- ... Your Form HTML ... -->
             
        </form>

        <div id="success_message" style="display: none;">The form was submitted successfully!</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contact_form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    title_shape: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the title shape'
                            }
                        }
                    },
                    shape: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a shape'
                            }
                        }
                    },
                    x: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the x-coordinate'
                            }
                        }
                    },
                    y: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the y-coordinate'
                            }
                        }
                    },
                    width: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the width'
                            }
                        }
                    },
                    height: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the height'
                            }
                        }
                    },
                    radius: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the radius'
                            }
                        }
                    },
                    clickable: {
                        validators: {
                            notEmpty: {
                                message: 'Please select if it is clickable'
                            }
                        }
                    },
                    text_title: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the title text'
                            }
                        }
                    },
                    font_size: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the font size'
                            }
                        }
                    },
                    text_subtitle: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the subtitle text'
                            }
                        }
                    },
                    subtitle_font_size: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply the subtitle font size'
                            }
                        }
                    }
                }
            })
                    // Other field validations ...
            .on('success.form.bv', function(e) {
                e.preventDefault();
                $('#success_message').slideDown({ opacity: "show" }, "slow");
                $('#contact_form').data('bootstrapValidator').resetForm();

                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');

                $.post($form.attr('action'), $form.serialize(), function(result) {
                    console.log(result);
                }, 'json');
            });
        });
    </script>
</body>
</html>
