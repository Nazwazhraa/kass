@extends('layouts.app')

@section('styles')
@endsection

@section('nav-title')
    Tampilkan Kategori
@endsection

@section('content')
    <div class="min-h-screen min-w-full flex flex-col justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Kategori
                    </label>
                    <input type="text" id="name" name="name" value="{{ $category['name'] }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Waktu Dibuat
                    </label>
                    <input type="text" id="created_at" name="created_at" value="{{ $category['created_at'] }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label for="updated_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Waktu diubah
                    </label>
                    <input type="text" id="updated_at" name="updated_at"
                        value="{{ !!$category['updated_at'] ? $category['updated_at'] : 'Belum diubah' }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="flex">
                    <a href="/cashflows/{{ $category['id'] }}/edit"
                        class="mx-0.5 bg-yellow-300 text-black px-3 py-2 rounded-lg hover:bg-yellow-400 active:bg-yellow-400 focus:ring-4 focus:ring-yellow-100">ubah</a>
                    <a href="#" id="deleteBtn"
                        class="mx-0.5 bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 active:bg-red-700 focus:ring-4 focus:ring-red-300">hapus</a>
                    <a href="#" id="forceDeleteBtn"
                        class="mx-0.5 bg-opacity-0 bg-red-500 text-red-600 px-3 py-2 rounded-lg border-1 hover:border-1 hover:border-red-600 border-red-600 hover:text-white hover:bg-red-700 active:bg-red-700 focus:ring-4 focus:ring-red-300">hapus
                        paksa</a>

                    <form class="hidden" method="post" action="/categories/{{ $category['id'] }}"
                        value="{{ $category['id'] }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                    <form class="hidden" id="forceDeleteForm" method="post"
                        action="/categories/force/{{ $category['id'] }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        async function SwalConfirm(title, text) {
            let status = null;
            await Swal.fire({
                icon: 'question',
                title,
                text,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((e) => {
                status = e.isConfirmed;
            });
            return status;
        }

        function categoryDelete(id, name) {
            SwalConfirm(null, `Apakah anda yakin ingin menghapus ${name}?`)
                .then(e => {
                    if (e)
                        $(`form[value="${id}"]`)[0].submit();
                });
        }

        function categoryForceDelete(id, name) {
            SwalConfirm(null,
                    `Apakah anda yakin ingin menghapus ${name} secara paksa?\nJika anda menghapus kategori secara paksa maka cashflow yang terhubung akan ikut terhapus.`
                    )
                .then(e => {
                    if (e)
                        $(`form#forceDeleteForm`)[0].submit();
                });
        }

        $(function() {
            $('#deleteBtn').on('click', () => {
                categoryDelete({{ $category['id'] }}, '{{ $category['name'] }}');
            });

            $('#forceDeleteBtn').on('click', () => {
                categoryForceDelete({{ $category['id'] }}, '{{ $category['name'] }}');
            });
        });
    </script>
@endsection
