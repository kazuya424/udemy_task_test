@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    showです
                    {{$contact->your_name}}
                    {{$contact->title}}
                    {{$contact->email}}
                    {{$contact->url}}
                    {{$gender}}
                    {{$age}}
                    {{$contact->contact}}
                    <form method="GET" action="{{route('contact.edit',['id' => $contact->id])}}">
                        @csrf

                        <input class="btn btn-info" type="submit" value="変更する">
                        <br>
                    </form>

                    <form method="POST" action="{{route('contact.destroy',['id' => $contact->id])}}" id="delete_{{$contact->id}}">
                        @csrf
                        <a href="#" class="btn btn-danger" data-id="{{$contact->id}}" onclick="deletePost(this);">削除する</a>
                        <!--javascript使用 クリックしたら削除メッセージ出る-->


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //削除するとメッセージを流す

    function deletePost(e) {
        'use strict';
        if (confirm('本当に削除していいんですか？')) {
            document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
</script>
@endsection