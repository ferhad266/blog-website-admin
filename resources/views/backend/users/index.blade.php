@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">User</h3>
                <div align="right"><a href="{{route('user.create')}}">
                        <button class="btn btn-success">Ekle</button>
                    </a></div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Ad Soyad</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="sortable">
                    @foreach($data['user'] as $user)
                        <tr id="item-{{$user->id}}">
                            <td class="sortable" width="150"><img width="150" src="/images/users/{{$user->user_file}}" alt=""></td>
                            <td >{{$user->name}}</td>
                            <td width="5">
                                <a href="{{route('user.edit', $user->id)}}">
                                    <i class="fa fa-pencil-square"></i>
                                </a>
                            </td>
                            <td width="5">
                                <a href="javascript: void(0)">
                                    <i id="@php echo $user->id @endphp" class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{route('userSortable')}}",
                        success: function (msg) {
                            // console.log();
                            if (msg) {
                                alertify.success('Succesfully changed.');
                            } else {
                                alertify.error('PROBLEM!');
                            }
                        }
                    });
                }
            });

            $('#sortable').disableSelection();

        });

        $('.fa-trash-o').click(function () {
            destroy_id = $(this).attr('id');

            alertify.confirm('Silme islemini onaylayin', 'Bu islem geri alinamaz',
                function () {

                    $.ajax({
                        type: "DELETE",
                        url: "user/" + destroy_id,
                        success: function (msg) {
                            if (msg) {
                                $('#item-' + destroy_id).remove();
                                alertify.success('Successfully deleted');

                            } else {
                                alertify.error('Not successfully deleted');
                            }
                        }
                    });

                },
                function () {
                    alertify.error('Not successfully deleted!');
                }
            )
        });
    </script>



@endsection
@section('css')

@endsection
@section('js')

@endsection
