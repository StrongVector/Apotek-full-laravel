@extends('layouts.template')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@section('content')

  @if(Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }}</div>
  @endif
  @if(Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }}</div>
  @endif

  <div class="d-flex flex-row-reverse mb-4">
    <a class="btn btn-secondary" href=" {{ route('user.create') }}" role="button">Tambah Pengguna</a>
  </div>
  
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @php $no = 1; @endphp
      @foreach ($Users as $data)
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $data['name'] }}</td>
          <td>{{ $data['email'] }}</td>
          <td>{{ $data['role'] }}</td>
          <td class="d-flex justify-content-center">
            <a href="{{ route('user.edit', $data['id']) }}" class="btn btn-primary me-3">Edit</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" id="" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$data['id']}}"> Hapus </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal-{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Data</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          Yakin Ingin Menghapus Data?
                          
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('user.delete', $data['id']) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                      </div>
                  </div>
              </div>
            </div>
            {{-- <form action="{{ route('user.delete', $data['id']) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form> --}}
          </td>       
        </tr>        
      @endforeach
    </tbody>
  </table>
@endsection