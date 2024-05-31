<aside class="bg-black text-white border-end border-secondary">
  <ul class="list-unstyled">

    <li>
      <a href="{{ route('admin.home') }}">
        <i class="fa-solid fa-house me-2"></i></i>Home
      </a>
    </li>

    <li>
      <a href="{{ route('admin.projects.index') }}">
        <i class="fa-regular fa-folder-open me-2"></i>Lista Progetti
      </a>
    </li>

    <li>
      <a href="{{ route('admin.projects.create') }}">
        <i class="fa-regular fa-square-plus me-2"></i>Aggiungi Progetto
      </a>
    </li>

    <li>
      <a href="{{ route('admin.technologies.index') }}">
        <i class="fa-regular fa-rectangle-list me-2"></i>Tecnologie e Tipi
      </a>
    </li>

  </ul>
</aside>
