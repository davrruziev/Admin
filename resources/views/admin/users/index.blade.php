@extends('admin.layouts.main')
@section('section')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0" >
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
{{--                            @if(\Auth::user()->hasRole('admin') && $user->hasRole('admin')) @continue; @endif--}}
                            <tr {{ Auth::user()->id == $user->id ? 'bgcolor=#ddd' : '' }}>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->roles != null)
                                        @foreach($user->roles  as $role)
                                            <span class=" badge badge-secondary">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    @endif
                                </td>
                                <td> @if($user->permissions != null)
                                        @foreach($user->permissions  as $permission)
                                            <span class=" badge badge-secondary">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    @endif</td>
                                <td>
                                    <form action="{{ route('users.destroy', ['user' => $user]) }}" method="post">
                                  <span>
                                      <a href="{{ route('users.edit', ['user'=>$user]) }}" class="text-info"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                  </span>
                                        @method('delete')
                                        @csrf
                                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                            <i class="fas fa-trash  text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
