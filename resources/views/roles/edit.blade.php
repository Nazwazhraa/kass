@extends('layouts.app')

@section('nav-title')
    <a href="/roles">Roles /</a>
    Ubah Roles
@endsection

@section('content')
    <div class="min-h-screen min-w-full flex flex-col sm:justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">

                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Name
                        </label>
                        <input type="text" name="name" value="{{ $role->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="display_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Display Name
                        </label>
                        <input type="text" name="display_name" value="{{ $role->display_name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('display_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="permissions" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                            Permissions
                        </label>
                        <div class="container flex">
                            <div class="column flex-1">
                                <label for="permissions"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Categories
                                </label>
                                @foreach ($permissions->take(3) as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                            class="form-check-input">
                                        <label>{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="column flex-1">
                                <label for="permissions"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Cashflow
                                </label>
                                @foreach ($permissions->slice(3, 6) as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                            class="form-check-input">
                                        <label>{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('permissions')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
