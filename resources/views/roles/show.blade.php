@extends('layouts.app')

@section('content')
    <div class="min-h-screen min-w-full flex flex-col sm:justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">

                <div class="mb-6">
                    <label for="title" class="block mb-2 text-sm font-semibold text-gray-900">
                        Name
                    </label>
                    <input type="text" id="title" name="title" value="{{ $role->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">
                        Display Name
                    </label>
                    <input type="text"  value=" {{ $role->display_name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">
                        Role Permissions
                    </label>
                    <div class="card">
                        <ul>
                            @foreach ($permissions as $permission)
                                <li class="ml-3 mt-0.5">{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="flex">
                    <a href="{{ route('roles.edit', $role->id) }}"
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Ubah</a>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                        style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
