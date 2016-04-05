<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check Your Site Rank</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.2.1/css/material.min.css" />-->
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.2.1/js/material.min.js"></script>-->
    <style type="text/css">
        .box {
            padding:5,5,5,5;
            text-align: center;
        }

        .box_body{
            height:100px;
            color:white;
            font-size: 90px;
            line-height: normal;
            
        }
        #google_rank{
            background:#D9534F;
        }
        #yahoo_rank{
            background:#337AB7;
        }
        #bing_rank{
            background:#D5D5D5;
        }
        #naver_rank{
            background:#5CB85C;
        }
        #daum_rank{
            background:#F0AD4E;
        }
    </style>
</head>
<body>
<div class="container">
<!--
<div class="row">
    <div class="col-md-12">
    header
    </div>
</div>
-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <i class="icon-calendar"></i>
          <h3 class="panel-title">Search</h3>
        </div>
        
        <div class="panel-body">
          <form class="form-inline" method ="POST" id="myForm">
            <div class="form-group">
              <label class="sr-only" for="myurl">MyUrl</label>
              <input type="text" class="form-control" name="url" id="myurl" placeholder="Enter MyUrl" required>
            </div>
            <div class="form-group">
              <label class="sr-only" for="mykeyword">Keyword</label>
              <input type="text" class="form-control" name="keyword" id="mykeyword" placeholder="Keyword" required>
            </div>
            <button type="button" class="btn btn-info" onclick="CheckValidation()">Search</button>
            <span id='time'></span>
          </form>
        </div>
      </div>
    </div>
  </div>
<div class="row" >
    
    <div class="col-sm-3 col-xs-6">
        <div class="box">
        <img src="assets/img/logo/google.png" class="box_head">
        <p id="google_rank" class="box_body"> </p>
        </div>
    </div>
    
    <div class="col-sm-3 col-xs-6">
        <div class="box">
        <img src="assets/img/logo/naver.png" class="box_head">
        <p id="naver_rank" class="box_body"> </p>
        </div>
    </div>
    
    <div class="col-sm-3 col-xs-6 box">
        <div class="box">
        <img src="assets/img/logo/yahoo.png" class="box_head">
        <p id="yahoo_rank" class="box_body"> </p>
        </div>
    </div>
    
    <div class="col-sm-3 col-xs-6 box">
        <div class="box">
        <img src="assets/img/logo/bing.png" class="box_head">
        <p id="bing_rank" class="box_body"> </p>
        </div>
    </div>
    
</div>
<div class="row" >
    <div class="col-sm-3 col-xs-6">
        <div class="box">
        <img src="assets/img/logo/daum.png" class="box_head">
        <p id="daum_rank" class="box_body"> </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">Copyright &copy; PURPPO 2015</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script >
function CheckValidation()
{
    var isValidForm = $(myForm)[0].checkValidity();
    if (isValidForm)
    {
        GetRank();
    }
    else
    {
        alert("please check input text");
        return false;
    }
}

function WaitRank()
{
    $(google_rank).html("<img src='assets/img/loading.gif'>");
    $(naver_rank).html("<img src='assets/img/loading.gif'>");
    $(yahoo_rank).html("<img src='assets/img/loading.gif'>");
    $(bing_rank).html("<img src='assets/img/loading.gif'>");
    $(daum_rank).html("<img src='assets/img/loading.gif'>");
}

function GetRank()
{
    var search_url = $(myurl).val();
    var search_keyword = $(mykeyword).val();
    
    WaitRank();
    
    $.ajax({
        method: "POST",
        url: 'getRank.php',
        //url: 'testAjax.php',
        data: { url: search_url, keyword: search_keyword },
        //timeout:100000,
        success: function(json)
        {
            var post = $.parseJSON(json);
            $(time).html(post.time);
            var sites = ["google","naver","yahoo","bing","daum"]
            $.each(sites, function(i, site) {
                site_rank = '#'+site+'_rank';
                if(post['rank'][site] == -1){
                    post['rank'][site] = 'No';
                }
                $(site_rank).html("<p>"+post['rank'][site]+"</p>");
            });
        },
        error: function(xhr, type, exception) 
        { 
            alert("ajax error response type "+type);
        }
    });
}
</script>
</body>
</html>
