                            <div class="contact-seller">
                              <!-- If The Product Belongs To A Vendor -->
                              @if($productt->user_id != 0)
                                <ul class="list">
                                    @if(Auth::guard('web')->check())
                                      <li>
                                          <a class="view-stor" href="javascript:;" data-toggle="modal" data-target="#vendorform1">
                                              <i class="icofont-ui-chat"></i>
                                              {{ $langg->lang81 }}
                                          </a>
                                      </li>
                                      <li>
                                          @if($productt->user)
                                          @if(
                                          Auth::guard('web')->user() && Auth::guard('web')->user()->favorites()->where('vendor_id','=',$productt->user->id)->get()->count() >
                                          0)

                                          <a class="view-stor" href="javascript:;">
                                              <i class="icofont-check"></i>
                                              {{ $langg->lang225 }}
                                          </a>

                                          @else

                                          <a class="favorite-prod view-stor"
                                             data-href="{{ route('user-favorite',['id1' => Auth::guard('web')->user()->id, 'id2' => $productt->user->id]) }}"
                                             href="javascript:;">
                                              <i class="icofont-plus"></i>
                                              {{ $langg->lang224 }}
                                          </a>

                                          @endif
                                          @else
                                          @if(
                                          Auth::guard('web')->user() && Auth::guard('web')->user()->favorites()->where('vendor_id','=',$productt->user->id)->get()->count() >
                                          0)

                                          <a class="view-stor" href="javascript:;">
                                              <i class="icofont-check"></i>
                                              {{ $langg->lang225 }}
                                          </a>
                                          @else
                                          <a class="favorite-prod view-stor"
                                             data-href="{{ route('user-favorite',['id1' => Auth::guard('web')->user()->id, 'id2' => $productt->user->id]) }}"
                                             href="javascript:;">
                                              <i class="icofont-plus"></i>
                                              {{ $langg->lang224 }}
                                          </a>
                                          @endif
                                          @endif
                                      </li>
                                    @else
                                      <li>
                                          <a class="view-stor" href="javascript:;" data-toggle="modal" data-target="#myModal">
                                              <i class="icofont-ui-chat"></i>
                                              {{ $langg->lang81 }}
                                          </a>
                                      </li>
                                      <li>
                                          <a class="view-stor" href="javascript:;"data-toggle="modal" data-target="#myModal">
                                             <i class="icofont-plus"></i>
                                              {{ $langg->lang224 }}
                                          </a>
                                      </li>
                                    @endif
                                </ul>
                                <!-- VENDOR PART ENDS HERE :) -->
                              @else
                                <!-- If The Product Belongs To Admin  -->
                                <ul class="list">
                                    @if(Auth::guard('web')->check())
                                      <li>
                                          <a class="view-stor" href="javascript:;" data-toggle="modal" data-target="#vendorform">
                                              <i class="icofont-ui-chat"></i>
                                              {{ $langg->lang81 }}
                                          </a>
                                      </li>
                                    @else
                                      <li>
                                          <a class="view-stor" href="javascript:;" data-toggle="modal" data-target="#myModal">
                                              <i class="icofont-ui-chat"></i>
                                              {{ $langg->lang81 }}
                                          </a>
                                      </li>
                                    @endif
                                </ul>
                              @endif
                            </div>