<?php
//Start Session
session_start();

    if(isset($_POST['name'])){
        //echo 'FORM SUBMITTED';
        if(isset($_SESSION['Bookmarks'])){
            $_SESSION['Bookmarks'][$_POST['name']] = $_POST['url'];
        } else{
            $_SESSION['Bookmarks'] = Array($_POST['name'] => $_POST['url']);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'clear') {
        session_unset();
        session_destroy();
        header('Location: Bookmarker.php');
    }
    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        unset($_SESSION['Bookmarks'][$_GET['name']]);
        header('Location: Bookmarker.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarker</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">
    <style>
        .delete{color:white;}
    
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Bookmarker</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Bookmarker.php">Home <span class="sr-only">(current)</span></a></li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a class="nav-link" href="Bookmarker.php?action=clear">Clear All</a></li>
    </ul>
  
  </div>
</nav>

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label>Website Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    
                    <div class="form-group">
                        <label>Website URL</label>
                        <input type="text" class="form-control" name="url">
                    </div>
                    <input type="submit" value="Submit" class="btn btn-default">
                </form>
            </div>
            <div class="col-md-5"> 
                <?php if(isset($_SESSION['Bookmarks'])) : ?>
                    <ul class='list-group'>
                        <?php foreach($_SESSION['Bookmarks'] as $name => $url) : ?>
                            <li class='list-group-item'><a href="<?php echo $url; ?>"><?php echo $name; ?></a> <a class='delete' href="Bookmarker.php?action=delete&name=<?php echo $name; ?>">[X]</a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>