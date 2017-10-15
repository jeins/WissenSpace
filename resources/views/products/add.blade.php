@extends('layouts.app')
@section('page_css')
    <link href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" rel="stylesheet">

    <style>
        .tab-pane {
            display: none;
        }

        .tab-pane:target {
            display: block;
        }

        .tab-content {
            margin-top: 50px;
            text-align: center;
        }

        .product-next-button {
            margin-top: 70px;
        }

        .dropzone {
            border: 1px dashed rgba(0,0,0,0.3);
            background: white;
            padding: 0;
        }

        #thumbnail .dropzone{
            height: 200px;
        }

        #thumbnail .dz-preview{
            display: none;
        }

        #thumbnail .dz-message {
            padding: 0;
            text-align: center;
        }

        #thumbnail .dz-default.dz-message {
            margin: -30px 0;
        }

        #product-thumbnail{
            width: 120px;
            height: 120px;
            border-radius: 20px;
            margin: 2em auto;
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="container is-widescreen">
        <div class="tabs is-centered">
            <ul>
                <li class="product-add-tab"><a href="#jenis">{{trans('product.add.tab.jenis')}}</a></li>
                <li class="product-add-tab"><a href="#informasi">{{trans('product.add.tab.informasi')}}</a></li>
                <li class="product-add-tab"><a href="#media">{{trans('product.add.tab.media')}}</a></li>
                <li class="product-add-tab"><a href="#pemilik">{{trans('product.add.tab.pemilik')}}</a></li>
            </ul>
        </div>

        <div class="tab-content">
            <div id="jenis" class="tab-pane animated">
                <h1 class="title">{{trans('product.add.jenis.title')}}</h1>

                <div class="columns">
                    <div class="column"><a class="button is-large is-outlined is-danger is-flex"
                                           onclick="setProductType(this, '1')">Youtube Channel / Video</a></div>
                    <div class="column"><a class="button is-large is-outlined is-primary is-flex"
                                           onclick="setProductType(this, '2')">Aplikasi Web/Mobile</a></div>
                    <div class="column"><a class="button is-large is-outlined is-warning is-flex"
                                           onclick="setProductType(this, '3')">Artikel Bacaan</a></div>
                    <div class="column"><a class="button is-large is-outlined is-info is-flex"
                                           onclick="setProductType(this, '4')">Buku</a></div>
                </div>

                <h2 class="subtitle">{{trans('product.add.jenis.subtitle')}}</h2>
            </div>

            <div id="informasi" class="tab-pane animated">
                <h1 class="title">{{trans('product.add.info.title')}}</h1>

                {{--URL--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Link / URL</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" name="link" placeholder="{{trans('product.add.info.url')}}">
                            </div>
                        </div>
                    </div>
                </div>

                {{--NAME--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Nama</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" name="name" placeholder="{{trans('product.add.info.name')}}">
                            </div>
                        </div>
                    </div>
                </div>

                {{--TAGLINE--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Tagline</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" name="tagline" placeholder="{{trans('product.add.info.tagline')}}">
                            </div>
                        </div>
                    </div>
                </div>

                {{--DESCRIPTION--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Deskripsi</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" name="subject"
                                       placeholder="{{trans('product.add.info.description')}}">
                            </div>
                        </div>
                    </div>
                </div>

                {{--CATEGORIES--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Kategorie</label>
                    </div>
                    <div class="field-body">
                        <div class="field is-narrow">
                            <div class="control">
                                <div class="select is-fullwidth">
                                    <select id="product-tags">
                                        @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}">{{ucfirst($tag->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="product-next-button button is-success is-outlined is-flex"
                   onclick="setProductInfo()">Lanjut</a>
            </div>

            <div id="media" class="tab-pane animated">
                <h1 class="title">Upload Thumbnail</h1>
                <div id="thumbnail" class="columns is-centered">
                    <div class="column is-half">
                        <div class="dz-preview"></div>
                        <form id="product-add-thumbnail" name="product-add-thumbnail" method="POST" action="{{route('upload.tmp.image')}}" class="dropzone" enctype="multipart/form-data">
                            <img id="product-thumbnail">
                        </form>
                    </div>
                </div>

                <h1 class="title">Upload Images</h1>
                <div class="columns is-centered">
                    <div class="column is-half">
                        <form id="product-add-images" name="product-add-images" method="POST" action="{{route('upload.tmp.image')}}" class="dropzone" enctype="multipart/form-data">
                        </form>
                    </div>
                </div>

                <a class="product-next-button button is-success is-outlined is-flex"
                   onclick="setActiveTab('#pemilik')">Lanjut</a>

                 <br>
            </div>

            <div id="pemilik" class="tab-pane animated">
                <h1 class="title">Upload pemilik</h1>

                {{--NAME--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Nama Pemilik</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" name="owner_name">
                            </div>
                        </div>
                    </div>
                </div>

                {{--TWITTER--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Twitter</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" name="owner_twitter">
                            </div>
                        </div>
                    </div>
                </div>


                <a class="product-next-button button is-success is-outlined is-flex"
                   onclick="postProduct()">Post Product</a>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script type="text/javascript">
        var productData = {
            type_id: '',
            info: {
                name: '',
                link: '',
                tagline: '',
                subject: ''
            },
            tag_id: '',
            thumbnail: '',
            images: [],
            owner: {
                name: '',
                twitter_username: ''
            }
        };
        var firstTab = 'jenis';

        init();

        function init() {
            setActiveTab(firstTab);

            $('li.product-add-tab').click(function () {
                $('li.product-add-tab').removeClass('is-active');
                $(this).addClass('is-active');
                return true;
            });
        }

        function setActiveTab(currentHash) {
            window.location.hash = currentHash;
            $('li.product-add-tab').removeClass('is-active');
            var tab = $('.product-add-tab a[href="' + currentHash + '"]').parent('li');

            if (tab.length === 0) {
                window.location.hash = firstTab;
                $('li.product-add-tab:first').addClass('is-active');
            } else {
                tab.addClass('is-active');
            }
        }

        function setProductType(obj, type) {
            $('.column').children().addClass('is-outlined');
            $(obj).removeClass('is-outlined');

            productData['type_id'] = type;

            setActiveTab('#informasi');
        }

        function setProductInfo() {
            var productInfoKeys = ['link', 'name', 'tagline', 'subject'];

            _.forEach(productInfoKeys, function (key) {
                var valueOf = $('#informasi').find('input[name="' + key + '"]').val();

                productData['info'][key] = valueOf;
            });

            productData['tag_id'] = $('#product-tags').val();

            setActiveTab('#media');
        }

        function postProduct(){
            var ownerName = $('#pemilik').find('input[name="owner_name"]').val();
            var ownerTwitter = $('#pemilik').find('input[name="owner_twitter"]').val();

            productData.owner = {
                name: ownerName,
                twitter_username: ownerTwitter
            };

            axios.post(
                "{{route('contribute.post')}}",
                productData,
                {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            )
            .then(function (response) {
                if(response){
                    window.location = '/home';
                }
            })
            .catch(function (error) {
                console.error(error);
            });
        }
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

        var thumbnailOption = {
            init: function(){
                this.on("maxfilesexceeded", function(file) {});
                this.on("complete", function(file) {
                    this.removeFile(file);
                });
                this.on("uploadprogress", function(file) {
                    $('#thumbnail .dz-message').html('<progress class="progress is-primary" value="50" max="100">50%</progress>').show();
                });
                this.on("success", function(file, res){
                    $('#thumbnail .dz-message').html('<progress class="progress is-primary" value="100" max="100">100%</progress>').show();
                    setTimeout(function() {
                        $('#thumbnail .dz-message').text('Drop files here to upload').show();
                    }, 1000);
                    productData.thumbnail = res.image_url;
                    $('#product-thumbnail').attr('src', res.image_url);
                });
                //TODO handling error
                this.on("error", function(file, res) {});
            }
        };

        var imagesOption = {
            init: function(){
                this.on("success", function(file, res){
                    productData.images.push(res.image_url);
                });
            }
        };

        var thumbnailUploader = new Dropzone('#product-add-thumbnail', _.merge(basicOption, thumbnailOption));
        var imagesUploader = new Dropzone('#product-add-images', _.merge(basicOption, imagesOption))
    </script>
@endsection
