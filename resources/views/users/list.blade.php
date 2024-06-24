<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="bg-dark py-3">
    <h3 class="text-white text-center">User Details</h3>
</div>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{route('users.create')}}" class="btn btn-dark">Create</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        @if (Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            </div>
        @endif
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">User Details</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created_At</th>
                            <th>Action</th>
                        </tr>
                    @if ($users->isNotEmpty())
                    @foreach ($users as $user )
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{\carbon\carbon::parse($user->created_at)->format('d M,Y')}}</td>
                            <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-dark">Edit</a>
                                <a href="#" onclick="deleteUser({{$user->id}})" class="btn btn-danger">Delete</a>
                                        <form id="delete-user-from-{{$user->id}}" action="{{route('users.destroy',$user->id)}}" method="POST">
                                            @method('delete')
                                            @csrf
                                        </form>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteUser(id){
        if(confirm("Are you sure you want to delete user"))
        document.getElementById("delete-user-from-"+id).submit();
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
