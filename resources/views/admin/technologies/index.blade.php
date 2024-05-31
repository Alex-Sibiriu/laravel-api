@extends('layouts.admin')

@section('content')
  <div class="row pt-2 pb-5 px-5">

    <div class="col-12">
      @if (session('success'))
        <div class="alert alert-success" role="alert">
          <p>{{ session('success') }}</p>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger" role="alert">
          <p>{{ session('error') }}</p>
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>

    <div class="col-6">
      <div>
        <div class="rounded-3 bg-dark text-white px-3 pb-3">
          <h2 class="py-3 text-white text-center rounded-3 fw-bold fs-2 p-3 mt-3">Aggiungi una nuova tecnologia</h2>

          <form action="{{ route('admin.technologies.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Inserisci un nome*</label>
              <input type="text" id="title" name="name" class="form-control bg-secondary-subtle"
                value="{{ old('name') }}">
            </div>

            <button type="submit" class="btn btn-primary">Aggiungi Tecnologia</button>
          </form>
        </div>
      </div>

      <div class="px-2 bg-dark rounded-3 pb-1">
        <h2 class="py-3 text-white rounded-3 fw-bold fs-2 p-3 mt-3">Lista Tecnologie</h2>

        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th class="ps-3" scope="col">ID</th>
              <th class="w-50" scope="col">Nome</th>
              <th class="text-center" scope="col">Azioni</th>
            </tr>
          </thead>
          <tbody>

            @forelse ($tecnologies as $technology)
              <tr>
                <td class="ps-3">{{ $technology->id }}</td>

                <form action="{{ route('admin.technologies.update', $technology) }}" method="POST"
                  id="edit-tech-{{ $technology->id }}">
                  @csrf
                  @method('PUT')
                  <td class="align-content-center">
                    <input class="transparent-input" type="text" name="name" value="{{ $technology->name }}">
                  </td>
                </form>

                <td class="text-center">
                  <button type="submit" class="btn btn-warning me-2"
                    onclick="sendEdit(`edit-tech-{{ $technology->id }}`)">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST"
                    onsubmit="return confirm('Sei sicuro di voler eliminare {{ $technology->name }}?')"
                    class="d-inline-block">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                  </form>
                </td>

              </tr>
            @empty
              <h2>Nessuna Tecnologia trovata</h2>
            @endforelse

          </tbody>
        </table>
      </div>
    </div>

    <div class="col-6">
      <div>
        <div class="rounded-3 bg-dark text-white px-3 pb-3">
          <h2 class="py-3 text-white text-center rounded-3 fw-bold fs-2 p-3 mt-3">Aggiungi una nuovo tipo</h2>

          <form action="{{ route('admin.types.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Inserisci un nome*</label>
              <input type="text" id="title" name="name" class="form-control bg-secondary-subtle"
                value="{{ old('name') }}">
            </div>

            <button type="submit" class="btn btn-primary">Aggiungi Tipo</button>
          </form>
        </div>
      </div>

      <div class="px-2 bg-dark rounded-3 pb-1">
        <h2 class="py-3 text-white rounded-3 fw-bold fs-2 p-3 mt-3">Lista Tipi</h2>

        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th class="ps-3" scope="col">ID</th>
              <th class="w-50" scope="col">Nome</th>
              <th class="text-center" scope="col">Azioni</th>
            </tr>
          </thead>
          <tbody>

            @forelse ($types as $type)
              <tr>
                <td class="ps-3">{{ $type->id }}</td>

                <form action="{{ route('admin.types.update', $type) }}" method="POST"
                  id="edit-form-{{ $type->id }}">
                  @csrf
                  @method('PUT')
                  <td class="align-content-center">
                    <input class="transparent-input" type="text" name="name" value="{{ $type->name }}">
                  </td>
                </form>

                <td class="text-center">
                  <button type="submit" class="btn btn-warning me-2"
                    onclick="sendEdit(`edit-form-{{ $type->id }}`)">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <form action="{{ route('admin.types.destroy', $type) }}" method="POST"
                    onsubmit="return confirm('Sei sicuro di voler eliminare {{ $type->name }}?')"
                    class="d-inline-block">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                  </form>
                </td>

              </tr>
            @empty
              <h2>Nessun Tipo trovata</h2>
            @endforelse

          </tbody>
        </table>
      </div>
    </div>

  </div>

  <script>
    function sendEdit(id) {
      document.getElementById(id).submit();
    }
  </script>
@endsection
