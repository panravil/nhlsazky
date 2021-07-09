<a class="list-group-item list-group-item-action {{ $zprava->read == 0 ? 'list-group-item-light' : 'list-group-item-secondary'}} d-flex pt-2 pb-2 pl-2 pr-2 align-items-center justify-content-between" href="{{ route('admin.zpravy.show', $zprava->id) }}">
                                  <div>
                    <div class="icon-circle {{ 'bg-primary'}}">
                      <i class="fas {{ $zprava->read == 0 ? 'fa-envelope' : 'fa-envelope-open'}} text-white"></i>
                    </div>
                  </div>
                  <div class="w-100 pr-2 pl-2">
                    <div class="small"><span class="text-gray-600">{{ $zprava->created_at->format('Y-m-d H:i ') }}</span><span class="badge-pill badge-light">{{ $zprava->name }}</span></div>
                      <div class="font-weight-bold text-gray-800">Kontakt formulář</div>
                    <div class="text-gray-600">{{  $zprava->email  }}</div>
                  </div>
                                                        <div class="mr-0">
                                                            @if($zprava->read == 0)
                                                                      <form action="{{ route('admin.zpravy.update', $zprava->id)}}" method="post">
                  @csrf
                     <input type="hidden" name="action" value="read">
                  @method('PATCH')
                  <button class="btn btn-sm btn-good" type="submit"><i class="fas fa-eye fa-fw"></i></button>
                </form>
                                                                @else
                                                                                <form action="{{ route('admin.zpravy.update', $zprava->id)}}" method="post">
                  @csrf
                     <input type="hidden" name="action" value="unread">
                  @method('PATCH')
                  <button class="btn btn-sm btn-good" type="submit"><i class="fas fa-eye-slash fa-fw"></i></button>
                </form>
                                                            @endif
                                                                                   <form action="{{ route('admin.zpravy.destroy', $zprava->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash text-white fa-fw"></i></button>
                </form>
                  </div>

                </a>
