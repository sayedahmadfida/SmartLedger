<div class="tab-pane active" id="tab_4">
  <table class="table table-hover table-bordered table-striped">
      <thead>
          <tr>
              <th>No</th>
              <th>Date</th>
              <th>Description</th>
              <th>Credit</th>
              <th>Debit</th>
              <th>Balance</th>
              <th>Action</th>
          </tr>
      </thead>

      <tbody>

          @foreach ($ledgerAccount as $item)
          @include('pages.contacts.customer.partials.edit-transiction')
          @include('pages.contacts.customer.partials.delete-transiction')

              <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ substr($item->created_at, 0, 10) }}</td>
                  <td>{{ $item->transaction_description }}</td>
                  <td>{{ $item->transiction_type === 'CREDIT' ? $item->credit_amount : null }}</td>
                  <td class="text-red">
                      {{ $item->transiction_type === 'DEBIT' ? $item->debit_amount : null }}</td>
                  <td class="{{ $item->remainder < 0 ? 'text-danger' : null}}">{{ $item->remainder }}</td>
                  <td>
                    <div class="btn-group">
                        <div class="btn-group">
                            <a href="javascript:void(0)"
                                class="btn-primary btn btn-xs dropdown-toggle"
                                aria-expanded="false" data-toggle="dropdown">
                                <span>Action <i class="fa-solid fa-chevron-down"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                
                                <li>
                                    <a class="text-primary" style="margin-right: 10px" href="#" data-toggle="modal" data-target="#edit-transiction-modal{{$item->id}}">
                                    <i class="fa fa-pencil-square text-success" aria-hidden="true"></i> Edit</a>
                                </li>
                                
                                <li>
                                    <a class="text-primary" style="margin-right: 10px" href="#" onclick="deleteTransaction(event)" data-form-id="delete-form-{{$item->id}}">
                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i> Delete</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
              </tr>
          @endforeach
      </tbody>
      <tfoot>
          <tr>
              <th colspan="3">Total</th>
              <th>{{ @num_format($sumData->credit) }}</th>
              <th class="text-red">{{ @num_format($sumData->debit) }}</th>
              <th class="{{$sumData->credit - $sumData->debit < 0 ? 'text-danger' : null }}">{{ @num_format($sumData->credit - $sumData->debit) }}</th>
          </tr>
      </tfoot>
  </table>
</div>