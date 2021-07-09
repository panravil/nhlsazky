


<a class="list-group-item list-group-item-action list-group-item-light d-flex pt-2 pb-2 pl-2 pr-2 align-items-center justify-content-between" href="{{ route('admin.zpravy.edit', $template->id) }}">
                                  <div>
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-file text-white"></i>
                    </div>
                  </div>
                  <div class="w-100 pr-2 pl-2">
                    <div class="small"><span class="text-gray-600">{{ $template->title }}</span></div>
                      <div class="font-weight-bold text-gray-800">{{ $template->subject }}</div>
                    <div class="text-gray-600"></div>

                  </div>
                </a>
