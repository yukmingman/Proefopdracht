<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proefopdracht</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body class="antialiased">
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">GradeManager</a>
    </nav>

    <table class="table">
        <tr>
            <th>Student</th>
            <th>Subject</th>
            <th>Grade</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($students as $student)
            @foreach ($student->subjects as $subject)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->pivot->grade }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#modifyModal-{{ $subject->pivot->id }}">
                            Modify Grade
                        </button>
                    </td>
                    <td>
                        <form method="post" action="{{ route('deleteGrade', $subject->pivot->id) }}"
                            accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <button type="deleteGrade" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                <!--Modify grade modal -->
                <div class="modal fade" id="modifyModal-{{ $subject->pivot->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modifyModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modifyModallLongTitle">Modify Grade</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('modifyGrade', $subject->pivot->id) }}"
                                    accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <label for="SubjectItem">New Grade</label>
                                    <input type="number" name="newgrade" max="10" min="1" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button addGrade" class="btn btn-primary">modify grade</button>
                            </div>
                            </form>
                        </div>
                    </div>
            @endforeach
        @endforeach
    </table>


    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addmodal">
        Add New Grade
    </button>

    <!--Add grade modal -->
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLongTitle">Add new grade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action=addGrade accept-charset="UTF-8">
                        {{ csrf_field() }}
                        Student
                        <select class="form-control" id="student" name="student">
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                        Subject
                        <select class="form-control" id="subject" name="subject">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                </div>
                </select>
                <label for="SubjectItem">New Grade</label>
                <input type="number" name="newgrade" max="10" min="1" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button addGrade" class="btn btn-primary">Add grade</button>
            </div>
            </form>
        </div>
    </div>
    </div>


</body>

</html>
