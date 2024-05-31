@extends('layouts.admin')

@section('content')
  <div class="p-5">

    <div class="row row-cols-2">

      <div class="col mb-3">
        <div
          class="card p-5 rounded-5 fs-4 h-100 d-flex flex-column align-items-center justify-content-between bg-dark text-white border-white">
          <h3 class="fw-bold text-warning">Ultimo progetto creato</h3>
          <p class="fw-bold my-5">{{ $last_project->title }}</p>
          <p class="m-0">Creato il {{ $last_project->created_at->format('d-m-Y') }} alle
            {{ $last_project->created_at->format('H:i:s') }}
          </p>
        </div>
      </div>

      <div class="col mb-3">
        <div
          class="card p-5 rounded-5 fs-4 h-100 d-flex flex-column align-items-center justify-content-between bg-dark text-white border-white">
          <h3 class="fw-bold text-warning">Ultimo progetto modificato</h3>
          <p class="fw-bold my-5">{{ $updated_project->title }}</p>
          <p class="m-0">Modificato il {{ $updated_project->updated_at->format('d-m-Y') }} alle
            {{ $updated_project->updated_at->format('H:i:s') }}
          </p>
        </div>
      </div>

      <div class="col mb-3">
        <div class="card p-5 rounded-5 fs-4 h-100 text-center bg-dark text-white border-white">
          <h3 class="fw-bold text-primary">Tecnologia più utilizzata</h3>
          <a class="badge text-bg-primary mx-auto rounded-pill my-5 text-decoration-none fs-4"
            href="{{ route('admin.technologies.show', $techCount[0]) }}">
            {{ $techCount[0]->name }}
          </a>
          <p class="m-0 border-bottom border-primary pb-4 mb-3">Utilizzato nel
            {{ ($techCount[0]->projects_count / $count_project) * 100 }}% dei progetti</p>

          @foreach ($techCount as $tech)
            <h6 class="mt-3">{{ $tech->name }}</h6>
            <div class="progress mb-2" role="progressbar"
              aria-valuenow="{{ ($tech->projects_count / $count_project) * 100 }}" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar" style="width: {{ ($tech->projects_count / $count_project) * 100 }}%">
                {{ ($tech->projects_count / $count_project) * 100 }}%</div>
            </div>
          @endforeach

        </div>
      </div>

      <div class="col mb-3">
        <div class="card p-5 rounded-5 fs-4 h-100 text-center bg-dark text-white border-white">
          <h3 class="fw-bold text-success">Tipologia più comune</h3>
          <a class="badge text-bg-success mx-auto my-5 text-decoration-none fs-4"
            href="{{ route('admin.types.show', $typeCount[0]) }}">
            {{ $typeCount[0]->name }}
          </a>
          <p class="m-0 border-bottom border-success pb-4 mb-3">Rappresenta il
            {{ ($typeCount[0]->projects_count / $count_project) * 100 }}% dei progetti</p>

          <div class="my-auto">
            @foreach ($typeCount as $item)
              <h6 class="mt-5">{{ $item->name }}</h6>
              <div class="progress mb-2" role="progressbar"
                aria-valuenow="{{ ($item->projects_count / $count_project) * 100 }}" aria-valuemin="0"
                aria-valuemax="100">
                <div class="progress-bar bg-success"
                  style="width: {{ ($item->projects_count / $count_project) * 100 }}%">
                  {{ ($item->projects_count / $count_project) * 100 }}%</div>
              </div>
            @endforeach
          </div>

        </div>
      </div>

    </div>
  </div>
@endsection
