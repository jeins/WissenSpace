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
                                           onclick="setProductType(this, 'youtube')">Youtube Channel / Video</a></div>
                    <div class="column"><a class="button is-large is-outlined is-primary is-flex"
                                           onclick="setProductType(this, 'apps')">Aplikasi Web/Mobile</a></div>
                    <div class="column"><a class="button is-large is-outlined is-warning is-flex"
                                           onclick="setProductType(this, 'article')">Artikel Bacaan</a></div>
                    <div class="column"><a class="button is-large is-outlined is-info is-flex"
                                           onclick="setProductType(this, 'book')">Buku</a></div>
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
                                <input class="input" name="url" placeholder="{{trans('product.add.info.url')}}">
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
                                <input class="input" name="description"
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
                                    <select id="product-category">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
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
                <form id="product-add-thumbnail" name="product-add-thumbnail" method="POST" action="{{route('upload.tmp.image')}}" class="dropzone" enctype="multipart/form-data">
                    <img id="product-thumbnail" src="">
                </form>
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
    {{-- // todo: move to separate js file, fixed ajax--}}
    <script type="text/javascript">
        var productData = {type: '', info: {}, thumbnail: '', images: {}, owner: {}};
        var firstTab = 'jenis';

        init();

        function init() {
            setActiveTab(window.location.hash ? window.location.hash : firstTab);

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

            setProductData('type', type);

            setActiveTab('#informasi');
        }

        function setProductInfo() {
            var productInfoKeys = ['url', 'name', 'tagline', 'description', 'category'];

            _.forEach(productInfoKeys, function (key) {
                var valueOf = $('#informasi').find('input[name="' + key + '"]').val();

                if(key === 'category') {
                    valueOf = $('#product-category').val();
                }

                setProductData('info.' + key, valueOf);
            });

            setActiveTab('#media');
        }

        function postProduct(){
            var ownerName = $('#pemilik').find('input[name="owner_name"]').val();
            var ownerTwitter = $('#pemilik').find('input[name="owner_twitter"]').val();

            productData.owner = {
                name: ownerName,
                twitter: ownerTwitter
            };

            console.log(productData);
        }

        function setProductData(key, value) {
            if (key.includes('.')) {
                var keys = key.split('.');
                productData[keys[0]][keys[1]] = value;
            } else {
                productData[key] = value;
            }
        }
    </script>

    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzoneOptions = {
            paramName: 'file',
            maxFilesize: 1,
            addRemoveLinks: false,
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            headers: {'Pragma': 'no-cache', 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            clickable: true,
            parallelUploads: 1,
            init: function(){
                this.on("success", function(file, res){
                    productData.thumbnail = res.image_url;
                })
                //TODO handling error
            }
        };

        var thumbnailUploader = new Dropzone('#product-add-thumbnail', dropzoneOptions);
    </script>
@endsection