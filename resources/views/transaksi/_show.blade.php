<!-- Modal -->
<div class="modal fade" id="showTransaksi" tabindex="-1" aria-labelledby="showTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTransaksiLabel">{{ $transaksi[0]->kode_transaksi }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><small>Jenis</small><br>{{ $transaksi[0]->jenis }} :
                        {{ $transaksi[0]->kategoriTransaksi->nama }} <br>
                        {{ $transaksi[0]->kategoriTransaksi->keterangan }}</li>
                    <li class="list-group-item">
                        <small>Mahasiswa</small><br>{{ $transaksi[0]->mahasiswa->nama }}
                        ({{ $transaksi[0]->nim_mahasiswa }}) <br> {{ $transaksi[0]->mahasiswa->alamat }} - Telp.
                        {{ $transaksi[0]->mahasiswa->no_telp }}
                    </li>
                    <li class="list-group-item">
                        <small>Total</small><br>{{ number_format($transaksi[0]->total, '0', ',', '.') }}
                    </li>
                    <li class="list-group-item"><small>Admin</small><br>{{ $transaksi[0]->users->name }}</li>
                    <li class="list-group-item">
                        <small>Tanggal</small><br>{{ $transaksi[0]->created_at->format('d F Y  h:i:s ') }}
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
