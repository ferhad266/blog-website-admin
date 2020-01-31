@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Slider Configiration</h3>
            </div>
            <div class="box-body">
                <form action="{{route('slider.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Resim sek</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="file" name="slider_file" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Baslik</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" name="slider_title">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" name="slider_slug">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>URL</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" name="slider_url">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Icerik</label>
                        <div class="row">
                            <div class="row col-xs-12">
                            <textarea  id="editor1" name="slider_content"
                                      class="form-control"></textarea>
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Icerik</label>
                            <div class="row">
                                <div class="row col-xs-12">
                                    <select name="slider_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Passive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div align="right" class="box-footer">
                            <button class="btn btn-success" type="submit">Ekle</button>
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
