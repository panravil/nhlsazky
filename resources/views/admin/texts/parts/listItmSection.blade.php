


<a class="list-group-item list-group-item-action d-flex align-items-center justify-content-between {{ $request->segment(3) == $template->id ? 'active' : '' }}" href="{{ route('admin.texty.edit', $template->id) }}">
                                  <div>
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file text-white"></i>
                    </div>
                  </div>
                  <div class="w-100 pr-2 pl-2">
                    <div class=""><span class="">{{ $template->title }}</span></div>
                    <div class="text-gray-600"></div>

                  </div>
                </a>
