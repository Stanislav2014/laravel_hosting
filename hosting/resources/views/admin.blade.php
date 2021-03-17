@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="absolute top-0 right-0 mt-4 mr-4">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                        >
                            Log out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a
                            href="{{ route('admin.log') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                        >
                            Admin panel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="flex items-center justify-center">
            <div class="row">
                @if (!count($logs))
                    Empty logs
                @else
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">endpoint</th>
                        <th scope="col">verb</th>
                        <th scope="col">request</th>
                        <th scope="col">response</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($logs as $log)
                        <tr>
{{--                            <th scope="row">{{ $domain->id }}</th>--}}
                            <td>{{ $log->endpoint }}</a></td>
                            <td>{{ $log->verb }}</td>
                            <td>{{ $log->request }}</td>
                            <td>{{ $log->response }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a
                    href="{{ route('admin.log.clear') }}"
                    onclick="event.preventDefault(); document.getElementById('logclear-form').submit();"
                    class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                >
                    Log Clear
                </a>

                <form id="logclear-form" action="{{ route('admin.log.clear') }}" method="POST" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
