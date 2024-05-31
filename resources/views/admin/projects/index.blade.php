@extends('layouts.admin')

@section('content')
  <div class="row pt-2 pb-5 px-5">

    <div class="col-12">
      @if (session('success'))
        <div class="alert alert-success" role="alert">
          <p class="m-0">{{ session('success') }}</p>
        </div>
      @endif
    </div>

    <div class="col-12">
      <div class="px-2 bg-dark rounded-3 pb-1">
        <h2 class="py-3 text-white rounded-3 fw-bold fs-2 p-3 mt-3">Progetti Trovati: <span
            class="text-primary">{{ $num_projects }}</span></h2>
        @if ($search_project)
          <p class="fs-4 ps-3 text-white"><strong>Parametro di ricerca: </strong><span
              class="text-primary">{{ $search_project }}</span></p>
        @endif

        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th class="ps-3 id-column" scope="col">
                <a class="text-white text-decoration-none"
                  href="{{ route('admin.projects.index', ['column' => 'id', 'direction' => $direction, 'search_project' => $search_project]) }}">ID
                  @if (isset($column) && $column === 'id')
                    <span class="ps-1 text-primary">
                      @if ($direction === 'DESC')
                        <i class="fa-solid fa-down-long"></i>
                      @else
                        <i class="fa-solid fa-up-long"></i>
                      @endif
                    </span>
                  @else
                    <i class="fa-solid fa-arrows-up-down"></i>
                  @endif
                </a>

              </th>
              <th scope="col">
                <a class="text-white text-decoration-none"
                  href="{{ route('admin.projects.index', ['column' => 'title', 'direction' => $direction, 'search_project' => $search_project]) }}">Titolo

                  @if (isset($column) && $column === 'title')
                    <span class="ps-1 text-primary">
                      @if ($direction === 'DESC')
                        <i class="fa-solid fa-down-long"></i>
                      @else
                        <i class="fa-solid fa-up-long"></i>
                      @endif
                    </span>
                  @else
                    <i class="fa-solid fa-arrows-up-down"></i>
                  @endif
                </a>

              </th>
              <th scope="col">Link</th>
              <th class="text-center" scope="col">Tecnologie</th>
              <th class="text-center" scope="col">
                <a class="text-white text-decoration-none"
                  href="{{ route('admin.projects.index', ['column' => 'type_id', 'direction' => $direction, 'search_project' => $search_project]) }}">Tipo

                  @if (isset($column) && $column === 'type_id')
                    <span class="ps-1 text-primary">
                      @if ($direction === 'DESC')
                        <i class="fa-solid fa-down-long"></i>
                      @else
                        <i class="fa-solid fa-up-long"></i>
                      @endif
                    </span>
                  @else
                    <i class="fa-solid fa-arrows-up-down"></i>
                  @endif
                </a>

              </th>
              <th class="text-center" scope="col">Azioni</th>
            </tr>
          </thead>
          <tbody>

            @forelse ($projects as $project)
              <tr>
                <td class="ps-3">{{ $project->id }}</td>

                <td class="align-content-center">
                  {{ $project->title }}
                </td>
                <td class="align-content-center">
                  {{ $project->link }}
                </td>

                <td class="align-content-center text-center">
                  @forelse ($project->technologies as $technology)
                    <a class="text-decoration-none" href="{{ route('admin.technologies.show', $technology) }}">
                      <span class="badge rounded-pill fs-6 ms-1 text-bg-primary">{{ $technology->name }}</span>
                    </a>
                  @empty
                    <span class="badge rounded-pill fs-6 text-bg-warning">Nessuna Tecnologia Associata</span>
                  @endforelse
                </td>

                <td class="align-content-center text-center">
                  @if ($project->type)
                    <a class="badge text-bg-success text-decoration-none fs-6"
                      href="{{ route('admin.types.show', $project->type) }}">
                      {{ $project->type->name }}
                    </a>
                  @else
                    ---
                  @endif
                </td>

                <td class="text-center">
                  <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-info me-2">
                    <i class="fa-solid fa-eye"></i>
                  </a>

                  <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning me-2">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>

                  <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                    onsubmit="return confirm('Sei sicuro di voler eliminare {{ $project->title }}?')"
                    class="d-inline-block">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                  </form>
                </td>

              </tr>
            @empty
              <h2>Nessun Progetto trovato</h2>
            @endforelse

          </tbody>
        </table>
        {{ $projects->links() }}
      </div>
    </div>
  </div>
@endsection
