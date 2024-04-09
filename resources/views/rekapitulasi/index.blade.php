<x-app-layout title="Rekapitulasi">
    @section('title')
        <i class="fas fa-money-bill-alt"></i> Rekapitulasi
    @endsection

    @section('card-title')
        <div class="row">
            <div class="col">
                <label for="tanggal_awal">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
            </div>
            <div class="col">
                <label for="tanggal">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
            </div>
            <div class="col d-inline-flex align-items-end">
                <div class="input-group">
                    <button class="btn btn-primary" id="btnCariTransaksi">Cari</button>
                </div>
            </div>
        </div>
    @endsection

    {{-- table Rekapitulasi --}}
    <div class="tableRekapitulasi"></div>





    <script>
        $('#btnCariTransaksi').click(function(e) {
            e.preventDefault();
            tableRekapitulasi();
        });

        function tableRekapitulasi() {
            $.ajax({
                type: "get",
                url: "{{ route('rekapitulasi.table') }}",
                data: {
                    tanggal_awal: $('#tanggal_awal').val(),
                    tanggal_akhir: $('#tanggal_akhir').val(),
                },
                dataType: "json",
                success: function(response) {
                    $('.tableRekapitulasi').html(response.data);
                }
            });
        }


        $(document).ready(function() {
            tableRekapitulasi();
        });
    </script>
</x-app-layout>
