let cashflowTable;
let categoryTable;

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
    SwalConfirm(null, `Apakah anda yakin ingin menghapus ${title}?`)
        .then(e => {
            if (e)
                $(`form[value="cashflow${id}"]`)[0].submit();
        });
}

function cashflowBulkDelete() {
    $.post('/cashflows/bulk-delete',
        {
            '_token': $('meta[name="_token"]').attr('content'),
            'data': Array.from($(`input[name="cashflow_checkbox"]:checked`), (e) => { return e.value })
        },
        function (result) {
            if (result > 0)
                Swal.fire({
                    icon: `success`,
                    text: `Berhasil menghapus ${result} data.`
                });
            else
                Swal.fire({
                    icon: `warning`,
                    text: `Tidak ada data yang dapat dihapus.`
                });
            cashflowTable.ajax.reload();
        });
}

function categoryBulkDelete() {
    $.post('/categories/bulk-delete',
        {
            '_token': $('meta[name="_token"]').attr('content'),
            'data': Array.from($(`input[name="category_checkbox"]:checked`), (e) => { return e.value })
        },
        function (result) {
            if (result > 0)
                Swal.fire({
                    icon: `success`,
                    text: `Berhasil menghapus ${result} kategori.`
                });
            else
                Swal.fire({
                    icon: `warning`,
                    text: `Tidak ada kategori yang dapat dihapus.`
                });
            categoryTable.ajax.reload();
        });
}

function categoryDelete(id, title) {
    SwalConfirm(null, `Apakah anda yakin ingin menghapus ${title}?`)
        .then(e => {
            if (e)
                $(`form[value="category${id}"]`)[0].submit();
        });
}

let cashflowAction = {
    showBtn: (data) => {
        return `<a href="/cashflows/${data.id}" class="mx-0.5 bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 active:bg-green-700 focus:ring-4 focus:ring-green-200">lihat</a>`;
    },
    editBtn: (data) => {
        return `<a href="/cashflows/${data.id}/edit" class="mx-0.5 bg-yellow-400 text-black px-3 py-2 rounded-lg hover:bg-yellow-500 active:bg-yellow-500 focus:ring-4 focus:ring-yellow-100">ubah</a>`;
    },
    deleteBtn: (data) => {
        return `<a href="javascript:cashflowDelete(${data.id}, '${data.title}')" class="mx-0.5 bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 active:bg-red-700 focus:ring-4 focus:ring-red-300">hapus</a>` +
            `<form class="hidden" value="cashflow${data.id}" method="post" action="/cashflows/${data.id
            }"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="${$('meta[name="_token"]').attr('content')
            }"></form>`;
    }
};

let categoryAction = {
    showBtn: (data) => {
        return `<a href="/categories/${data.id}" class="mx-0.5 bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 active:bg-green-700 focus:ring-4 focus:ring-green-200">lihat</a>`;
    },
    editBtn: (data) => {
        return `<a href="/categories/${data.id}/edit" class="mx-0.5 bg-yellow-400 text-black px-3 py-2 rounded-lg hover:bg-yellow-500 active:bg-yellow-500 focus:ring-4 focus:ring-yellow-100">ubah</a>`;
    },
    deleteBtn: (data) => {
        return `<a class="mx-0.5 bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 active:bg-red-700 focus:ring-4 focus:ring-red-300" href="javascript:categoryDelete(${data.id}, '${data.name}')">hapus</a>` +
            `<form class="hidden" value="category${data.id}" onsubmit="return confirm('Apakah anda yakin ingin menghapus ${data.name
            }')" method="post" action="/categories/${data.id
            }"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="${$('meta[name="_token"]').attr('content')
            }"></form>`;
    }
};

$(function () {
    $('#cashflow-bulk-delete-btn').on('click', () => {
        if (Array.from($(`input[name="cashflow_checkbox"]:checked`), (e) => { return e.value }).length <= 0)
            Swal.fire({
                icon: 'warning',
                text: 'Anda belum memilih cashflow.',
            });
        else {
            SwalConfirm(null, `Apakah Anda yakin ingin menghapus yang anda pilih?`)
                .then((e) => {
                    if (e)
                        cashflowBulkDelete();
                });
        }
    });
    $('#category-bulk-delete-btn').on('click', () => {
        if (Array.from($(`input[name="category_checkbox"]:checked`), (e) => { return e.value }).length <= 0)
            Swal.fire({
                icon: 'warning',
                text: 'Anda belum memilih kategori.',
            });
        else {
            SwalConfirm(null, `Apakah Anda yakin ingin menghapus kategori yang anda pilih?`)
                .then((e) => {
                    if (e)
                        categoryBulkDelete();
                });
        }
    });

    cashflowTable = $('#cashflow-table').DataTable({
        ajax: {
            url: '/api/v1/cashflows',
            dataSrc: ''
        },
        columns: [
            {
                title: '',
                render: (data, type, full) => {
                    return `<input type="checkbox" name="cashflow_checkbox" value="${full['id']
                        }">`;
                },
                bSearchable: false,
                bSortable: false
            },
            { data: 'title', title: 'Judul' },
            {
                render: (data, type, full) => {
                    return `<a class="text-blue-600 hover:underline hover:text-blue-700" href="/categories/${full['category_id']}">${full['category']}</a>`;
                },
                title: 'Kategori'
            },
            {
                render: (data, type, full) => {
                    return rupiah(full['amount']);
                },
                title: 'Nominal'
            },
            {
                render: (data, type, full) => {
                    return full['type'] ? 'kredit' : 'debit';
                },
                title: 'Jenis'
            },
            { data: 'created_at', title: 'Waktu Transaksi' },
            {
                render: (data, type, full) => {
                    return `<div class="flex">` +
                        `${cashflowAction.showBtn(full) +
                        cashflowAction.editBtn(full) +
                        cashflowAction.deleteBtn(full)
                        }` +
                        `</div>`;
                },
                title: 'Aksi',
                bSearchable: false,
                bSortable: false
            },
        ],
        order: [5, 'desc'],
        autoWidth: false
    });

    categoryTable = $('#category-table').DataTable({
        ajax: {
            url: '/api/v1/categories',
            dataSrc: ''
        },
        columns: [
            {
                render: (data, type, full) => {
                    return `<input type="checkbox" name="category_checkbox" value="${full['id']}">`;
                },
                title: '',
                bSearchable: false,
                bSortable: false
            },
            { data: 'name', title: 'Nama' },
            { data: 'created_at', title: 'Waktu dibuat' },
            {
                render: (data, type, full) => {
                    return (!!full['updated_at']) ? full['updated_at'] : '<span class="hidden">0</span>Belum diubah';
                },
                title: 'Waktu diubah'
            },
            {
                render: (data, type, full) => {
                    return `<div class="flex">` +
                        `${categoryAction.showBtn(full) +
                        categoryAction.editBtn(full) +
                        categoryAction.deleteBtn(full)}` +
                        `</div>`;
                },
                title: 'Aksi',
                bSearchable: false,
                bSortable: false
            },
        ],
        order: [2, 'desc'],
        autoWidth: false
    });
});
