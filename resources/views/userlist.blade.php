
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome Super Admin') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route("create")}}"> Nouvel Utilisateur</a>
                            </div>
                        </div>
                    </div>
                    <div class="tableau">
                        <table  data-toggle="table" data-pagination="true" data-search="true">
                          <thead class="allsize">
                                         <tr class="allsize">

                                             <th data-sortable="true" data-field="name">Name</th>
                                             <th data-sortable="true" data-field="email">Email</th>
                                             <th data-sortable="true" data-field="image">Image</th>
                                             <th data-sortable="true" data-field="created_at">Created</th>
                                             <th data-sortable="true" data-field="role_id">Role</th>
                                             <th>Show</th>
                                             <th>Edit</th>
                                             <th>Delete</th>
                                             <th>&nbsp;</th>
                                         </tr>
                          </thead>
                          <tbody>
                              @foreach ($users as $user)
                              <tr>

                                  <td>{{ $user->name }}</td>
                                  <td>{{ $user->email }}</td>
                                  <td><img src="{{ asset('images/')}}/{{ $user->profileimage}}" style="max-width:60%;"></td>
                                  <td>{{ $user->created_at }}</td>
                                  <td>

                                    @foreach ($user->getRoles() as $role)
                                    {{ $role->name }} <br>
                                    @endforeach


                              <td>
                                <a href="{{ url("dashboard/userlist/usershow", $user->id) }}" >
                                <button  class="btn btn-success">Show</button>
                                </a>
                                </td>

                              <td>
                                <a href="{{ url("dashboard/userlist/useredit", $user->id) }}" >
                                <button  class="btn btn-primary">Edit</button>
                                </a>
                                </td>


                                <td>
                                    <form action="{{ url("dashboard/userlist/".$user->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {!! method_field('DELETE') !!}
                                        <button class="btn btn-danger" onclick="return confirm ('Are you sure !')">Delete</button>
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
    </div>
</x-app-layout>

