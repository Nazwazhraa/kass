@extends('layouts.app')

@section('nav-title')
    Roles
@endsection

@section('content')
    <div class="container p-4">

        @if (Session::has('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <svg class="w-5 h-5 text-black fill-current hover:text-white" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title class="sr-only">Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div id="error-alert" class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <svg class="w-5 h-5 text-black fill-current hover:text-white" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title class="sr-only">Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="flex flex-wrap mb-4">
            <div class="mr-6">
                <a href="{{ route('roles.create') }}" class="relative inline-block font-medium group mb-2">
                    <span
                        class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                    <span class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                    <span class="px-3.5 py-2 flex items-center justify-center relative text-black group-hover:text-white">
                        <svg class="h-6 w-6 text-black" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="12" cy="12" r="9" />
                            <line x1="9" y1="12" x2="15" y2="12" />
                            <line x1="12" y1="9" x2="12" y2="15" />
                        </svg>
                        <span class=" relative text-black group-hover:text-white ml-2">Add New</span>
                </a>
            </div>
            <div>
                <a href="#" class="relative inline-block font-medium group mb-2" id="deleteAllSelectedRecord">
                    <span
                        class="absolute inset-0 w-full h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                    <span class="absolute inset-0 w-full h-full bg-white border-2 border-black group-hover:bg-black"></span>
                    <span class="px-3.5 py-2 flex items-center justify-center relative text-black group-hover:text-white">
                        <svg class="h-6 w-6 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                            <line x1="10" y1="11" x2="10" y2="17" />
                            <line x1="14" y1="11" x2="14" y2="17" />
                        </svg>
                        <span class=" relative text-black group-hover:text-white ml-2">Bulk Delete</span>
                </a>
            </div>
        </div>

        <div class="flex justify-between">
            <form action="{{ route('roles.index') }}" method="GET" class="py-2">
                <label for="perPage">Show</label>
                <select name="perPage" id="perPage" class="rounded">
                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                </select>
                <button type="submit">Entires</button>
            </form>
            <form action="{{ route('roles.index') }}" method="GET" class="py-2">
                <input type="text" name="search" placeholder="Search roles" value="{{ request('search') }}"
                    class="rounded p-2 border border-gray-300">
                <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg ml-2">Search</button>
            </form>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left border-2 border-gray-200">
                <colgroup>
                    <col style="width: 5%;">
                    <col style="width: 15%;">
                    <col style="width: 15%;">
                    <col style="width: 35%;">
                    <col style="width: 30%;">
                </colgroup>
                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="pl-4"><input type="checkbox" name="" id="select_all_ids"></th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Display Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Permissions
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" id="roles_ids{{ $role->id}}">
                            <td class="pl-4">
                                <input type="checkbox" name="ids" class="checkbox_ids" value="{{$role->id}}">
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $role->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $role->display_name }}
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($role->permissions as $permission)
                                    {{ $permission->name }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('roles.show', $role->id) }}"
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover-bg-green-700 dark:focus:ring-green-800">Lihat</a>
                                <a href="{{ route('roles.edit', $role->id) }}"
                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Ubah</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover-bg-red-700 dark:focus:ring-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="flex justify-between">
            <div class="py-3">
                <div class="text-gray-600 text-sm mt-4">
                    Showing {{ ($roles->currentPage() - 1) * $roles->perPage() + 1 }} to
                    {{ ($roles->currentPage() - 1) * $roles->perPage() + $roles->count() }} of {{ $roles->total() }}
                    entries
                </div>
            </div>
            <div class="py-3">
                <div class="btn-group">
                    @if ($roles->onFirstPage())
                        <span
                            class="disabled bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">Previous</span>
                    @else
                        <a href="{{ $roles->previousPageUrl() }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">Previous</a>
                    @endif

                    @for ($i = 1; $i <= $roles->lastPage(); $i++)
                        <a href="{{ $roles->url($i) }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4  {{ $i == $roles->currentPage() ? 'current' : '' }}">{{ $i }}</a>
                    @endfor

                    @if ($roles->hasMorePages())
                        <a href="{{ $roles->nextPageUrl() }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">Next</a>
                    @else
                        <span
                            class="disabled bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">Next</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(e){
            $("#select_all_ids").click(function(){
                $('.checkbox_ids').prop('checked',$(this).prop('checked'));
            });

            $('#deleteAllSelectedRecord').click(function(e){
                e.preventDefault();
                var all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function(){
                    all_ids.push($(this).val());
                });

                $.ajax({
                    url:"{{ route('roles.delete') }}",
                    type:"DELETE",
                    data:{
                        ids:all_ids,
                        _token:'{{ csrf_token() }}'
                    },
                    success:function(response){
                        $.each(all_ids,function(key,val){
                            $('#roles_ids' + val).remove();
                        })
                    }
                });
            });
        });
    </script>
@endsection
