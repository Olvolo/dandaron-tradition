<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-sky-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-sky-950">
                    {{ __("You're logged in!") }}

                    @if (Auth::user() && Auth::user()->isAdmin())
                        <div class="mt-4 border-t pt-4">
                            <div class="flex items-center space-x-4">
                                {{-- Ссылка в админ-панель --}}
                                <a href="{{ route('admin.dashboard') }}"
                                   class="inline-flex items-center px-4 py-2 bg-sky-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-800">
                                    Админ-панель
                                </a>
                                {{-- Ссылка на HTML Preview --}}
                                <a href="{{ url('/admin/sandbox/html-preview') }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                    HTML Preview
                                </a>
                                {{-- Ссылка на главную страницу сайта --}}
                                <a href="{{ route('home') }}"
                                   class="inline-flex items-center px-4 py-2 bg-white border border-sky-400 rounded-md font-semibold text-xs text-sky-800 uppercase tracking-widest hover:bg-sky-100">
                                    Главная страница сайта
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
