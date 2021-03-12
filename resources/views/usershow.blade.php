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
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-left">
                                        <a class="btn btn-primary" href="{{ route('dashboard.userlist') }}"> Back</a>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <td><img src="{{ asset('images/')}}/{{ $user->profileimage}}" style="max-width:60%;"></td>
                            <br>


                                <h1>Name: {{$user->name}}</h1>
                                <br>
                                <h1>Email: {{$user->email}}</h1>
                                <br>
                                <h1>Created at: {{$user->created_at}}</h1>
                                <br>
                                <h1>Role User:
                                    @foreach ($user->getRoles() as $role)
                                    {{ $role->name }} <br>
                                    @endforeach
                                </h1>







                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
