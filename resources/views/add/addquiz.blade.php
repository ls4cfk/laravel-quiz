<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Quiz System</title>
</head>
<body>
    
<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>Quiz System</div>
            <div class="list-group list-group-flush my-3">
            <a href="{{url('/admin')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{url('admin/add-quiz')}}" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Add New Quiz</a>
            <a href="{{url('admin/view-quiz')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>View Quiz</a>
                        <a href="{{url('admin/add-question')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold "><i
                        class="fas fa-project-diagram me-2"></i>Add New Question</a>
            <a href="{{url('admin/view-question')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>View Question</a>
                        <a href="{{url('admin/quiz-approval')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Quiz Approval List</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Add Quiz</h2>
                </div>

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

                <form action="{{url('addquiz')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 my-2">


                    <h4>Add New Quiz</h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="" style="font-size:20px;font-weight:bold;">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="label" style="font-size:20px;font-weight:bold;">Picture</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="label" style="font-size:20px;font-weight:bold;">Description</label>
                            <textarea name="description" class="form-control" id="" ></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="label" style="font-size:20px;font-weight:bold;">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>
                    </div>

                    
                    
                    <div class="col-md-4">
                        <div class="form-group">
                        
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    
                </div>
            </form>
            
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