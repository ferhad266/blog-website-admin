@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Settings</h3>
            </div>
            <div class="box-body">
                <form action="{{route('settingsUpdate',['id' => $settings->id])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Aciklama</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" value="{{$settings->settings_description}}">
                            </div>
                        </div>
                    </div>

                    @if($settings->settings_type == 'file')
                        <div class="form-group">
                            <label>Resim cek</label>
                            <div class="row">
                                <div class="row col-xs-12">
                                    <input class="form-control" type="file" name="settings_value" required>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Icerik</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                @if($settings->settings_type == 'text')
                                    <input class="form-control" type="text" name="settings_value" required
                                           value="{{$settings->settings_value}}">
                                @endif

                                @if($settings->settings_type == 'textarea')
                                    <textarea name="settings_value"
                                              class="form-control">{{$settings->settings_value}}</textarea>
                                @endif

                                @if($settings->settings_type == 'ckeditor')
                                    <textarea name="settings_value" id="editor1"
                                              class="form-control">{{$settings->settings_value}}</textarea>
                                @endif

                                @if($settings->settings_type == 'file')
                                    <img  width="100" src="/images/settings/{{$settings->settings_value}}" alt="">
                                @endif

                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                        </div>
                        @if($settings->settings_type == 'file')
                            <input type="hidden" name="oldFile" value="{{$settings->settings_value}}">
                        @endif

                        <div align="right" class="box-footer">
                            <button class="btn btn-success" type="submit">Duzenle</button>
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
