<div class="modal edit-profile">
    <div class="modal-background"></div>
    <div class="modal-card">

        <header class="modal-card-head">
            <p class="modal-card-title">Edit Profile</p>
            <button id="close-modal" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <div id="user-photo" class="columns is-centered">
                <div class="column is-half">
                    <div class="dz-preview"></div>
                    <form id="user-photo-add" method="POST" action="{{route('image.upload', \App\Http\Controllers\ImageController::USER_TYPE)}}" class="dropzone"
                          enctype="multipart/form-data">
                        <img id="user-photo-img" src="{{$user->photo ? route('image.view', ['type' => \App\Http\Controllers\ImageController::USER_TYPE, 'image' => $user->photo]) : 'https://cdn1.iconfinder.com/data/icons/business-charts/512/customer-512.png'}}">
                    </form>
                </div>
            </div>

            <form id="user-update-form" role="form" method="POST" action="{{route('profile.update', $user->id)}}">
                {{ csrf_field() }}
                <input type="hidden" name="photo" value="{{$user->photo}}">

                <div class="field">
                    <label class="label">Nama Lengkap</label>
                    <div class="control">
                        <input class="input" name="full_name" type="text" value="{{$user->full_name}}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Status</label>
                    <div class="control">
                        <textarea class="textarea" name="status" type="text"
                                  placeholder="Status" maxlength="150">{{$user->status}}</textarea>
                    </div>
                </div>

                <label class="label">Social Media</label>
                <div class="field">
                    <div class="control has-icons-left">
                        <input class="input" name="linkedin" type="text"
                               value="{{isset($socialMedia->linkedin) ? $socialMedia->linkedin : ''}}"
                               placeholder="username Linkedin">
                        <span class="icon is-small is-left">
                        <i class="fa fa-linkedin-square"></i>
                    </span>
                    </div>
                </div>
                <div class="field">
                    <div class="control has-icons-left">
                        <input class="input" name="twitter" type="text"
                               value="{{isset($socialMedia->twitter) ? $socialMedia->twitter : ''}}"
                               placeholder="username Twitter">
                        <span class="icon is-small is-left">
                        <i class="fa fa-twitter-square"></i>
                    </span>
                    </div>
                </div>
                {{-- <div class="field">
                    <div class="control has-icons-left">
                        <input class="input" name="github" type="text"
                               value="{{isset($socialMedia->github) ? $socialMedia->github : ''}}"
                               placeholder="username Github">
                        <span class="icon is-small is-left">
                        <i class="fa fa-github-square"></i>
                    </span>
                    </div>
                </div> --}}
                <div class="field">
                    <div class="control has-icons-left">
                        <input class="input" name="website" type="text"
                               value="{{isset($socialMedia->website) ? $socialMedia->website : ''}}"
                               placeholder="Personal Website">
                        <span class="icon is-small is-left">
                        <i class="fa fa-globe"></i>
                    </span>
                    </div>
                </div>

            </form>
        </section>
        <footer class="modal-card-foot">
            <button onclick="updateData()" class="button is-success">Save changes</button>
        </footer>
    </div>
</div>

<script type="text/javascript">
    function updateData() {
        $('#user-update-form').submit();
    }
</script>
