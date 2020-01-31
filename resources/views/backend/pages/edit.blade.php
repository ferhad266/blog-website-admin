@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Page Update</h3>
            </div>
            <div class="box-body">
                <form action="{{route('page.update',$pages->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @isset($pages->page_file)
                        <div class="form-group">
                            <label>Uploaded photo</label>
                            <div class="row">
                                <div class="row col-xs-12">
                                    <img width="100" src="/images/pages/{{$pages->page_file}}" alt="">
                                </div>
                            </div>
                        </div>
                    @endisset


                    <div class="form-group">
                        <label>Resim sec</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="file" name="page_file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Baslik</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" name="page_title"
                                       value="{{$pages->page_title}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" name="page_slug" value="{{$pages->page_slug}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Icerik</label>
                        <div class="row">
                            <div class="row col-xs-12">
                            <textarea id="editor1" name="page_content"
                                      class="form-control">{{$pages->page_title}}</textarea>
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <div class="row">
                                <div class="row col-xs-12">
                                    <select name="page_status" class="form-control">
                                        <option {{$pages->page_status=="1"?"selected=''":""}} value="1">Active</option>
                                        <option {{$pages->page_status=="0"?"selected=''":""}} value="0">Passive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="oldFile" value="{{$pages->page_file}}">


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
