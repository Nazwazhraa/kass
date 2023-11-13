@extends('layouts.app')

@section('styles')
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/datatables.min.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/dataTables.tailwindcss.min.css">
    <style>
    </style>
@endsection

@section('nav-title')
    Cashflow
@endsection

@section('content')
    <div>
        <div>
            <div>

                <div class="mb-2 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                        data-tabs-toggle="#TabContent" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                                id="cashflow-tab" data-tabs-target="#cashflow" role="tab" aria-controls="cashflow"
                                aria-selected="false">
                                Cashflow
                            </button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                                id="category-tab" data-tabs-target="#category" role="tab" aria-controls="category"
                                @if (session()->has('cashflow_tab.tab')) @if (session()->get('cashflow_tab.tab') == 'category')
                                        aria-selected="true" @endif
                                @endif
                                >
                                Kategori
                            </button>
                        </li>
                    </ul>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="TabContent">
                    <!-- Cashflow -->
                    <div class="hidden ml-4 rounded-lg bg-white" id="cashflow" role="tabpanel"
                        aria-labelledby="cashflow-tab">
                        <div class="overflow-x-auto p-4">
                            <div class="min-w-max">

                                <div class="flex flex-wrap mb-2">
                                    <div class="mr-6">
                                        <!-- Isi kolom 1 di sini -->
                                        <a href="/cashflows/create" class="relative inline-block font-medium group mb-2">
                                            <span
                                                class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                            <span
                                                class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                            <span
                                                class="px-3.5 py-2 flex items-center justify-center relative text-black group-hover:text-white">
                                                <svg class="h-6 w-6 text-black" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <circle cx="12" cy="12" r="9" />
                                                    <line x1="9" y1="12" x2="15" y2="12" />
                                                    <line x1="12" y1="9" x2="12" y2="15" />
                                                </svg>
                                                <span class=" relative text-black group-hover:text-white ml-2">Add
                                                    New</span>
                                        </a>
                                    </div>
                                    <div class="mr-6">
                                        <!-- Isi kolom 2 di sini -->
                                        <button class="relative inline-block font-medium group mb-2" id="cashflow-bulk-delete-btn">
                                            <span
                                                class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                            <span
                                                class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                            <span
                                                class="px-3.5 py-2 flex items-center justify-center relative text-black group-hover:text-white">
                                                <svg class="h-6 w-6 text-black" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                </svg>
                                                <span class=" relative text-black group-hover:text-white ml-2">Bulk
                                                    Delete</span>
                                        </button>
                                    </div>
                                    <div class="mr-6">
                                        <a href="/export-pdf">
                                            <button class="relative inline-block font-medium group mb-2 ">
                                                <span
                                                    class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                                <span
                                                    class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                                <span
                                                    class="px-3.5 py-2 flex items-center justify-center relative text-black group-hover:text-white">
                                                    <svg class="h-6 w-6 text-black" width="24" height="24"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4" />
                                                        <line x1="12" y1="13" x2="12"
                                                            y2="22" />
                                                        <polyline points="9 19 12 22 15 19" />
                                                    </svg>
                                                    <span
                                                        class=" relative text-black group-hover:text-white ml-2">Export</span>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="mr-6">
                                        <button class="relative inline-block font-medium group mb-2 "
                                            data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                                            <span
                                                class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                            <span
                                                class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                            <span
                                                class="px-3.5 py-2 flex items-center justify-center relative text-black group-hover:text-white">
                                                <svg class="h-6 w-6 text-black" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <path
                                                        d="M7 18a4.6 4.4 0 0 1 0 -9h0a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                                    <polyline points="9 15 12 12 15 15" />
                                                    <line x1="12" y1="12" x2="12" y2="21" />
                                                </svg>
                                                <span
                                                    class=" relative text-black group-hover:text-white ml-2">Import</span>
                                        </button>
                                    </div>
                                </div>
                                <table id="cashflow-table" class="table-auto"></table>
                            </div>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="hidden ml-4 rounded-lg bg-white" id="category" role="tabpanel"
                        aria-labelledby="category-tab">
                        <div class="overflow-x-auto p-4">
                            <div class="min-w-max">
                                
                                <div class="flex flex-wrap mb-2">
                                    <div class="mr-6">
                                        <!-- Isi kolom 1 di sini -->
                                        <a href="/categories/create" class="relative inline-block font-medium group mb-2">
                                            <span
                                                class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                            <span
                                                class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                            <span
                                                class="px-3.5 py-2 flex items-center justify-center relative text-black group-hover:text-white">
                                                <svg class="h-6 w-6 text-black" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <circle cx="12" cy="12" r="9" />
                                                    <line x1="9" y1="12" x2="15" y2="12" />
                                                    <line x1="12" y1="9" x2="12" y2="15" />
                                                </svg>
                                                <span class=" relative text-black group-hover:text-white ml-2">Add
                                                    New</span>
                                        </a>
                                    </div>
                                    <div class="mr-6">
                                        <!-- Isi kolom 2 di sini -->
                                        <button class="relative inline-block font-medium group mb-2" id="category-bulk-delete-btn">
                                            <span
                                                class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                            <span
                                                class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                            <span
                                                class="px-3.5 py-2 flex items-center justify-center relative text-black group-hover:text-white">
                                                <svg class="h-6 w-6 text-black" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                </svg>
                                                <span class=" relative text-black group-hover:text-white ml-2">Bulk
                                                    Delete</span>
                                        </button>
                                    </div>
                                </div>
                                <table id="category-table" class="table-auto"></table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="popup-modal" tabindex="-1"
                    class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(80%)] w-[calc(80%)] max-h-full max-w-[calc(80%)] mx-auto">
                    <div class="relative w-full max-w-md max-h-screen mx-auto">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-4">
                            <button type="button"
                                class="absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-10 h-10 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="popup-modal">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 text-center">
                                <!-- Masukkan input file dan tombol di bawah ini -->
                                <form action="/upload" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input"></label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input" type="file" name="pdf_file">

                                    <button type="submit"
                                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm w-full py-2 mt-2">
                                        Unggah PDF
                                    </button>
                                </form>
                                <!-- Akhir dari input file dan tombol -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.tailwindcss.min.js"></script>
    <script src="/js/cdn.tailwindcss.com_3.3.3.js"></script>
    <script src="/js/cashflow/index.js"></script>
@endsection
