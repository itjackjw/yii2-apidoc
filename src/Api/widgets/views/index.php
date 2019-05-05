<!DOCTYPE html>
<html lang="<?=$message['config']['language'] ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="<?=$message['config']['author'] ?>">
    <title><?=$message['config']['title'] ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Plugin CSS -->
    <link href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        body {
            padding-top: 70px; margin-bottom: 15px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-family: "Roboto", "SF Pro SC", "SF Pro Display", "SF Pro Icons", "PingFang SC", BlinkMacSystemFont, -apple-system, "Segoe UI", "Microsoft Yahei", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
            font-weight: 400;
        }
        h2        { font-size: 1.6em; }
        hr        { margin-top: 10px; }
        .tab-pane { padding-top: 10px; }
        .mt0      { margin-top: 0px; }
        .footer   { font-size: 12px; color: #666; }
        .label    { display: inline-block; min-width: 65px; padding: 0.3em 0.6em 0.3em; }
        .string   { color: green; }
        .number   { color: darkorange; }
        .boolean  { color: blue; }
        .null     { color: magenta; }
        .key      { color: red; }
        .popover  { max-width: 400px; max-height: 400px; overflow-y: auto;}
        .list-group.panel > .list-group-item {
        }
        .list-group-item:last-child {
            border-radius:0;
        }
        h4.panel-title a {
            font-weight:normal;
            font-size:14px;
        }
        h4.panel-title a .text-muted {
            font-size:12px;
            font-weight:normal;
            font-family: 'Verdana';
        }
        #sidebar {
            width: 220px;
            position: fixed;
            margin-left: -240px;
            /*overflow-y:auto;*/
        }
        #sidebar > .list-group {
            margin-bottom:0;
        }
        #sidebar > .list-group > a{
            text-indent:0;
        }
        #sidebar .child {
            border:1px solid #ddd;
            border-bottom:none;
        }
        #sidebar .child > a {
            border:0;
        }
        #sidebar .list-group a.current {
            background:#f5f5f5;
        }
        @media (max-width: 1620px){
            #sidebar {
                margin:0;
            }
            #accordion {
                padding-left:235px;
            }
        }
        @media (max-width: 768px){
            #sidebar {
                display: none;
            }
            #accordion {
                padding-left:0px;
            }
        }

    </style>
</head>
<body>
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" target="_blank"><?=$message['config']['title'] ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right">
                <div class="form-group">
                    Token:
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-sm" data-toggle="tooltip" title="<?=$message['lang']['Tokentips'] ?>" placeholder="token" id="token" />
                </div>
                <div class="form-group">
                    Apiurl:
                </div>
                <div class="form-group">
                    <input id="apiUrl" type="text" class="form-control input-sm" data-toggle="tooltip" title="<?=$message['lang']['Apiurltips'] ?>" placeholder="https://api.mydomain.com" value="<?=$message['config']['apiurl'] ?>" />
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" title="<?=$message['lang']['Savetips'] ?>" id="save_data">
                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <!-- menu -->
    <div id="sidebar">
        <div class="list-group panel" style="border-bottom: none">
            <?php  foreach ($message['docslist'] as $k=>$docs) { ?>

                <a href="#<?=$k?>" class="list-group-item" data-toggle="collapse" data-parent="#sidebar"><?=$k?>  <i class="fa fa-caret-down"></i></a>
                <div class="child collapse" id="<?=$k?>" style="border-bottom: 1px solid #ddd">
                    <?php  foreach ($docs as $api) { ?>
                        <a href="javascript:;" data-id="<?=$api['id']?>" class="list-group-item"><?=$api['title']?></a>
                    <?php  } ?>
                </div>


            <?php  } ?>
        </div>
    </div>



    <div class="panel-group" id="accordion">
        <?php  foreach ($message['docslist'] as $k=>$docs) { ?>
        <h2><?=$k?></h2>
        <hr>
        <?php  foreach ($docs as $api) { ?>
        <div class="panel panel-default">
            <div class="panel-heading" id="heading-<?=$api['id'] ?>">
                <h4 class="panel-title">
                    <span class="label <?=$api['method_label'] ?>"><?=strtoupper($api['method'])?></span>
                    <a data-toggle="collapse" data-parent="#accordion<?=$api['id'] ?>" href="#collapseOne<?=$api['id'] ?>"> <?=$api['title'] ?> <span class="text-muted"><?=$api['route'] ?></span></a>
                </h4>
            </div>
            <div id="collapseOne<?=$api['id'] ?>" class="panel-collapse collapse">
                <div class="panel-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="doctab<?=$api['id'] ?>">
                        <li class="active"><a href="#info<?=$api['id'] ?>" data-toggle="tab"><?=$message['lang']['Info'] ?></a></li>
                        <li><a href="#sandbox<?=$api['id'] ?>" data-toggle="tab"><?=$message['lang']['Sandbox'] ?></a></li>
                        <li><a href="#sample<?=$api['id'] ?>" data-toggle="tab"><?=$message['lang']['Sampleoutput'] ?></a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div class="tab-pane active" id="info<?=$api['id'] ?>">
                            <div class="well">
                                <?=$api['summary'] ?>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading"><strong><?=$message['lang']['Headers'] ?></strong></div>
                                <div class="panel-body">
                                    <?php  if($api['headerslist']){ ?>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th><?=$message['lang']['Name'] ?></th>
                                            <th><?=$message['lang']['Type'] ?></th>
                                            <th><?=$message['lang']['Required'] ?></th>
                                            <th><?=$message['lang']['Description'] ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($api['headerslist'] as $header){  ?>

                                        <tr>
                                            <td><?=$header['name'] ?></td>
                                            <td><?=$header['type'] ?></td>
                                            <td><?=$header['required']?'是':'否' ?></td>
                                            <td><?=$header['description'] ?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php  }else{ ?>
                                    无
                                    <?php  }?>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading"><strong><?=$message['lang']['Parameters'] ?></strong></div>
                                <div class="panel-body">

                                    <?php  if($api['paramslist']){ ?>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th><?=$message['lang']['Name'] ?></th>
                                            <th><?=$message['lang']['Type'] ?></th>
                                            <th><?=$message['lang']['Required'] ?></th>
                                            <th><?=$message['lang']['Description'] ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($api['paramslist'] as $param){  ?>

                                        <tr>
                                            <td><?=$param['name'] ?></td>
                                            <td><?=$param['type'] ?></td>
                                            <td><?=$param['required']?'是':'否' ?></td>
                                            <td><?=$param['description'] ?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php  }else{ ?>
                                        无
                                    <?php  }?>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading"><strong><?=$message['lang']['Body'] ?></strong></div>
                                <div class="panel-body">
                                    <?=$api['body']?$api['body']:"无" ?>
                                </div>
                            </div>
                        </div><!-- #info -->

                        <div class="tab-pane" id="sandbox<?=$api['id']?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php  if($api['headerslist']){ ?>

                                    <div class="panel panel-default">
                                        <div class="panel-heading"><strong><?=$message['lang']['Headers'] ?></strong></div>
                                        <div class="panel-body">
                                            <div class="headers">
                                                <?php foreach ($api['headerslist'] as $param){  ?>
                                                <div class="form-group">
                                                    <label class="control-label" for="<?=$param['name'] ?>"><?=$param['name'] ?></label>
                                                    <input type="<?=$param['type'] ?>" class="form-control input-sm" id="<?=$param['name'] ?>"  <?php  if($param['required']) { ?>required <?php } ?>       placeholder="<?=$param['description'];  ?> - Ex: <?=$param['sample'];  ?>" name="<?=$param['name'];  ?>">
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><strong><?=$message['lang']['Parameters'] ?></strong></div>
                                        <div class="panel-body">
                                            <form enctype="application/x-www-form-urlencoded" role="form" action="<?=$api['route'] ?>" method="<?=$api['method'] ?>" name="form<?=$api['id'] ?>" id="form<?=$api['id'] ?>">

                                                <?php if($api['paramslist']) {?>
                                                <?php foreach ($api['paramslist'] as $param){  ?>

                                                <div class="form-group">
                                                    <label class="control-label" for="<?=$param['name'] ?>"><?=$param['name'] ?></label>
                                                    <input type="<?=$param['type'] ?>" class="form-control input-sm" id="<?=$param['name'] ?>" <?php  if($param['required']) { ?>required <?php } ?> placeholder="<?=$param['description'];?><?php if($param['sample']){ ?> - 例:<?=$param['sample']  ?>  <?php } ?>" name="<?=$param['name']  ?>">
                                                </div>
                                                <?php } ?>
                                                <?php }else{ ?>
                                                <div class="form-group">
                                                    无
                                                </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success send" rel="<?=$api['id'] ?>"><?=$message['lang']['Send'] ?></button>
                                                    <button type="reset" class="btn btn-info" rel="<?=$api['id'] ?>"><?=$message['lang']['Reset'] ?></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><strong><?=$message['lang']['Response'] ?></strong></div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12" style="overflow-x:auto">
                                                    <pre id="response_headers<?=$api['id'] ?>"></pre>
                                                    <pre id="response<?=$api['id'] ?>"></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><strong><?=$message['lang']['ReturnParameters'] ?></strong></div>
                                        <div class="panel-body">

                                            <?php  if($api['returnparamslist']){ ?>
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>

                                                    <th><?=$message['lang']['Name'] ?></th>
                                                    <th><?=$message['lang']['Type'] ?></th>
                                                    <th><?=$message['lang']['Description'] ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($api['returnparamslist'] as $param){  ?>

                                                <tr>
                                                    <td><?=$param['name'] ?></td>
                                                    <td><?=$param['type'] ?></td>
                                                    <td><?=$param['description'] ?></td>
                                                </tr>
                                                <?php  }?>
                                                </tbody>
                                            </table>
                                            <?php  }else{ ?>
                                                无
                                            <?php  }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- #sandbox -->

                        <div class="tab-pane" id="sample<?=$api['id'] ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <pre id="sample_response<?=$api['id'] ?>"><?=$api['id']?$api['id']:"无" ?></pre>
                                </div>
                            </div>
                        </div><!-- #sample -->

                    </div><!-- .tab-content -->
                </div>
            </div>
        </div>
        <?php  } ?>
        <?php  } ?>
    </div>

    <hr>

    <div class="row mt0 footer">
        <div class="col-md-6" align="left">
            Generated on<?=date('Y-m-d G:i:s') ?>

        </div>
        <div class="col-md-6" align="right">
            <a href="javascript:;" target="_blank">YII-APIDOC</a>
        </div>
    </div>

</div> <!-- /container -->

<!-- jQuery -->
<script src="https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    function syntaxHighlight(json) {
        if (typeof json != 'string') {
            json = JSON.stringify(json, undefined, 2);
        }
        json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
            var cls = 'number';
            if (/^"/.test(match)) {
                if (/:$/.test(match)) {
                    cls = 'key';
                } else {
                    cls = 'string';
                }
            } else if (/true|false/.test(match)) {
                cls = 'boolean';
            } else if (/null/.test(match)) {
                cls = 'null';
            }
            return '<span class="' + cls + '">' + match + '</span>';
        });
    }

    function prepareStr(str) {
        try {
            return syntaxHighlight(JSON.stringify(JSON.parse(str.replace(/'/g, '"')), null, 2));
        } catch (e) {
            return str;
        }
    }
    var storage = (function () {
        var uid = new Date;
        var storage;
        var result;
        try {
            (storage = window.localStorage).setItem(uid, uid);
            result = storage.getItem(uid) == uid;
            storage.removeItem(uid);
            return result && storage;
        } catch (exception) {
        }
    }());

    $.fn.serializeObject = function ()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (!this.value) {
                return;
            }
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    $(document).ready(function () {

        if (storage) {
            $('#token').val(storage.getItem('token'));
            $('#apiUrl').val(storage.getItem('apiUrl'));
        }

        $('[data-toggle="tooltip"]').tooltip({
            placement: 'bottom'
        });

        $(window).on("resize", function(){
            $("#sidebar").css("max-height", $(window).height()-80);
        });

        $(window).trigger("resize");

        $(document).on("click", "#sidebar .list-group > .list-group-item", function(){
            $("#sidebar .list-group > .list-group-item").removeClass("current");
            $(this).addClass("current");
        });
        $(document).on("click", "#sidebar .child a", function(){
            var heading = $("#heading-"+$(this).data("id"));
            if(!heading.next().hasClass("in")){
                $("a", heading).trigger("click");
            }
            $("html,body").animate({scrollTop:heading.offset().top-70});
        });

        $('code[id^=response]').hide();

        $.each($('pre[id^=sample_response],pre[id^=sample_post_body]'), function () {
            if ($(this).html() == 'NA') {
                return;
            }
            var str = prepareStr($(this).html());
            $(this).html(str);
        });

        $("[data-toggle=popover]").popover({placement: 'right'});

        $('[data-toggle=popover]').on('shown.bs.popover', function () {
            var $sample = $(this).parent().find(".popover-content"),
                str = $(this).data('content');
            if (typeof str == "undefined" || str === "") {
                return;
            }
            var str = prepareStr(str);
            $sample.html('<pre>' + str + '</pre>');
        });

        $('body').on('click', '#save_data', function (e) {
            if (storage) {
                storage.setItem('token', $('#token').val());
                storage.setItem('apiUrl', $('#apiUrl').val());
            } else {
                alert('Your browser does not support local storage');
            }
        });

        $('body').on('click', '.send', function (e) {
            e.preventDefault();
            var form = $(this).closest('form');
            //added /g to get all the matched params instead of only first
            var matchedParamsInRoute = $(form).attr('action').match(/[^{]+(?=\})/g);
            var theId = $(this).attr('rel');
            //keep a copy of action attribute in order to modify the copy
            //instead of the initial attribute
            var url = $(form).attr('action');
            var method = $(form).prop('method').toLowerCase() || 'get';

            var formData = new FormData();

            $(form).find('input').each(function (i, input) {
                if ($(input).attr('type').toLowerCase() == 'file') {
                    formData.append($(input).attr('name'), $(input)[0].files[0]);
                    method = 'post';
                } else {
                    formData.append($(input).attr('name'), $(input).val())
                }
            });

            var index, key, value;

            if (matchedParamsInRoute) {
                var params = {};
                formData.forEach(function(value, key){
                    params[key] = value;
                });
                for (index = 0; index < matchedParamsInRoute.length; ++index) {
                    try {
                        key = matchedParamsInRoute[index];
                        value = params[key];
                        if (typeof value == "undefined")
                            value = "";
                        url = url.replace("\{" + key + "\}", value);
                        formData.delete(key);
                    } catch (err) {
                        console.log(err);
                    }
                }
            }

            var headers = {};

            var token = $('#token').val();
            if (token.length > 0) {
                headers['token'] = token;
            }

            $("#sandbox" + theId + " .headers input[type=text]").each(function () {
                val = $(this).val();
                if (val.length > 0) {
                    headers[$(this).prop('name')] = val;
                }
            });

            $.ajax({
                url: $('#apiUrl').val() + url,
                data: method == 'get' ? $(form).serialize() : formData,
                type: method,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: headers,
                success: function (data, textStatus, xhr) {
                    if (typeof data === 'object') {
                        var str = JSON.stringify(data, null, 2);
                        $('#response' + theId).html(syntaxHighlight(str));
                    } else {
                        $('#response' + theId).html(data || '');
                    }
                    $('#response_headers' + theId).html('HTTP ' + xhr.status + ' ' + xhr.statusText + '<br/><br/>' + xhr.getAllResponseHeaders());
                    $('#response' + theId).show();
                },
                error: function (xhr, textStatus, error) {
                    try {
                        var str = JSON.stringify($.parseJSON(xhr.responseText), null, 2);
                    } catch (e) {
                        var str = xhr.responseText;
                    }
                    $('#response_headers' + theId).html('HTTP ' + xhr.status + ' ' + xhr.statusText + '<br/><br/>' + xhr.getAllResponseHeaders());
                    $('#response' + theId).html(syntaxHighlight(str));
                    $('#response' + theId).show();
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
