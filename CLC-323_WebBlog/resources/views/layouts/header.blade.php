<div>
	<nav class="navbar navbar-dark navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="Home">WebBlog</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                <!-- add if statement, check session and hide if not logged in -->
                	@if (Session::has('User'))
                    <a class="nav-link" href="Home">Home</a>                    
                 	<a class="nav-link" href="BlogSubmit">Submit Blog</a>                 	
                    <a class="nav-link" href="BlogSearch">Search Blogs</a>
                    <a class="nav-link" href="MyBlogs">My Blogs</a>
                    @endif                                                         
                </ul>
                <span class="navbar-text actions"> 
                @if (Session::has('User')) 
                    <a class="btn btn-dark action-button" role="button" href="Logout">Log Off</a>                                             
                @else               
	            	<a class="login" href="Register">Register</a>
	                <a class="btn btn-dark action-button" role="button" href="Login">Log in</a>
                @endif
                <!-- add if statement, check session and hide if not logged in -->               
                </span>
        	</div>
        </div>
    </nav>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</div>