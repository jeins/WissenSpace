@extends('layouts.app')
@section('page_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">

    <style>
        #flow-tabs li:not(.is-clickable) {
            pointer-events: none;
        }

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
            border: 1px dashed rgba(0, 0, 0, 0.3);
            background: white;
            padding: 0;
        }

        #thumbnail .dropzone {
            height: 200px;
        }

        #thumbnail .dz-preview {
            display: none;
        }

        #thumbnail .dz-message {
            padding: 0;
            text-align: center;
        }

        #thumbnail .dz-default.dz-message {
            margin: -30px 0;
        }

        #product-thumbnail {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            margin: 2em auto;
            display: block;
        }

        .product-tags-selected {
            border: 1px solid;
            padding: 15px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="has-bottom-space">
        <div class="tabs is-centered">
            <ul id="flow-tabs">
                <li class="product-add-tab is-clickable"><a href="#jenis">{{trans('product.add.tab.jenis')}}</a></li>
                <li class="product-add-tab"><a href="#informasi">{{trans('product.add.tab.informasi')}}</a></li>
                <li class="product-add-tab"><a href="#media">{{trans('product.add.tab.media')}}</a></li>
                <li class="product-add-tab"><a href="#pemilik">{{trans('product.add.tab.pemilik')}}</a></li>
            </ul>
        </div>

        <div class="tab-content">
            <div id="jenis" class="tab-pane animated">
                <h1 class="title">{{trans('product.add.jenis.title')}}</h1>

                <div class="columns">
                    <div class="column"><a class="button is-large is-outlined is-danger is-flex" id="productType1"
                                           onclick="setProductType(this, '1')">Youtube Channel / Video</a></div>
                    <div class="column"><a class="button is-large is-outlined is-primary is-flex" id="productType2"
                                           onclick="setProductType(this, '2')">Aplikasi Web/Mobile</a></div>
                    <div class="column"><a class="button is-large is-outlined is-warning is-flex" id="productType3"
                                           onclick="setProductType(this, '3')">Artikel Bacaan</a></div>
                    <div class="column"><a class="button is-large is-outlined is-info is-flex" id="productType4"
                                           onclick="setProductType(this, '4')">Buku</a></div>
                </div>

                <h2 class="subtitle">{{trans('product.add.jenis.subtitle')}}</h2>
            </div>

            <div id="informasi" class="tab-pane animated">
                <h1 class="title">{{trans('product.add.info.title')}}</h1>

                {{--URL--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Link / URL *</label>
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
                        <label class="label">Nama * </label>
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

                {{--CATEGORIES--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Tag / Kategorie *</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <div class="tile is-ancestor">
                                    <div class="select is-multiple tile is-parent is-vertical is-4">
                                        <div class="tile">
                                            <div class="tile is-child">
                                                <select id="product-tags" multiple size="3">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{$tag->id}}"
                                                                name="{{ucfirst($tag->name)}}">{{ucfirst($tag->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="tile is-child">
                                                <button class="button" onclick="addTag()">
                                                <span class="icon">
                                                  <i class="fa fa-plus"></i>
                                                </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tile is-parent">
                                        <div class="tags product-tags-selected"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{--DESCRIPTION--}}
                <div class="field is-horizontal" style="margin-top: 30px">
                    <div class="field-label is-normal">
                        <label class="label">Deskripsi</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input id="product-subject" type="hidden" name="subject" placeholder="{{trans('product.add.info.description')}}">
                                <trix-editor input="product-subject" no-uploads></trix-editor>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="product-next-button button is-success is-outlined is-flex" disabled>Lanjut</a>
            </div>

            <div id="media" class="tab-pane animated">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Upload Gambar (logo/icon)</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div id="thumbnail" class="columns is-centered">
                                <div class="column is-half">
                                    <div class="dz-preview"></div>
                                    <form id="product-add-thumbnail" method="POST"
                                          action="{{route('image.upload', \App\Http\Controllers\ImageController::PRODUCT_TYPE)}}"
                                          class="dropzone" enctype="multipart/form-data">
                                        <img id="product-thumbnail">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Upload Screenshot (tidak wajib)</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="columns is-centered">
                                <div class="column is-half">
                                    <form id="product-add-images" name="product-add-images" method="POST"
                                          action="{{route('image.upload', \App\Http\Controllers\ImageController::PRODUCT_TYPE)}}"
                                          class="dropzone" enctype="multipart/form-data">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- YOUTUBE URL --}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Youtube URL (tidak wajib)</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" name="youtubeUrl" placeholder="url video, (contoh: https://www.youtube.com/watch?v=xifBB2f28mw)">
                            </div>
                        </div>
                    </div>
                </div>

                <a class="product-next-button button is-success is-outlined is-flex" disabled>Lanjut</a>

                <br>
            </div>

            <div id="pemilik" class="tab-pane animated">
                <h1 class="title">Info pemilik (youtube/ penulis artikel / aplikasi)</h1>

                {{--NAME--}}
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Nama Pemilik *</label>
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
                                <input class="input" name="owner_twitter"
                                       placeholder="username twitter pemilik link ini (kalau ada)">
                            </div>
                        </div>
                    </div>
                </div>


                <a class="product-next-button button is-success is-outlined is-flex" disabled>Post Product</a>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script type="text/javascript">
        var productData = {!! json_encode($field) !!};
        var firstTab = 'jenis';
        var requiredInformation = {'link': false, 'name': false, 'tags': false};
        var requiredOwner = {'owner_name': false};
        var requiredMedia = {'thumbnail': false};
        var productInfoKeys = ['link', 'name', 'tagline', 'subject'];

        init();

        function init() {
            setActiveTab(firstTab);
            checkRequiredField();
            validateProductData();

            $('li.product-add-tab').click(function () {
                $('li.product-add-tab').removeClass('is-active');
                $(this).addClass('is-active');
                return true;
            });

            if (_.has(productData, 'product_id')) {
                requiredInformation = {'link': true, 'name': true, 'tags': true};
                requiredOwner = {'owner_name': true};
                requiredMedia = {'thumbnail': true};

                enableNextButton('informasi', requiredInformation);
                enableNextButton('pemilik', requiredOwner);
                enableNextButton('media', requiredMedia);

                $('#productType' + productData['type_id']).removeClass('is-outlined');

                _.forEach(productInfoKeys, function (key) {
                    $('#informasi').find('input[name="' + key + '"]').val(productData.info[key]);
                });

                _.forEach(productData.tag_id, function (id, i) {
                    var tagName = productData.tag_name[i];

                    $('#product-tags option[value="' + id + '"]').remove();
                    $('.product-tags-selected').append('<span class="tag is-success">' + tagName + '<button onclick="removeTag(this)" tagId="' + id + '" tagName="' + tagName + '" class="tag-remove-selected delete is-small"></button></span>');
                });

                $('#product-thumbnail').attr('src', productData.thumbnail);
                $('#media').find('input[name="youtubeUrl"]').val(productData.youtube_url);

                $('#pemilik').find('input[name="owner_name"]').val(productData.owner.name);
                $('#pemilik').find('input[name="owner_twitter"]').val(productData.owner.twitter_username);
            }
        }

        function addTag() {
            var tagId = $('#product-tags').val();

            _.forEach(tagId, function (id) {
                var tagName = $('#product-tags').find("option[value='" + id + "']").attr('name');

                $('#product-tags option[value="' + id + '"]').remove();

                $('.product-tags-selected').append('<span class="tag is-success">' + tagName + '<button onclick="removeTag(this)" tagId="' + id + '" tagName="' + tagName + '" class="tag-remove-selected delete is-small"></button></span>');
            });
        }

        function removeTag(currTag) {
            var tagId = $(currTag).attr('tagId');
            var tagName = $(currTag).attr('tagName');
            $('#product-tags').append('<option value="' + tagId + '" name="' + tagName + '"style="text-transform: capitalize">' + tagName + '</option>');
            $(currTag).parent().remove();

            _.pull(productData['tag_id'], parseInt(tagId));
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

            $('#flow-tabs li:nth-child(2)').addClass('is-clickable');
            setActiveTab('#informasi');
        }

        function setProductInfo() {
            _.forEach(productInfoKeys, function (key) {
                var valueOf = $('#informasi').find('input[name="' + key + '"]').val();
                productData['info'][key] = valueOf;
            });

            var tmpProductData = [];
            $('.product-tags-selected').find('button').each(function (index, el) {
                var tagId = $(el).attr('tagId');

                if(!_.includes(productData['tag_id'], tagId)){
                    tmpProductData.push(tagId);
                }
            });
            productData['tag_id'] = tmpProductData;

            $('#flow-tabs li:nth-child(3)').addClass('is-clickable');
            setActiveTab('#media');
        }

        function postProduct() {
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
                    if (response) {
                        window.location = response.data;
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        }

        function checkRequiredField() {
            $('#informasi input[name="link"], input[name="name"]').change(function () {
                var key = $(this).attr('name');
                requiredInformation[key] = !!$(this).val();

                enableNextButton('informasi', requiredInformation);
            });

            $('#informasi').on('DOMSubtreeModified', '.product-tags-selected', function () {
                requiredInformation['tags'] = ($(this).find('button').length > 0);
                enableNextButton('informasi', requiredInformation)
            })

            $('#pemilik').find('input[name="owner_name"]').change(function () {
                requiredOwner['owner_name'] = !!$(this).val();

                enableNextButton('pemilik', requiredOwner);
            });
        }

        function enableNextButton(id, values) {
            var btn = $('#' + id).find('.product-next-button');
            var tmpVal = true;

            _.forEach(values, function (value) {
                if (!value) {
                    tmpVal = false;
                }
            });

            if (tmpVal) {
                $(btn).removeAttr('disabled');

                if (id === 'informasi') {
                    $(btn).attr('onClick', 'setProductInfo()');
                } else if (id === 'pemilik') {
                    $(btn).attr('onClick', 'postProduct()');
                } else if (id === 'media') {
                    $(btn).attr('onClick', "setActiveTab('#pemilik')");
                }
            } else {
                $(btn).attr('disabled', true);
                $(btn).removeAttr('onClick');
            }
        }

        function validateProductData() {
            //validate product url
            $('#informasi').find('input[name="link"]').change(function () {
                var value = $(this).val();
                var inputLink = this;
                if (value) {
                    axios.post(
                        "{{route('product.validate')}}",
                        {action: 'productUrl', value: value},
                        {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    )
                        .then(function (response) {
                            var isValid = response.data.isValid;
                            var productUrl = response.data.data;
                            if (!isValid) {
                                var message = '<p class="help is-danger"> Product URL sudah tersedia : <a href="' + productUrl + '">' + productUrl + ' </a></p>';
                                $(inputLink).addClass('is-danger');
                                $(inputLink).parent().parent().find('.help').remove();
                                $(inputLink).parent().parent().append(message);
                            } else {
                                $(inputLink).removeClass('is-danger');
                                $(inputLink).parent().parent().find('.help').remove();
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                }
            });

            //validate youtube and get id
            $('#media').find('input[name="youtubeUrl"]').change(function () {
                var value = $(this).val();
                var inputLink = this;
                if (value) {
                    axios.post(
                        "{{route('product.validate')}}",
                        {action: 'youtubeUrl', value: value},
                        {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    )
                        .then(function (response) {
                            var isValid = response.data.isValid;
                            var youtubeId = response.data.data;
                            if (!isValid) {
                                var message = '<p class="help is-danger"> Youtube URL tidak valid </p>';
                                $(inputLink).addClass('is-danger');
                                $(inputLink).parent().parent().find('.help').remove();
                                $(inputLink).parent().parent().append(message);
                            } else {
                                $(inputLink).removeClass('is-danger');
                                $(inputLink).parent().parent().find('.help').remove();
                                productData['youtube_id'] = youtubeId;
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                }
            });
        }
    </script>

    <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener("trix-file-accept", function(event) {
            if (event.target.hasAttribute("no-uploads")) {
                event.preventDefault()
            }
        })
    </script>

    <script src="{{ asset('js/dropzone.js') }}"></script>
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
            init: function () {
                this.on("maxfilesexceeded", function (file) {
                });
                this.on("complete", function (file) {
                    this.removeFile(file);
                });
                this.on("uploadprogress", function (file) {
                    $('#thumbnail .dz-message').html('<progress class="progress is-primary" value="50" max="100">50%</progress>').show();
                });
                this.on("success", function (file, res) {
                    $('#thumbnail .dz-message').html('<progress class="progress is-primary" value="100" max="100">100%</progress>').show();
                    setTimeout(function () {
                        $('#thumbnail .dz-message').text('Drop files here to upload').show();
                    }, 1000);
                    productData.thumbnail = res.image_url;
                    $('#product-thumbnail').attr('src', res.image_url);

                    requiredMedia.thumbnail = true;
                    enableNextButton('media', requiredMedia);
                });
                //TODO handling error
                this.on("error", function (file, res) {
                });
            }
        };

        var imagesOption = {
            addRemoveLinks: true,
            init: function () {
                if (productData['images']) {
                    var me = this;

                    _.forEach(productData['images'], function (imgName) {
                        var img = {name: imgName, type: 'image/jpeg'};
                        me.options.addedfile.call(me, img);
                        me.options.thumbnail.call(me, img, '/image/p/' + imgName);
                        img.previewElement.classList.add('dz-success');
                        img.previewElement.classList.add('dz-complete');
                    });
                }

                this.on('removedfile', function (file) {
                    var imgName = file.name;

                    _.pull(productData['images'], imgName);

                    axios.delete(
                        "/image/p/" + imgName,
                        {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    )
                });
                this.on("success", function (file, res) {
                    productData.images.push(res.image);
                });
            }
        };

        var thumbnailUploader = new Dropzone('#product-add-thumbnail', _.merge(basicOption, thumbnailOption));
        var imagesUploader = new Dropzone('#product-add-images', _.merge(basicOption, imagesOption))
    </script>
@endsection
