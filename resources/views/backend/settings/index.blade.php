@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Settings</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Aciklama</th>
                        <th>Icerik</th>
                        <th>Acar soz</th>
                        <th>Type</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="sortable">
                    @foreach($data['adminSettings'] as $adminSettings)
                        <tr id="item-{{$adminSettings->id}}">
                            <td>{{$adminSettings->id}}</td>
                            <td class="sortable">{{$adminSettings['settings_description']}}</td>
                            <td>
                                @if($adminSettings['settings_type'] == 'file')
                                    <img width="100" src="/images/settings/{{$adminSettings['settings_value']}}">
                                @else
                                    {{$adminSettings['settings_value']}}
                                @endif
                            </td>
                            <td>{{$adminSettings->settings_key}}</td>
                            <td>{{$adminSettings->settings_type}}</td>
                            <td width="5">
                                <a href="{{route('settingsEdit', ['id' => $adminSettings->id])}}">
                                    <i class="fa fa-pencil-square"></i>
                                </a>
                            </td>
                            <td width="5">
                                @if($adminSettings->settings_delete)
                                    <a href="javascript: void(0)">
                                        <i id="@php echo $adminSettings->id @endphp" class="fa fa-trash-o"></i>
                                    </a>
                                @endif
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
                        url: "{{route('settingsSortable')}}",
                        success: function (msg) {
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
                    location.href = "/nedmin/settings/delete/" + destroy_id;
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
