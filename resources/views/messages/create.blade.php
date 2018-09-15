@extends('layout.app')

@section('content')
    <div class="container page">
        <h1 class="text-center">@lang('messages.create_message')</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-8 center">
                <form class="form-horizontal" method="POST" action="{{ route('messages.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">@lang('messages.name')</label>

                        <input id="name" type="text" class="form-control" name="name"
                               value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">@lang('messages.email')</label>

                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                        <label for="subject" class="control-label">@lang('messages.subject')</label>

                        <input id="subject" type="text" class="form-control" name="subject"
                               value="{{ old('subject') }}" required>

                        @if ($errors->has('subject'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        <label for="message" class="control-label">@lang('messages.message')</label>

                        <textarea id="message" type="text" class="form-control" name="message"
                                  required>{{ old('message') }}</textarea>

                        @if ($errors->has('message'))
                            <span class="help-block">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            @lang('messages.create_message')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
