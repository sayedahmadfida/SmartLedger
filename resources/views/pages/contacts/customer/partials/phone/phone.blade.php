<div class="box-footer no-padding">
  <ul class="nav nav-stacked">
      <li>
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Phones <span
                  class="pull-right badge bg-blue">{{ $customerPhone->count() }}</span></a>
      </li>
      <div class="___class_+?8___">
          <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="">
              <div class="box-body">
                  <table>
                      @foreach ($customerPhone as $phone)
                          <tr>
                              <div class="modal fade in" id="edite_model{{ $phone->id }}"
                                  style="display: none;">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal"
                                                  aria-label="Close">
                                                  <span aria-hidden="true">×</span></button>
                                              <h4 class="modal-title">Edit Phone</h4>
                                          </div>
                                          <form
                                              action="{{ route('phone.update', Crypt::encrypt($phone->id)) }}"
                                              method="post" id="edit-phone">
                                              @csrf
                                              @method('patch')
                                              <div class="modal-body">
                                                  <input type="hidden" name="mode_id"
                                                      value="{{ Crypt::encrypt($customer->id) }}">
                                                  <input type="hidden" name="model_type"
                                                      value="{{ Crypt::encrypt('CUSTOMER') }}">
                                                  <input type="text" name="phone"
                                                      value="{{ $phone->phone }}" class="form-control">
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-default pull-left"
                                                      data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Save
                                                      changes</button>
                                              </div>
                                          </form>
                                      </div>
                                      <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                              </div>

                              <th>
                                  <span style="color:#337ab7">{{ $phone->phone . ' ' }}</span>
                                  <a href="#" class="ml text-success" data-toggle="modal"
                                      data-target="#edite_model{{ $phone->id }}"> <i class="fa fa-pencil-square text-success" aria-hidden="true"></i></a>
                                  <a href="#" class="ml text-danger" data-id="{{$phone->id}}" onclick="deletePhoneNumber(event)"> 
                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                              </th>
                          </tr>
                      @endforeach

                  </table>
                  <br>

                  </a> <a href="#" class="ml text-primary" data-toggle="modal"
                      data-target="#add_model"> <i class="fa  fa-plus"></i> Add New Phone</a>

              </div>
          </div>
      </div>
      <li>
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
              Total Remainder
              <span class="pull-right text-bold {{$sumData->credit - $sumData->debit < 0 ? 'text-danger' : null }}">{{ session('user.currency_symbol') }}
                  {{ $sumData->credit - $sumData->debit }}</span>
          </a>
      </li>
      <div class="___class_+?8___">
          <div id="" class="panel-collapse collapse" aria-expanded="false" style="">
              <div class="box-body">

              </div>
          </div>
      </div>
  </ul>
</div>