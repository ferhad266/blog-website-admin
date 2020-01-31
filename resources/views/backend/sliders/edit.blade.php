@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Slider Update</h3>
            </div>
            <div class="box-body">
                <form action="{{route('slider.update',$sliders->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @isset($sliders->slider_file)
                        <div class="form-group">
                            <label>Uploaded photo</label>
                            <div class="row">
                                <div class="row col-xs-12">
                                    <img width="100" src="/images/sliders/{{$sliders->slider_file}}" alt="">
                                </div>
                            </div>
                        </div>
                    @endisset


                    <div class="form-group">
                        <label>Resim sec</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="file" name="slider_file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Baslik</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" name="slider_title"
                                       value="{{$sliders->slider_title}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" name="slider_slug" value="{{$sliders->slider_slug}}">
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label>URL</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" name="slider_url" value="{{$sliders->slider_url}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Icerik</label>
                        <div class="row">
                            <div class="row col-xs-12">
                            <textarea  id="editor1" name="slider_content"
                                      class="form-control">{{$sliders->slider_title}}</textarea>
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <div class="row">
                                <div class="row col-xs-12">
                                    <select name="slider_status" class="form-control">
                                        <option {{$sliders->slider_status=="1"?"selected=''":""}} value="1">Active</option>
                                        <option {{$sliders->slider_status=="0"?"selected=''":""}} value="0">Passive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="oldFile" value="{{$sliders->slider_file}}">


                        <div align="right" class="box-footer">
                            <button class="btn btn-success" type="submit">update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('css')

@endsection
@section('js')

@endsection
