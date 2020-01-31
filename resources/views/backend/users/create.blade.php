@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">User addition</h3>
            </div>
            <div class="box-body">
                <form action="{{route('user.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Resim sek</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="file" name="user_file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kullanici adi(email)</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="email" name="email">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>sifre</label>
                        <div class="row">
                            <div class="row col-xs-12">
                                <input class="form-control" type="password" name="password">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">

                        <div class="form-group">
                            <label>Durum</label>
                            <div class="row">
                                <div class="row col-xs-12">
                                    <select name="user_status" class="form-control">
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
