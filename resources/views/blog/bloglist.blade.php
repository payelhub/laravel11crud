<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        @if (Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">{{Session::get('success')}}</div>
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Blog List</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($blogs->isNotEmpty())
            
            @foreach ($blogs as $blog)
            <div class="col-md-4 mb-4">
    <div class="card" style="width: 18rem;">
        @if ($blog->image && file_exists(public_path('uploads/blog/' . $blog->image)))
        <img src="{{ asset('uploads/blog/' . $blog->image) }}" width="500" class="card-img-top" alt="...">
    @else
        <p>No image available for this blog post.</p>
    @endif
        <div class="card-body">
            <h5 class="card-title">{{ $blog->title }}</h5>
            <p class="card-text">{{ substr(strip_tags($blog->description), 0, 150) }}
                @if(strlen(strip_tags($blog->description))> 50)
                <span class="read-more">
                    <a href="{{route('blog.show',$blog->id)}}" class="btn btn-primary">Read more...</a>
                </span>
                @endif
                </p>
        </div>
        <div class="card-footer">
            <small class="text-muted">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                {{\carbon\carbon::parse($blog->created_at)->format('d M,Y')}}</small>
        </div>
    </div>
</div>
@endforeach
            
                
            @endif
           
            
        </div>
        
        </div>      
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>