@extends('layouts.app')
@section('page_css')
    <link href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" rel="stylesheet">
    <style>
        #info-box {
            margin-top: -21px;
            margin-bottom: 20px;
        }

        #info-box .is-static {
            background: #7a7a7a;
            color: #fff;
        }

        #user-photo .dropzone {
            height: 200px;
        }

        #user-photo .dz-preview {
            display: none;
        }

        #user-photo .dz-message {
            padding: 0;
            text-align: center;
        }

        #user-photo .dz-default.dz-message {
            margin: -30px 0;
        }

        #user-photo-img {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            margin: 2em auto;
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="box">
            <div id="info-box" class="level-left">
                <span class="button is-static">{{$user->name}}</span>
            </div>

            @if($isAllowEdit)
                <div class="level-right">
                    <a id="showEditForm" class="button is-primary">Edit Profile</a>
                </div>
            @endif

            <article class="media">
                <div class="media-left">
                    <figure class="image is-128x128">
                        <img src="{{$user->photo ? route('image.view', ['type' => \App\Http\Controllers\ImageController::USER_TYPE, 'image' => $user->photo]): 'https://cdn1.iconfinder.com/data/icons/business-charts/512/customer-512.png'}}">
                    </figure>
                </div>

                <div class="media-content">
                    <div class="content">
                        <p><strong>{{$user->full_name}}</strong></p>
                        <p>{{$user->status}}</p>
                        <br>
                    </div>
                    <nav class="level is-mobile">
                        <div class="level-left">
                            @if(isset($socialMedia->linkedin))
                                <a class="level-item button is-small is-primary" href="{{$socialMedia->linkedin}}">
                                    <span class="icon is-small">
                                      <i class="fa fa-linkedin"></i>
                                    </span>
                                    <span>Linkedin</span>
                                </a>
                            @endif

                            @if(isset($socialMedia->twitter))
                                <a class="level-item button is-small is-link" href="{{$socialMedia->twitter}}">
                                    <span class="icon is-small">
                                      <i class="fa fa-twitter"></i>
                                    </span>
                                    <span>Twitter</span>
                                </a>
                            @endif
                            @if(isset($socialMedia->github))
                                <a class="level-item button is-small" href="{{$socialMedia->github}}">
                                    <span class="icon is-small">
                                      <i class="fa fa-github"></i>
                                    </span>
                                    <span>Github</span>
                                </a>
                            @endif
                            @if(isset($socialMedia->website))
                                <a class="level-item button is-small is-info" href="{{$socialMedia->website}}">
                                    <span class="icon is-small">
                                      <i class="fa fa-globe"></i>
                                    </span>
                                    <span>Website</span>
                                </a>
                            @endif
                        </div>
                    </nav>
                </div>
            </article>
        </div>

        @if($user->products->count() > 0)
            <div class="box">
                <div id="info-box" class="level-left">
                    <span class="button is-static">{{$user->products->count()}} Link</span>
                </div>
                <div class="media-content">
                    @foreach ($user->products as $product)
                        <div class="level">
                            <div class="level-left">
                                <h3 class="subtitle">
                                    <a href="/explore/{{$product->slug}}">{{$product->name}}</a>
                                </h3>
                            </div>

                            <div class="level-right">
                                <div class="tags">
                                    <span class="tag">
                                        <span class="icon is-small">
                                          <i class="fa fa-heart"></i>
                                        </span>
                                        <span>0</span>
                                    </span>
                                    <span class="tag">
                                        <span class="icon is-small">
                                          <i class="fa fa-comment"></i>
                                        </span>
                                        <span>0</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    @include('user.edit_modal')
@endsection

@section('page_script')
    <script type="text/javascript">
        $("#showEditForm").click(function () {
            $(".modal.edit-profile").addClass("is-active");
        });

        $("#close-modal, .modal-background").click(function () {
            $(".modal.edit-profile").removeClass("is-active");
            return false;
        })
    </script>
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var basicOption = {
            paramName: 'file',
            maxFilesize: 1,
            dictMaxFilesExceeded: '',
            addRemoveLinks: false,
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            headers: {'Pragma': 'no-cache', 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            clickable: true,
            parallelUploads: 1
        };

        var options = {
            init: function () {
                this.on("maxfilesexceeded", function (file) {
                });
                this.on("complete", function (file) {
                    this.removeFile(file);
                });
                this.on("uploadprogress", function (file) {
                    $('#user-photo .dz-message').html('<progress class="progress is-primary" value="50" max="100">50%</progress>').show();
                });
                this.on("success", function (file, res) {
                    $('#user-photo .dz-message').html('<progress class="progress is-primary" value="100" max="100">100%</progress>').show();
                    setTimeout(function () {
                        $('#user-photo .dz-message').text('Drop files here to upload').show();
                    }, 1000);

                    $('#user-photo-img').attr('src', res.image_url);
                    $('input[name="photo"]').val(res.image);
                });
                //TODO handling error
                this.on("error", function (file, res) {
                });
            }
        };

        var userPhotoUploader = new Dropzone('#user-photo-add', _.merge(basicOption, options));
    </script>
@endsection