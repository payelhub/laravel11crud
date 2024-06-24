<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple laravel 11 crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Blogs Table</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{route('blog.create')}}" class="btn btn-dark">Create</a>
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
            <div class="col-md-20">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Blogs</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                            @if ($blogs->isNotEmpty())
                                @foreach ( $blogs as $blog )
                                <tr>
                                    <td>{{$blog->id}}</td>
                                    <td>
                                        @if ($blog->image !="")
                                            <img width="50" src="{{asset('uploads/blog/'.$blog->image)}}" alt="">
                                        @endif
                                    </td>
                                    <td>{{$blog->title}}</td>
                                    <td>{{ substr(strip_tags($blog->description), 0, 50) }}...</td>
                                    <td>{{\carbon\carbon::parse($blog->created_at)->format('d M,Y')}}</td>
                                    <td>
                                        <a href="{{route('blog.edit',$blog->id)}}" class="btn btn-dark">Edit</a>
                                        <a href="#" onclick="deleteBlog({{$blog->id}})" class="btn btn-danger">Delete</a>
                                        <form id="delete-blog-from-{{$blog->id}}" action="{{route('blog.destroy',$blog->id)}}" method="POST">
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
    <script>
        function deleteBlog(id){
            if(confirm("Are you sure you want to delete blog"))
            document.getElementById("delete-blog-from-"+id).submit();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>