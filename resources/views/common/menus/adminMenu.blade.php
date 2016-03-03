<nav class="navbar  navbar-default navbar-fixed-bottom">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <span class="navbar-brand">
                Administration
            </span>
        </div>

        <div class="collapse navbar-collapse" id="spark-navbar-collapse">
            <ul class="nav navbar-nav nav-pills">
                @stack('admin-bar')
            </ul>
        </div>
    </div>
</nav>