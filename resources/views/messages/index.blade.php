@php
    /** @var \App\Entities\Message[] $messages */
@endphp
@extends('layout.app')

@section('content')
    <div class="container page">
        <table class="table">
            <thead>
            <tr>
                <th>@lang('messages.name')</th>
                <th>@lang('messages.email')</th>
                <th>@lang('messages.subject')</th>
                <th>@lang('messages.message')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->message }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
