   <!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>JS Bin</title>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
a.info{
    position:relative; /*this is the key*/
    color:#000;
    top:100px;
    left:50px;
    text-decoration:none;
    text-align:center;
  }



a.info span{display: none}

a.info:hover span{ /*the span will display just on :hover state*/
    display:block;
    position:absolute;
    top:-60px;
    width:15em;
    border:5px solid #0cf;
    background-color:#cff; color:#000;
    text-align: center;
    padding:10px;
  }

  a.info:hover span:after{ /*the span will display just on :hover state*/
    content:'';
    position:absolute;
    bottom:-11px;
    width:10px;
    height:10px;
    border-bottom:5px solid #0cf;
    border-right:5px solid #0cf;
    background:#cff;
    left:50%;
    margin-left:-5px;
    -moz-transform:rotate(45deg);
    -webkit-transform:rotate(45deg);
    transform:rotate(45deg);
  }


</style>
</head>
<body>
<a href="#" class="info">Shailender Arora <span>TOOLTIP to see how much text can fit into this span element for testing purposes only and potentially for implementation</span></a>
  </div>
</body>
</html>