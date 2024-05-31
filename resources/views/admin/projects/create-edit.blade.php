@extends('layouts.admin')

@section('content')
  <h1 class="py-5 text-white text-center mt-3 rounded-3 bg-gray">{{ $title }}</h1>

  <form class="row text-white fw-medium rounded-3 bg-gray p-5" enctype="multipart/form-data" action='{{ $route }}'
    method='POST'>
    @csrf
    @method($method)

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="m-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="col-6 mb-3">
      <label for="title" class="form-label">Titolo (*)</label>
      <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title"
        value="{{ old('title', $project?->title) }}">
      @error('title')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-6 mb-3">
      <label for="link" class="form-label">Link (*)</label>
      <input name="link" type="text" class="form-control @error('link') is-invalid @enderror" id="link"
        value="{{ old('link', $project?->link) }}">
      @error('link')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-6 mb-3">
      <label for="image" class="form-label">Caricare un' immagine</label>
      <input name="image" type="file" class="form-control" id="image" onchange="showImage(event)">
    </div>

    <div class="col-6 align-content-center">
      <label for="type_id" class="form-label m-0 pe-2">Seleziona una tipologia</label>
      <select name="type_id" id="type_id" class="p-1 rounded-2">
        <option value="">Nessuna Tipologia</option>
        @foreach ($types as $type)
          <option value="{{ $type->id }}" @if (old('type_id', $project?->type?->id) == $type->id) selected @endif>{{ $type->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-6 text-center mb-3 pt-3">
      <img src="{{ asset('storage/' . $project?->image) }}" onerror="this.src='{{ asset('img/no-image.png') }}'"
        id="thumb-img">
    </div>

    <div class="col-6 mb-3">
      <label for="description" class="form-label">Descrizione</label>
      <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
        rows="15">{{ old('description', $project?->description) }}</textarea>
      @error('description')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
      <p class="pe-2">Seleziona le tecnologie:</p>
      <div>
        @foreach ($technologies as $technology)
          <input type="checkbox" value="{{ $technology->id }}" name="technologies[]" class="btn-check"
            id="tech-{{ $technology->id }}" autocomplete="off" @if (
                ($errors->any() && in_array($technology->id, old('technologies', []))) ||
                    $project?->technologies->contains($technology)) checked @endif>

          <label class="btn btn-light btn-outline-primary fw-medium me-2"
            for="tech-{{ $technology->id }}">{{ $technology->name }}</label>
        @endforeach
      </div>
    </div>

    <div class="text-center pt-3">
      <button type="submit" class="btn btn-primary w-25 me-3">Invia</button>
      <button type="reset" class="btn btn-warning w-25">Reset</button>
    </div>
  </form>

  <script>
    function showImage(event) {
      const image = document.getElementById('thumb-img');
      image.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>
@endsection
