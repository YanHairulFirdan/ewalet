<html>

<head>
    <title>Timedoor Challenge - Level 8</title>
    @include('template.style')
    @include('template.script')
</head>

<body class="bg-lgray">
    <header>
        @include('template.header')
    </header>
    <main>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 bg-white p-30 box">
                        <div class="text-center">
                            <h1 class="text-green mb-30"><b>Level 8 Challenge</b></h1>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        @include('template.footer')
    </footer>
</body>

</html>
