<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>{{ __('messages.adminAddPost') }}</title>
  <script src={{ asset($path_to_ui . "summernote/jquery-3.5.1.min.js") }}></script>
  <script src={{ asset($path_to_ui . "summernote/popper.min.js") }}></script>

  <link rel="stylesheet" href={{ asset($path_to_ui . "summernote/bootstrap.min.css" ) }}>
  <script src={{ asset($path_to_ui . "summernote/bootstrap.min.js" ) }}></script>

  <link href={{ asset($path_to_ui . "summernote/summernote-bs4.min.css") }}  rel="stylesheet">
  <script src={{ asset($path_to_ui . "summernote/summernote-bs4.min.js") }}></script>
</head>
<body>
  <div class="container">
      <div class="row">
              <div class="card-body">

                  <form method="POST" action="">
                      @csrf
                      <div class="form-group">
                          <textarea class="form-control" name="summernote" id="summernote"></textarea>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-lg-6">
                            <a href={{ route('admin.search_post') }} class="btn btn-secondary btn-user btn-block">
                              {{ __('messages.CANCEL') }} 
                            </a>
                          </div>
                          <div class="col-lg-6">
                            <a href={{ route('admin.search_post') }} class="btn btn-success btn-user btn-block">
                              {{ __('messages.SAVE') }}
                            </a>
                          </div>
                          
                        </div>
                  </form>
                  
              </div>
      </div>
  </div>
  <!-- partial:index.partial.html -->
  <!-- partial -->
  <script type="text/javascript" src={{ asset($path_to_ui . "summernote/script.js") }}></script>
</body>
</html>
