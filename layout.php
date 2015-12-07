<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
<!--    <link rel="stylesheet" href="wp-menu-pages/assets/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="wp-menu-pages/assets/css/bootstrap-theme.min.css">-->
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha256-gJ9rCvTS5xodBImuaUYf1WfbdDKq54HCPz9wk8spvGs= sha512-weqt+X3kGDDAW9V32W7bWc6aSNCMGNQsdOpfJJz/qD/Yhp+kNeR+YyvvWojJ+afETB31L0C4eO0pcygxfTgjgw==" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container-fluid wp-menu-pages">
    <div class="page-header">
        <h1>
            The Page Title
            <small>Page Subtitle</small>
        </h1>
    </div>
    <div class="row">
        <?php
        /*******************************************************************************
         * Alerts
         ******************************************************************************/
        ?>
        <div class="col-md-12 alerts-wrapper">
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Warning!</strong> This is an alert.
            </div>
        </div>

        <?php
        /*******************************************************************************
         * Main
         ******************************************************************************/
        ?>
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-heading" style="padding-bottom: 0; border-bottom: none;">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a>
                        </li>
                        <li role="presentation">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a>
                        </li>
                        <li role="presentation">
                            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
                        </li>
                        <li role="presentation" class="navbar-right">
                            <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Documentation</a>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active fade in" id="settings">
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">
                                        Email
                                    </label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email"
                                               name="email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">
                                        TexArea
                                    </label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3" name="password"
                                               placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default">Sign in</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="home">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                           placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                           placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <input type="file" id="exampleInputFile">

                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Check me out
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile">

                            <form class="form-inline">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                        <input type="text" class="form-control" id="exampleInputAmount"
                                               placeholder="Amount">

                                        <div class="input-group-addon">.00</div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Transfer cash</button>
                            </form>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="messages">

                            <p>
                                Azureus, magnum vigils unus pugna de flavum, regius fiscina.
                                Meatloaf tastes best with crême fraîche and lots of rum.
                                Refrigerate ground chicken in a soup pot with rum for about an hour to perfect their
                                thickness.
                                Where is the swashbuckling grog?
                            </p>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="pull-right">
                            <button type="reset" class="btn btn-md btn-warning">Reset Tab</button>
                            <button type="submit" class="btn btn-md btn-primary">Save Tab</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <?php
        /*******************************************************************************
         * Sidebar
         ******************************************************************************/
        ?>
        <div class="col-md-3">
            <?php // TODO Here stands the sidebar ?>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="sbHeadingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" href="#sbCollapseOne"
                               aria-expanded="true" aria-controls="sbCollapseOne">
                                Collapsible Group Item #1
                            </a>
                        </h4>
                    </div>
                    <div id="sbCollapseOne" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="sbHeadingOne">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                            nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                            beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                            probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="sbHeadingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse"
                               href="#sbCollapseTwo" aria-expanded="false" aria-controls="sbCollapseTwo">
                                Collapsible Group Item #2
                            </a>
                        </h4>
                    </div>
                    <div id="sbCollapseTwo" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="sbHeadingTwo">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                            nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                            beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                            probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script type="text/javascript">
    (function ($) {
        $("[rel='tooltip']").tooltip();

        $('button[type="submit"]').click(function (e) {
            e.preventDefault();

            var $form = $('.tab-pane.active').find('form');

            $("#results").html('Results: ' + $form.serialize());
        });
    })(jQuery);
</script>
</body>
</html>
