@extends('layouts.app')

@section('styles')
@endsection

@section('nav-title')
    Ubah Cashflow
@endsection

@section('content')
    <div class="min-h-screen min-w-full flex flex-col sm:justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">

                <form action="/cashflows/{{ $data['id'] }}" method="POST">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Judul
                        </label>
                        <input type="text" id="title" name="title" value="{{ $data['title'] }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan Judul Arus kas . ." required>
                    </div>
                    <div class="mb-6">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kategori
                        </label>

                        <select name="category" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}"
                                    {{ $category['id'] == $data['category_id'] ? 'selected' : '' }}>{{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="mb-6">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nominal
                        </label>
                        <input type="number" id="amount" name="amount" min="0" value="{{ $data['amount'] }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan nominal . ." required>
                    </div>
                    <div class="mb-6">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Jenis
                        </label>
                        <select name="type" id="type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            <option value="0" {{ !$data['type'] ? 'selected' : '' }}>Debit</option>
                            <option value="1" {{ $data['type'] ? 'selected' : '' }}>Kredit</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Waktu Transaksi
                        </label>
                        <input type="datetime-local" id="created_at" name="created_at" value="{{ $data['created_at'] }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
