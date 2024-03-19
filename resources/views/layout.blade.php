<!DOCTYPE html>
<html>

<head>

    <title>
        Employee
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">



    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .display-4 {
            font: italic bold 44px/30px Georgia, serif;
        }

        .display-5 {
            font: italic bold 44px/30px Georgia, serif;
        }

        body {
            /*min-height: 80vh;*/
            /*background-image: url("images/000.jpg");*/
            /*min-height: 100%;*/
            /*min-width: 100%;*/
            /*  background-size: cover;*/
            /*  opacity: 0.5;*/
            /*  background-image: url("images/000.jpg");*/
            /*  background-color: c27c00;*/
            background-color: rgba(194, 124, 0, 0.1);

        }

        footer {
            background-color: #222;
            color: #fff;
            font-size: 14px;
            bottom: 0;
            /* position: fixed; */
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
        }

        footer p {
            margin: 0 0;
        }

        footer i {
            color: red;
        }

        footer a {
            color: #3c97bf;
            text-decoration: none;
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Raleway", sans-serif
        }

        body,
        html {
            height: 100%;
            line-height: 1.8;
        }

        /* Full height image header */
        .bgimg-1 {
            background-position: center;
            background-size: cover;
            background-image: url("../images/iii.jpg");
            min-height: 100%;
        }

        .w3-bar .w3-button {
            padding: 16px;
        }
        .hidden {
            display: none;
        }

        .show {
            display: block;
        }
    </style>

</head>

<body>
    <div class="w3-top">
        <div class="w3-bar w3-white w3-card" id="myNavbar">
            <div style="padding-top: 15px" class="w3-bar-item w3-wide"><b>Organizing students files (O S F)</b></div>

            <div class="w3-right w3-hide-small">
                <a href="{{ route('getHOME') }}" class="w3-bar-item w3-button w3-wide"><b style="color: #3c97bf">HOME</b></a>
                @if (Auth::user()->role == 4 )
                <a href="{{ route('getAllMyMarks') }}" class="w3-bar-item w3-button w3-wide">Marks</a>
                @endif
                @if (Auth::user()->role == 1)
                <a href="{{ route('getAllMarks') }}" class="w3-bar-item w3-button w3-wide">Marks</a>
                @endif
                {{-- @if (Auth::user()->role == 1) --}}
                <a href="{{ route('getAllEmployee') }}" class="w3-bar-item w3-button w3-wide">Employees</a>
                {{-- @endif --}}
                @if (Auth::user()->role == 2)
                <a href="{{ route('getAllStudents') }}" class="w3-bar-item w3-button w3-wide">Students</a>
                <a href="{{ route('getAllTeachers') }}" class="w3-bar-item w3-button w3-wide">Teachers</a>
                @endif
                @if (Auth::user()->role == 4 || Auth::user()->role == 1)
                <a href="{{ route('getAllSubjects') }}" class="w3-bar-item w3-button w3-wide">Subjects</a>
                <a href="{{ route('getAllProjects') }}" class="w3-bar-item w3-button w3-wide">Projects</a>
                @endif
                @if ( Auth::user()->role == 3 )
                <a href="{{ route('getAllMySubjects') }}" class="w3-bar-item w3-button w3-wide">Subjects</a>
                <a href="{{ route('getAllMyProjects') }}" class="w3-bar-item w3-button w3-wide">Projects</a>
                @endif
                <!-- <a class="w3-bar-item w3-button">Address</a>
                <a class="w3-bar-item w3-button"><i class="fa fa-user"></i> Detiles Employees</a> -->

                <ul class="navbar-nav ml-auto" class="w3-bar-item w3-button">


                     <a class="dropdown-item" href="{{ route('logout') }}" style="margin-top: 13px" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                        <i class="fa fa-envelope"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </ul>
            </div>
            <!-- Hide right-floated links on small screens and replace them with a menu icon -->



    </div>

    {{-- <div class="w3-container" style="padding:128px 16px" id="about">
        <h2 class="w3-center" style="font-family:Copperplate,Papyrus,fantasy; color:#b99900 ">ABOUT THE APPLICATION</h2>
        <p class="w3-center w3-large">Key features of our Application</p>
        <div class="w3-row-padding w3-center" style="margin-top:64px">
            <div class="w3-quarter">
                <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"  style="color:rgba(185, 153, 0, 0.82) "></i>
                <p class="w3-large" >Administration</p>
                <p>A human resource management system or human resource information system is a form of human resource software that combines a number of systems and processes to ensure the ease of managing human resources, business processes, and data.</p>
            </div>
            <div class="w3-quarter">
                <i class="fa fa-heart w3-margin-bottom w3-jumbo"  style="color:rgba(185, 153, 0, 0.82) "></i>
                <p class="w3-large">learning</p>
                <p>Companies use HR software to bring together several functions that human resource management performs, such as storing employee data, preparing payroll and hiring processes, managing benefits, and keeping track of attendance records.</p>
            </div>
            <div class="w3-quarter">

                <i class="fa fa-home w3-margin-bottom w3-jumbo"  style="color:rgba(185, 153, 0, 0.82) "></i>
                <p class="w3-large">Absence Management</p>
                <p>Follow up on attendance records.</p>
            </div>
            <div class="w3-quarter">
                <i class="fa fa-cog w3-margin-bottom w3-jumbo"  style="color:rgba(185, 153, 0, 0.82) "></i>
                <p class="w3-large">Payroll management</p>
                <p>HRIS provides the means to acquire, store, analyze and distribute information to various stakeholders.</p>
            </div>
        </div>
    </div> --}}


    <!-- Footer -->
    {{-- <div class="foot">
    <footer class="w3-center  w3-padding-64">

        <a href="#home"  class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
        <span style="float: left" class="w3-xlarge w3-section">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-snapchat w3-hover-opacity"></i>
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
        </span>
        <span style="float: right">Powered by <a  href="/" title="IMDAL" target="_blank" class="w3-hover-text-green">IMDAL</a></span>

    </footer>
    </div> --}}


    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
        onclick="w3_open()">
        <i class="fa fa-bars"></i>
    </a>
</div>


    <!-- Sidebar on small screens when clicking the menu icon -->
    <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large"
        style="display:none" id="mySidebar">


    </nav>



    <br>
    <br>
    @yield('content')










    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


    <script src="../../ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
<!-- </head> -->

</html>
