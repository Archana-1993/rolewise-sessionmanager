@extends('sessionmanager::layouts.app')

@section('sessionmanager::content')
<div class="container mt-5">
    <h1 class="text-center">Roles</h1>
    <div class="row d-flex mb-3">
        <div class="col-md-3 flex-fill">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title">
                        <div>Available Roles</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-text table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Role</th>
                                    <th scope="col">Session Timeout</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $infokey => $role)
                                    <tr class="available_name" data-name="{{ $role->id }}">
                                        <td>
                                            {{ $role->name }}
                                        </td>
                                        <td>
                                            <input type="text" name="" value="{{ $role->session_lifetime }}" />
                                        </td>
                                        <td>
                                            <input type="button" class="update_session" value="Update">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('sessionmanager::script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.update_session').click(function () {
            var row = $(this).closest('tr');
            var roleId = row.data('name');
            var sessionLifetime = row.find('input[type="text"]').val();

            $.ajax({
                url: "{{ route('sessionmanager.updateSession') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    role_id: roleId,
                    session_lifetime: sessionLifetime
                },
                success: function (response) {
                    alert(response.success);
                },
                error: function (xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        });
    });
</script>
@endsection
