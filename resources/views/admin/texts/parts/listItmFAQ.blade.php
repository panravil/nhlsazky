<a class="list-group-item list-group-item-action list-group-item-light d-flex pt-2 pb-2 pl-2 pr-2 align-items-center justify-content-between card-header border-left-{{ $template->show == 1 ? 'primary' : 'dark' }}"
   data-toggle="collapse" href="#collapseQ{{ $template->id }}" role="button" aria-expanded="true"
   aria-controls="collapseQ{{ $template->id }}">
    <div>
        <i class="fas fa-fw fa-question-circle text-{{ $template->show == 1 ? 'primary' : 'dark' }} fa-2x"></i>
    </div>
    <div class="w-100 pr-2 pl-2">
        <div class="text-{{ $template->show == 1 ? 'primary' : 'dark' }} font-weight-bold">{{ $template->question }}</div>
        <div class="small"><span class="text-gray-600">{{ $template->created_at }}</span></div>
    </div>
</a>
<div class="collapse show" id="collapseQ{{ $template->id }}">
    <div class="p-3">
         {{ $template->dsc }}
    </div>
                  <div class="card-footer d-flex justify-content-end align-content-end">
                                                <div class="btn-group" role="group">
                                                            @if($template->show == 0)
                                                                      <form action="{{ route('admin.faq.update', $template->id)}}" method="post">
                  @csrf
                     <input type="hidden" name="action" value="show">
                  @method('PATCH')
                  <button class="btn btn-sm btn-good" type="submit"><i class="fas fa-eye fa-fw"></i> <span class="d-none d-md-inline"> Zobrazit</span></button>
                </form>
                                                                @else
                                                                                <form action="{{ route('admin.faq.update', $template->id)}}" method="post">
                  @csrf
                     <input type="hidden" name="action" value="hide">
                  @method('PATCH')
                  <button class="btn btn-sm btn-good" type="submit"><i class="fas fa-eye-slash fa-fw"></i> <span class="d-none d-md-inline"> Schovat</span></button>
                </form>
                                                            @endif
                                    <a href="{{ route('admin.faq.edit', $template->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> <span class="d-none d-md-inline"> Upravit</span></a>
                                                     |<form action="{{ route('admin.faq.destroy', $template->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash text-white fa-fw"></i> <span class="d-none d-md-inline"> Smazat</span></button>
                </form>
                  </div>
                  </div>
</div>
