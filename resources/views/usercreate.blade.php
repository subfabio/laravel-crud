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

                            <form method="POST" action="{{ route('save') }}" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <!-- Name -->
                                <div>
                                    <x-label for="name" :value="__('Name')" />

                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-label for="email" :value="__('Email')" />

                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-label for="password" :value="__('Password')" />

                                    <x-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password_confirmation" required />
                                </div>

                                <!-- Sélectionnez l'option Type Rol -->
                                 <div  class="mt-4">
                                    <x-label  for="role_id" value="{{__('Register as:')}}"/>
                                    <select name="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 round-md shadow -sm ">
                                        <option value="user">Utilisateur</option >
                                        <option value="admin">Administrateur</option>
                                        <option value="superadmin">SuperAdministrateur</option>
                                    </select>
                                </div >
                                <br>

                                <!-- File -->

                                    <div class="form-group">
                                      <label for="file">Choose Profile Image</label>
                                      <input type="file" name='file' class="form-control" onchange="previewFile(this)">
                                      <img id="previewImg" alt="profile image" style="max-width:130px;margin-top:20px;"/>
                                    </div>


                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900">
                                        {{ __('Already registered?') }}
                                    </a>

                                    <x-button type= submit class="ml-4">
                                        {{ __('register') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function previewFile(input){

                    var file = $("input[type = file]").get(0).files[0];
                    if(file)
                    {
                        var reader = new FileReader();
                        reader.onload = function(){

                            $('#previewImg').attr("src",reader.result);
                        }
                        reader.readAsDataURL(file);
                    }
                }
                </script>
</x-app-layout>
