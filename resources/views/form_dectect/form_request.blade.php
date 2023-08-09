<div>
    <div class="columns">
        <div class="column is-full banner-container"
            style="background: url({{ asset('images/bg-1.jpeg') }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        ">
            <div class="columns" style="position: relative">
                <div class="column">
                    <h1 class="p-title">
                        {{ __('client/contact.contact') }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="columns p-7" style="margin-bottom: 95px">
        <div class="column is-5 is-offset-1 p-5" style="margin-top: 95px">
            <form id = "form-section" method="POST" action="">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Address:</strong>
                            <input type="text" name="address" class="form-control" placeholder="Address" value="{{ old('address') }}">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Phone:</strong>
                            <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Subject:</strong>
                            <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}">
                            @if ($errors->has('subject'))
                                <span class="text-danger">{{ $errors->first('subject') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Message:</strong>
                            <textarea name="message" rows="3" class="form-control">{{ old('message') }}</textarea>
                            @if ($errors->has('message'))
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>ReCaptcha:</strong>
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group text-left">
                    <button id="submit-button" class="btn btn-success btn-submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="column is-5 " style="max-height: 825px; margin-top: 95px">
            <p class="mt-3">
                <iframe id="iframe"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3926.755497046378!2d103.96379601397136!3d10.200500372350605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a78d22e0fc21b5%3A0x27408122e0c2c83d!2zMTAyIMSQxrDhu51uZyBUcuG6p24gSMawbmcgxJDhuqFvLCBUVC4gRMawxqFuZyDEkMO0bmcsIFBow7ogUXXhu5FjLCBLacOqbiBHaWFuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1676202813839!5m2!1svi!2s"
                    width="100%" style="border: 0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </p>
        </div>
    </div>
    <div class="columns is-variable is-8" style="margin-bottom: 95px">
        <div class="column is-10 is-offset-1">
            <div class="columns">
                <div class="column is-3">
                    <div class="box is-flex-direction-column" style="border-radius: 25px;">
                        <div class="block">
                            <div class="block box-icon is-flex is-align-items-center is-justify-content-center"
                                style="margin: 0 auto">
                                <div class="icon is-large">
                                    <i class="far fa-2x fa-envelope has-text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="is-flex-direction-column" style="text-align: center">
                            <h4 class="block title" style="color: #223645;">EMAIL ADDRESS</h1>
                                <ul class="block">
                                    <li>

                                        <a>support@gmail.com</a>
                                    </li>
                                    <li>

                                        <a>support@gmail.com</a>
                                    </li>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="box is-flex-direction-column" style="border-radius: 25px;">
                        <div class="block">
                            <div class="block box-icon is-flex is-align-items-center is-justify-content-center"
                                style="margin: 0 auto">
                                <div class="icon is-large">
                                    <i class="fas fa-2x fa-phone has-text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="is-flex-direction-column" style="text-align: center">
                            <h4 class="block title" style="color: #223645;">PHONE NUMBER</h1>
                                <ul class="block">
                                    <li>
                                        <a>support@gmail.com</a>
                                    </li>
                                    <li>

                                        <a>support@gmail.com</a>
                                    </li>

                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="box is-flex-direction-column" style="border-radius: 25px;">
                        <div class="block">
                            <div class="block box-icon is-flex is-align-items-center is-justify-content-center"
                                style="margin: 0 auto">
                                <div class="icon is-large">
                                    <i class="fas fa-2x fa-map-marker-alt has-text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="is-flex-direction-column" style="text-align: center">
                            <h4 class="block title" style="color: #223645;">ADDRESS LOCATION</h1>
                                <ul class="block">
                                    <li>
                                        102 Trần Hưng Đạo Phường Dương Tơ, Tp.Phú Quốc Tỉnh Kiên Giang
                                    </li>
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="box is-flex-direction-column" style="border-radius: 25px;">
                        <div class="block">
                            <div class="block box-icon is-flex is-align-items-center is-justify-content-center"
                                style="margin: 0 auto">
                                <div class="icon is-large">
                                    <i class="fas fa-2x fa-map-marker-alt has-text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="is-flex-direction-column" style="text-align: center">
                            <h4 class="block title" style="color: #223645;">ADDRESS LOCATION</h1>
                                <ul class="block">
                                    <li>
                                        102 Trần Hưng Đạo Phường Dương Tơ, Tp.Phú Quốc Tỉnh Kiên Giang
                                    </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
</div>
