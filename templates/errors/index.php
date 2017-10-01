<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="templates/errors/custom.css">
</head>
<body style="background-color:{{background}}">
<div class="container">
    <div class="row">
        <div class="error-template">
            <h1>Oops!</h1>
            <h1><?= $errorCode; ?></h1>
            <div class="error-details">
                <?= $errorMessage; ?><br>
            </div>
            <div class="well-lg">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="search">Search</label>
                        <input type="text" class="form-control" name="user" id="search" placeholder="Search someone else...">
                    </div>
                    <button type="submit" class="btn btn-primary btn-large">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
