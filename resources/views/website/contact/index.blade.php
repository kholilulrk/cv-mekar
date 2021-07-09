<section id="contact-us" class="white-bg page-section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 sm-mb-40">
                <div class="contact-3-info">
                    <div class="clearfix">
                        <div class="section-title text-left">
                            <h6>If you got any questions </h6>
                            <h2 class="title-effect">Contact Us</h2>
                        </div>
                        <form role="form" method="post" action="{{ route('contact.store') }}">
                            {{ csrf_field() }}
                            @if (Session::has('status'))
                                <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                            @endif
                            @if ($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                                @endforeach
                            @endif
                            <div class="contact-form clearfix">
                                <div class="section-field">
                                    <input id="name" type="text" placeholder="Name*" class="form-control"  name="name" value="{{ old('name') }}">
                                </div>
                                <div class="section-field">
                                    <input type="email" placeholder="Email*" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="section-field">
                                    <input type="text" placeholder="Phone*" class="form-control" name="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="section-field textarea">
                                    <textarea class="input-message form-control" placeholder="Comment*"  rows="7" name="description">{{ old('description') }}</textarea>
                                </div>
                                <!-- Google reCaptch-->
                                <div class="g-recaptcha section-field clearfix" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                <input type="hidden" name="action" value="sendEmail" />
                                <button id="submit" name="submit" type="submit" value="Send" class="button"><span> Send
                                        message </span> <i class="fa fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
