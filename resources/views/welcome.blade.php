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
                <div>
                    <input type="file">
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
                <div class="mt-5 d-none" id="progressable">
                    Uploading....
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: 25%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">25%</div>
                      </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('#submit').addEventListener('click', upload);
        function upload() {
            const file = document.querySelector('input').files[0];
            const resumable = new Resumable({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                target: '{{ url('/save-video') }}',
                chunkSize: 1 * 1024 * 1024,
                testChunks:false
            });
            resumable.addFile(file);

            resumable.on('fileAdded', (file) => {
                document.getElementById('progressable').classList.remove('d-none');
                resumable.upload();
            });

            resumable.on('progress', (file) => {
                let progress = Math.floor(resumable.progress() * 100);
                document.querySelector('.progress-bar').style.width = progress + '%';
                document.querySelector('.progress-bar').ariaValueNow = progress;
                document.querySelector('.progress-bar').textContent = progress + '%';
                if(progress == 100) {
                    document.querySelector('.progress-bar').classList.add('bg-success');
                }
            });
        }
    </script>

</body>
</html>
