@include("layout.header")

<body>

@include("layout.nav")
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">
       @yield("content")

       @include("layout.sidebar")
    </div>    </div><!-- /.row -->
</div><!-- /.container -->

@include("layout.footer")
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/wangEditor.min.js"></script>
<script src="/js/ylaravel.js"></script>

</body>
</html>
