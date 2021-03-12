<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard for User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    Your name is: {{Auth::user()->name}} <br>
                    Your email address is: {{Auth::user()->email}} <br>
                    Your profil created_at: {{Auth::user()->created_at}} <br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
