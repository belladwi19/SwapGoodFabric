@extends('member.template.main')

@section('main-content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Saran atau Komplain</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('member.complaints.store') }}" method="POST">
                                        @csrf
                                        <h5>Silahkan isi form dibawah ini sesuai kriteria</h5>
                                        <div class="form-group">
                                            <select class="form-control" id="tipe" name="type">
                                                <option value="1">Saran</option>
                                                <option value="2">Komplain</option>
                                            </select>
                                        </div>
                                        <div class "form-group">
                                            <textarea class="form-control" id="form_sarankomplain" rows="4" name="body"></textarea>
                                        </div>
                                        <button class="btn btn-primary badge-pill float-right w-25" type="submit">Kirim</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h5>Telepon atau Chat:</h5>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Line</td>
                                                <td>@idline</td>
                                            </tr>
                                            <tr>
                                                <td>Whatsapp</td>
                                                <td>081999999</td>
                                            </tr>
                                            <tr>
                                                <td>Telepon</td>
                                                <td>(0361)123456</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Ketentuan: Hanya melayani saat jam kerja</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Riwayat Saran atau Komplain</h5>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Tipe</th>
                                        <th>Isi</th>
                                        <th>Balasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($complaintSuggestions as $complaintSuggestion)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d F Y', strtotime($complaintSuggestion->created_at)) }}</td>
                                            <td>
                                                @if ($complaintSuggestion->type == 1)
                                                    Saran
                                                @else
                                                    Komplain
                                                @endif
                                            </td>
                                            <td>{{ $complaintSuggestion->body }}</td>
                                            @if ($complaintSuggestion->reply == null)
                                                <td class="text-danger">
                                                    Belum ada balasan
                                                </td>
                                            @else
                                                <td>
                                                    {{ $complaintSuggestion->reply }}
                                                </td>
                                            @endif
                                            <td>
                                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal" data-url="{{ route('member.complaints.delete', ['id' => $complaintSuggestion->id]) }}">Hapus</a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('member.complaints.delete', ['id' => $complaintSuggestion->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{ $complaintSuggestion->id }}">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
@endsection
