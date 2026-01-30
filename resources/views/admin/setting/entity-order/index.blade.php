@extends('layouts.app')

@section('title', 'Urutan Pengguna')
@section('content')
    <div class="card p-3">
        <div class="mb-3">
            <ul class="nav nav-tabs" id="roleTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $role == 'all' ? 'active' : '' }}"
                        href="{{ route('admin.setting.entity-order', ['role' => 'all']) }}" role="tab">
                        Semua
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $role == 'guru' ? 'active' : '' }}"
                        href="{{ route('admin.setting.entity-order', ['role' => 'guru']) }}" role="tab">
                        Guru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $role == 'tendik' ? 'active' : '' }}"
                        href="{{ route('admin.setting.entity-order', ['role' => 'tendik']) }}" role="tab">
                        Tendik
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $role == 'karyawan' ? 'active' : '' }}"
                        href="{{ route('admin.setting.entity-order', ['role' => 'karyawan']) }}" role="tab">
                        Karyawan
                    </a>
                </li>
            </ul>
        </div>

        <div class="table-responsive">
            <table class="table align-middle" id="draggableTable">
                <thead>
                    <tr>
                        <th scope="col" style="width: 50px;"></th>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Role</th>
                        <th scope="col">Urutan</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="sortableBody">
                    @forelse ($entityOrders as $entityOrder)
                        <tr data-user-id="{{ $entityOrder->user_id }}">
                            <td><i class="bi bi-grip-vertical handle" style="cursor: grab;"></i></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $entityOrder->user->name }}</td>
                            <td>
                                <span class="badge bg-success">{{ ucfirst($entityOrder->role) }}</span>
                            </td>
                            <td>
                                <input type="number" class="form-control form-control-sm order-input"
                                    data-user-id="{{ $entityOrder->user_id }}" value="{{ $entityOrder->order }}"
                                    style="width: 80px;">
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-success edit-manual"
                                    data-user-id="{{ $entityOrder->user_id }}" data-name="{{ $entityOrder->user->name }}"
                                    data-order="{{ $entityOrder->order }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 text-end">
            <button type="button" class="btn btn-success" id="saveOrderBtn">
                <i class="bi bi-save"></i> Simpan Urutan
            </button>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Simpan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyimpan urutan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmSaveBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        $(document).ready(function() {
            const sortable = new Sortable(document.getElementById('sortableBody'), {
                handle: '.handle',
                animation: 150,
                onEnd: function(evt) {
                    updateOrderNumbers();
                }
            });

            function updateOrderNumbers() {
                $('#sortableBody tr').each(function(index) {
                    $(this).find('td:eq(1)').text(index + 1);
                    const userId = $(this).data('user-id');
                    $('.order-input[data-user-id="' + userId + '"]').val(index + 1);
                });
            }

            $('#saveOrderBtn').on('click', function() {
                const orders = [];
                $('#sortableBody tr').each(function(index) {
                    const userId = $(this).data('user-id');
                    const orderValue = $('.order-input[data-user-id="' + userId + '"]').val();
                    orders.push({
                        user_id: userId,
                        order: parseInt(orderValue)
                    });
                });

                $('#confirmModal').modal('show');

                $('#confirmSaveBtn').one('click', function() {
                    $.ajax({
                        url: '{{ route('admin.setting.entity-order.bulk-update') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            orders: orders
                        },
                        success: function(response) {
                            $('#confirmModal').modal('hide');
                            alert('Urutan berhasil disimpan!');
                            location.reload();
                        },
                        error: function(xhr) {
                            $('#confirmModal').modal('hide');
                            alert('Terjadi kesalahan saat menyimpan urutan.');
                        }
                    });
                });
            });

            $('.order-input').on('change', function() {
                const userId = $(this).data('user-id');
                const newOrder = parseInt($(this).val());
                const $currentRow = $(this).closest('tr');
                const $tbody = $('#sortableBody');

                const $rows = $tbody.find('tr');
                let currentIndex = $rows.index($currentRow);

                if (newOrder > 0 && newOrder <= $rows.length) {
                    if (newOrder < currentIndex + 1) {
                        $rows.slice(newOrder - 1, currentIndex + 1).each(function() {
                            const rowUserId = $(this).data('user-id');
                            const input = $('.order-input[data-user-id="' + rowUserId + '"]');
                            input.val(parseInt(input.val()) + 1);
                        });
                    } else if (newOrder > currentIndex + 1) {
                        $rows.slice(currentIndex + 1, newOrder).each(function() {
                            const rowUserId = $(this).data('user-id');
                            const input = $('.order-input[data-user-id="' + rowUserId + '"]');
                            input.val(parseInt(input.val()) - 1);
                        });
                    }

                    $currentRow.detach();
                    const $newPositionRow = $rows.eq(newOrder - 1);
                    if ($currentRow[0] !== $newPositionRow[0]) {
                        $currentRow.insertBefore($newPositionRow);
                    } else {
                        $currentRow.insertAfter($newPositionRow);
                    }

                    updateOrderNumbers();
                }
            });
        });
    </script>
@endpush
