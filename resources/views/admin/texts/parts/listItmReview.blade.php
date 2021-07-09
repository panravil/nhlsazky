


<a class="list-group-item list-group-item-action d-flex align-items-center justify-content-between {{ $request->segment(3) == $template->id ? 'active' : '' }}" href="{{ route('admin.recenze.edit', $template->id) }}">
                                  <div>
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file text-white"></i>
                    </div>
                  </div>
                  <div class="w-100 pr-2 pl-2">
                    <div class="">{{ $template->name }} <span class="badge badge-dark">{{ $template->reviewdate }}</span>@for ($i = 0; $i < 5; $i++)
                                @if($i < $template->rating)
                                    <span class="fas fa-star text-primary"></span>
                                @else
                                    <span class="fas fa-star"></span>
                                @endif
                            @endfor</div>
                    <div class="text-gray-600">{{ $template->content }}</div>

                  </div>
                </a>
