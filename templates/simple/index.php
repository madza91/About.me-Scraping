<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="templates/<?= $template; ?>/custom.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#<?= $user['layout']['color']; ?>">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <h4 >About.me profile</h4>
                        </div>
                        <div class="col-sm-6">
                            <?php if($user['contact_me']): ?>
                            <span class="glyphicon glyphicon-envelope pull-right" aria-hidden="true"></span>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>
                <div class="panel-body">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="col-sm-6">
                                <div align="center"> <img alt="User Pic" src="<?= $profile_picture; ?>" id="profile-image1" class="img-circle img-responsive"></div>
                                <br>
                            </div>
                            <div class="col-sm-6">
                                <h4 style="color:#00b1b1;"><?= $user['first_name']; ?> <?= $user['last_name']; ?></h4>
                                <?php if($roles): ?>
                                <span><p><?= $roles['string']; ?></p></span>
                                <?php endif; ?>
                            </div>
                            <div class="clearfix"></div>
                            <hr style="margin:5px 0 5px 0;">

                            <div class="col-sm-5 col-xs-6 tital" >First Name:</div><div class="col-sm-7 col-xs-6 "><?= $user['first_name']; ?></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                            <div class="col-sm-5 col-xs-6 tital" >Last Name:</div><div class="col-sm-7"><?= $user['last_name']; ?></div>

                            <?php if($bio): ?>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                            <div class="col-sm-5 col-xs-6 tital" >Bio:</div><div class="col-sm-7"><?= $bio; ?></div>
                            <?php endif; ?>

                            <?php if($website): ?>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                            <div class="col-sm-5 col-xs-6 tital" >Website:</div><div class="col-sm-7"><a href="<?= $website['url']; ?>" target="_blank"><?= $website['text']; ?></a></div>
                            <?php endif; ?>

                            <?php if($interests): ?>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                            <div class="col-sm-12 col-xs-12 text-center interests" ><?= $interests['string']; ?></div>
                            <?php endif; ?>

                            <?php if($location['source'] == 'google'): ?>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                            <div class="col-sm-12 col-xs-12 tital" >
                                <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/view?zoom=11&center=<?= $location['geometry']['lat']; ?>%2C<?= $location['geometry']['lng']; ?>&key=<?= GOOGLE_MAPS_API_KEY; ?>" allowfullscreen></iframe>
                            </div>
                            <?php endif; ?>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
