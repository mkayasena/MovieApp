<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    You're logged in! <br>
                    {{Auth::user()->name}} <br>
                    id: {{Auth::user()->id}} <br>
                    Email Adresiniz: {{Auth::user()->email}} <br>
                    email_verified_at: {{Auth::user()->email_verified_at}} <br>
                    Şifreniz: {{Auth::user()->password}} <br>
                    remember_token: {{Auth::user()->remember_token}} <br>
                    created_at: {{Auth::user()->created_at}} <br>
                    updated_at: {{Auth::user()->updated_at}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
