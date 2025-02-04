<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <x-slot:role>{{ $role }}</x-slot:role>

  <div class="container-fluid">
    <div class="col-xl-12 col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <h5 class="mt-2 font-weight-bold text-primary"> <b style="color: rgba(1, 67, 56, 0.8);"> Pengambilan Nilai Optimasi </b></h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table border="border-left-info" class="table table-bordered table-sm table-striped table-hover" id="sortdisable" width="100%" cellspacing="0">
                    <thead align="center" class="thead-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Alternatif</th>
                            <th>Nilai Optimasi</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                      {{-- loop hasil optimasi --}}
                      @foreach ($optimasi as $key => $value)
                          <tr>
                            <td>{{ $alternatif[$key][1] }}</td>
                            <td>{{ 'A' . $alternatif[$key][0] }}</td>
                            <td>{{ $value }}</td>
                          </tr>
                      @endforeach
                      {{-- end loop --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-layout>

<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.js') }}"></script>
<script>
    $('#sortdisable').dataTable({
        "ordering": false
    });
</script>
