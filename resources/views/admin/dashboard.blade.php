@extends('admin.layouts.app')
@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://raw.githubusercontent.com/JDilleen/datatables-bulma/master/css/dataTables.bulma.css">
@endsection
@section('content')
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <div class="title">Dashboard</div>
            </div>
        </div>
    </div>

    <div class="columns is-multiline">
        <div class="column">
            <div class="box notification is-primary">
                <div class="heading" style="text-align: center">Actived User / Inactive User</div>
                <div class="title" style="text-align: center">{{$userStatistic['activeUser']}} / {{$userStatistic['inactiveUser']}}</div>
                <div class="level">
                    @foreach ($userStatistic['mediaLogin'] as $media=>$value)
                    <div class="level-item">
                        <div class="">
                            <div class="heading">{{$media}}</div>
                            <div class="title is-5">{{$value}}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="column">
            <div class="box notification is-info">
                <div class="heading" style="text-align: center">Activated Product / Inactive Product</div>
                <div class="title" style="text-align: center">{{$productStatistic['activeProduct']}} / {{$productStatistic['inactiveProduct']}}</div>
                <div class="level">
                    @foreach ($productStatistic['productOnType'] as $type=>$value)
                        <div class="level-item">
                            <div class="">
                                <div class="heading">{{$type}}</div>
                                <div class="title is-5">{{$value}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="panel">
                <p class="panel-heading">Data User</p>
                <div class="panel-block">
                    <table id="userTabel" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Full Name</th>
                            <th>Login Media</th>
                            <th>Total Product</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://raw.githubusercontent.com/JDilleen/datatables-bulma/master/js/dataTables.bulma.min.js"></script>
<script type="text/javascript">
    $("#userTabel").DataTable({
        "ajax": {
            "url": "{{route('admin.users')}}",
            "type": "GET",
            "beforeSend": function(request){
                request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'))
            },
            "dataSrc": function(data){
                var userData = [];

                _.forEach(data, function (user){
                    var mediaLogin = '';
                    _.forEach(user.social, function(social){
                        mediaLogin += social.provider + ' ';
                    });
                    userData.push([
                        user.name,
                        user.full_name,
                        mediaLogin,
                        user.products.length,
                        user.created_at,
                        user.updated_at
                    ]);
                });

                return userData;
            }
        }
    });
</script>
@endsection