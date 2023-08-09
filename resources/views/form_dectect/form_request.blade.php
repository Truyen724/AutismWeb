

<div class="form_blade">
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

    </div>
</div>
</div>
</div>
</div>
