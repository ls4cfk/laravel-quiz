<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Question System</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>Question System</div>
            <div class="list-group list-group-flush my-3">
            <a href="{{url('/admin')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{url('admin/add-quiz')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Add New Quiz</a>
            <a href="{{url('admin/view-quiz')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>View Quiz</a>
                        <a href="{{url('admin/add-question')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Add New Question</a>
            <a href="{{url('admin/view-question')}}" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>View Question</a>
                        <a href="{{url('admin/quiz-approval')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Quiz Approval List</a>
                        
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </nav>

            <div class="container-fluid px-4">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                </div>
                @endif

                @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
                </div>
                @endif
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Questions</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Question Name</th>
                                    <th scope="col">Question image</th>
                                    <th scope="col">Question In Quiz</th>
                                    <th scope="col">Question Position</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($question as $key=>$question)
                                <tr>
                                <th scope="row">{{++$key}}</th>
                                    <td>{{$question->q_name}}</td>
                                    <td><img src="{{asset('images/'.$question->Question_image)}}" alt="" srcset="" width="100" height="100"></td>
                                    <td>{{$question->quiz_name}}</td>
                                    <td>{{$question->position}}</td>
                                    <td><a href="{{url('/admin/view-question/'.$question->id)}}">EDIT</a> &nbsp;&nbsp; <a href="{{url('/admin/delete-question/'.$question->id)}}">DELETE </a> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>