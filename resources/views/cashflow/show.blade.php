@extends('layouts.app')

@section('styles')
@endsection

@section('nav-title')
    Tampilkan Cashflow
@endsection

@section('content')
    <div class="min-h-screen min-w-full flex flex-col sm:justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">

                <div class="mb-6">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                        Judul
                    </label>
                    <input type="text" id="title" name="title" value="{{ $data['title'] }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Masukkan Judul Arus kas . ." readonly>
                </div>
                <div class="mb-6">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">
                        Kategori
                    </label>
                    <input type="text" id="category" name="category" value="{{ $category['name'] }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">
                        Nominal
                    </label>
                    <input type="text" id="amount" name="amount" value="{{ $data['amount'] }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900">
                        Jenis
                    </label>
                    <input type="text" id="type" name="type" value="{{ $data['type'] ? 'kredit' : 'debit' }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900">
                        Waktu Transaksi
                    </label>
                    <input type="text" id="created_at" name="created_at" value="{{ $data['created_at'] }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label for="updated_at" class="block mb-2 text-sm font-medium text-gray-900">
                        Diubah pada
                    </label>
                    <input type="text" id="updated_at" name="updated_at"
                        value="{{ !!$data['updated_at'] ? $data['updated_at'] : 'Belum diubah' }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="flex">
                    <a href="/cashflows/{{ $data['id'] }}/edit"
                        class="mx-0.5 bg-yellow-300 text-black px-3 py-2 rounded-lg hover:bg-yellow-400 active:bg-yellow-400 focus:ring-4 focus:ring-yellow-100">ubah</a>
                    <a href="#" id="deleteBtn"
                        class="mx-0.5 bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 active:bg-red-700 focus:ring-4 focus:ring-red-300">hapus</a>

                    <form class="hidden"
                        method="post" action="/cashflows/{{ $data['id'] }}" value="{{ $data['id'] }}"><input
                            type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token"
                            value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function rupiah(number) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }

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

        function cashflowDelete(id, title) {
            SwalConfirm(null, `Apakah anda yakin ingin menghapus ${title}`)
                .then(e => {
                    if (e)
                        $(`form[value="${id}"]`)[0].submit();
                });
        }

        $(function() {
            $('#amount')[0].value = rupiah({{ $data['amount'] }});
            $('#deleteBtn').on('click', () => {
                cashflowDelete({{ $data['id'] }}, '{{ $data['title'] }}');
            });
        });
    </script>
@endsection
