@extends('layouts.app');
@section('content')
    <head>
        <script src="{{asset('js/notes.js') }}" type="text/javascript"></script>

    </head>
    <script>
        window.onload = function () {
            hideDivs();
            addOnClick();
        }
    </script>
    <div class="container">
        @if(session('error'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-default" id="notebutton"><h4>Notes</h4></button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-default" id="tbdbutton"><h4>TBDs</h4></button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-default" id="imagebutton"><h4>Images</h4></button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-default" id="linkbutton"><h4>Links</h4></button>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class = "col-md-12 notes">
                <div id="notesdiv" class="notespage">
                    <h4><small>Notes</small></h4>
                    <textarea class="form-control" rows="10" name="notearea"/></textarea>
                    <br />
                </div>
            </div>
        </div>
        <div class="row">
            <div class = "col-md-12 tbds">
                <div id="tbdsdiv" class="notespage">
                    <h4><small>TBDs</small></h4>
                    <textarea class="form-control" rows="10" id="tbdarea" name="tbdarea"/></textarea>
                    <br />
                </div>
            </div>
        </div>
        <div class="row">
            <div class = "col-md-12 images">
                <div id="imagesdiv" class="notespage">
                    <h4><small>Images</small></h4>
                    <br />
                </div>
            </div>
        </div>
        <div class="row">
            <div class = "col-md-12 links">
                <div id="linksdiv" class="notespage">
                    <div class="container">
                        <div class="container">
                            <div class="form-inline">
                                {{Form::open(['url' => '/addLink', 'method' => 'POST'])}}
                                {{Form::label('link', 'Add a New Link')}}
                                {{Form::text('link', 'www.examplelink.com', ['class' => 'form-control'])}}
                                {{Form::submit('Add Link', ['class' => 'btn btn-success'])}}
                                {{Form::close()}}
                            </div>
                        </div>
                    @if(isset($links))
                        <table>
                        @foreach($links as $link)
                            <tr>
                                <td>
                                    My Links
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{Form::open(["url" => "/editLink", "method" => "POST"])}}
                                        <div class="form-inline">
                                            <input type="text" name="link" value="{{$link->link}}" onclick='openInNew(this);' class="form-control">
                                            <input type="hidden" name="id" value="{{$link->id}}">
                                            <input type="submit" name="submit" value="Save" class="btn btn-success">
                                        </div>
                                    {{Form::close()}}
                                </td>
                                <td>
                                    {{Form::open(["url" => "/deleteLink", "method" => "POST"])}}
                                        <input type="hidden" name="id" value="{{$link->id}}">
                                        <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                                    {{Form::close()}}
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    @endif
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-96935903-1', 'auto');
        ga('send', 'pageview');

    </script>
@endsection