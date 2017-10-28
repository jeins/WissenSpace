<div class="modal login">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box is-centered">
            <figure class="image">
                <img src="/images/logo.png"  width="200">
            </figure>

            <div class="has-medium-vm" style="text-align: center;">
                <p class="subtitle">
                    Selamat datang di WissenSpace
                    <br> saatnya berkontribusi untuk Indonesia!
                    <br> share link bermanfaatyang kamu temukan di Internet</p>
            </div>

            <div class="columns">
                <div class="column">
                    <a href="{{route('auth.redirect',['provider' => 'google'])}}" class="button is-danger">
                        <span class="icon">
                          <i class="fa fa-google"></i>
                        </span>
                        <span>LOGIN GOOGLE</span></a>
                </div>
                <div class="column">
                    <a href="{{route('auth.redirect',['provider' => 'twitter'])}}" class="button is-primary">
                        <span class="icon">
                          <i class="fa fa-twitter"></i>
                        </span>
                        <span>LOGIN TWITTER</span></a>
                </div>
                <div class="column">
                    <a href="{{route('auth.redirect',['provider' => 'facebook'])}}" class="button is-info">
                        <span class="icon">
                          <i class="fa fa-facebook"></i>
                        </span>
                        <span>LOGIN FACEBOOK</span></a>
                </div>
            </div>
        </div>
    </div>
    <button id="close-modal" class="delete" aria-label="close"></button>
</div>
