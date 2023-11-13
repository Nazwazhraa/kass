@extends('layouts.app')

@section('styles')
@endsection

@section('nav-title')
    Tambah Kategori
@endsection

@section('content')
    <div class="min-h-screen min-w-full flex flex-col justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <svg class="w-5 h-5 text-black fill-current hover:text-white" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <title class="sr-only">Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </button>
                    </div>
                @endif

                <form action="/categories" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Kategori
                        </label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan nama kategori . ." required>
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Tambah</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
