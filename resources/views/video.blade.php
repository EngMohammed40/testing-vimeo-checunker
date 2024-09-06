<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css' integrity='sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==' crossorigin='anonymous'/>
<script src='https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js' integrity='sha512-UWMGINgjUq/2sNur/d2LbiAX6IHmZkkCivoKSdoX+smfB+wB8f96/6Sp8ediwzXBXMXaAqymp6S55SALBk5tNQ==' crossorigin='anonymous'></script>
</head>
<body>
    {{-- <form action="{{ url('/save-video') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="video" id="">
        <button class="btn btn-success">Submit</button>
    </form> --}}
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h3>Started at: {{ $video->started_at }}</h3>
                <h3>Ended at: {{ $video->finished_at }}</h3>
                @if ($video->isJobCompleted())
                    <div class="alert alert-success">Job Completed</div>
                @else
                    <div class="alert alert-danger">Job In Progress</div>
                @endif
            </div>
        </div>
    </div>



</body>
</html>
