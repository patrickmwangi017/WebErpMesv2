<div class="card card-secondary collapsed-card">
    <div class="card-header">
      <h3 class="card-title">Technical cut</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-plus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
          <div class="card-body">
              @csrf
              <div class="row">
                <div class="col-4">
                  <label for="ordre">Sort order</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                    </div>
                    <input type="number" class="form-control" name="ordre" id="ordre" placeholder="Order">
                    <input type="hidden" name="{{ $id_type }}" value="{{ $infoLine['id_line']  }}">
                    <input type="hidden" name="status_id" value="{{ $status_id }}">
                    <input type="hidden" name="qty"  id="qty"  value="{{ $infoLine['qty_line']  }}" value=".001">
                    
                  </div>
                </div>
                <div class="col-4">
                  <label for="methods_services_id">Services</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list"></i></span>
                    </div>
                    <select class="methods_services_id form-control" name="methods_services_id" id="methods_services_id_{{ $infoLine['id_line']  }}">
                      <option>Select Services</option>
                      @foreach ($TechServicesSelect as $item)
                      <option value="{{ $item->id }}"  data-type-{{ $infoLine['id_line']  }}="{{ $item->type }}" data-txt-{{ $infoLine['id_line']  }}="{{ $item->label }}">{{ $item->code }}</option>
                      @endforeach
                    </select>
                    <!-- script for change label -->
                    <script type="text/javascript">
                      $("#methods_services_id_" + {{ $infoLine['id_line'] }}).on('change',function(){
                        var val = $(this).val();
                        var txt = $(this).find('option:selected').data("txt-" + {{ $infoLine['id_line']  }});
                        var type = $(this).find('option:selected').data("type-" + {{ $infoLine['id_line']  }});
                        $("#LABEL_TechnicalCut_" + {{ $infoLine['id_line']  }}).val( txt );
                        $("#type_TechnicalCut_" + {{ $infoLine['id_line']  }}).val( type );
                      });
                    </script>
                    <!-- end -->
                    <input type="hidden" class="form-control" name="type" id="type_TechnicalCut_{{ $infoLine['id_line']  }}">
                  </div>
                </div>
                <div class="col-4">
                    <label for="label">Label</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-tags"></i></span>
                      </div>
                      <input type="text" class="form-control" name="label"  id="LABEL_TechnicalCut_{{ $infoLine['id_line']  }}" placeholder="Label">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-3">
                  <label for="seting_time">Setting time</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-stopwatch"></i></span>
                    </div>
                    <input type="number" class="form-control" name="seting_time"  id="seting_time" placeholder="Setting time" value="0" step=".001">
                  </div>
                </div>
                <div class="col-3">
                  <label for="unit_time">Unit time</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-stopwatch"></i></span>
                    </div>
                    <input type="number" class="form-control" name="unit_time"  id="unit_time" placeholder="Unit time" value="0" step=".001">
                  </div>
                </div>
                <div class="col-3">
                  <label for="unit_cost">Unit cost</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{ $Factory->curency }}</span>
                    </div>
                    <input type="number" class="form-control" name="unit_cost"  id="unit_cost" placeholder="Unit cost" value="0" step=".001">
                  </div>
                </div>
                <div class="col-3">
                  <label for="unit_price">Unit price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{ $Factory->curency }}</span>
                    </div>
                    <input type="number" class="form-control" name="unit_price"  id="unit_price" placeholder="Unit time" value="0" step=".001">
                  </div>
                </div>
              </div>
          </div>
          <div class="card-footer">
            <button type="Submit" class="btn btn-primary">Submit</button>
          </div>
        </form>

        <table class="table">
          <thead>
          <tr>
              <th>Sort order</th>
              <th>Label</th>
              <th>Service</th>
              <th>Setting time</th>
              <th>Unit time</th>
              <th>Unit cost</th>
              <th>Unit price</th>
              <th>Statu</th>
              <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @forelse ($TechnicalCut as $TechProduct)
            <tr>
                <td>{{ $TechProduct->ordre }}</td>
                <td>{{ $TechProduct->label }}</td>
                <td>{{ $TechProduct->service['label'] }}</td>
                <td>{{ $TechProduct->seting_time }}</td>
                <td>{{ $TechProduct->unit_time }}</td>
                <td>{{ $TechProduct->unit_cost }}</td>
                <td>{{ $TechProduct->unit_price }}</td>
                <td>
                  @if($TechProduct->order_lines_id)
                    {{ $TechProduct->status['title'] }}
                  @else
                    Not for quote
                  @endif
                </td>
                <td class=" py-0 align-middle">
                  <!-- Modal -->
                  @include('include.modals.modal-TechCut-update')
                  <!-- End Modal -->
                  <div class="btn-group btn-group-sm">
                    <a href="#" data-toggle="modal" data-target="#TechnicalCutUpdateModal{{ $TechProduct->id }}" class="btn btn-info"><i class="fa fa-lg fa-fw  fa-edit"></i></a>
                  </div>
                  <div class="btn-group btn-group-sm">
                    <a href="{{ route('task.delete', ['id_type'=> $id_type, 'id_page'=> $id_page, 'id_task' => $TechProduct->id])}}" class="btn btn-danger"><i class="fa fa-lg fa-fw fa-trash"></i></a>
                  </div>
                </td>
            </tr>
            @empty
              <x-EmptyDataLine col="9" text="No line found ..."  />
            @endforelse
          </tbody>
          <tfoot>
            <tr>
              <th>Sort order</th>
              <th>Label</th>
              <th>Service</th>
              <th>Setting time</th>
              <th>Unit time</th>
              <th>Unit cost</th>
              <th>Unit price</th>
              <th>Statu</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
  
<div class="card card-secondary collapsed-card">
    <div class="card-header">
      <h3 class="card-title">Bill of materials</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-plus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            <div class="row">
              <div class="col-3">
                <label for="ordre">Sort order</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                  </div>
                  <input type="number" class="form-control" name="ordre" id="ordre" placeholder="Order">
                  <input type="hidden" class="form-control" name="{{ $id_type }}" value="{{ $infoLine['id_line']  }}">
                  <input type="hidden" class="form-control" name="status_id" value="{{ $status_id }}">
                </div>
              </div>
              <div class="col-3">
                  <label for="methods_services_id">Services</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list"></i></span>
                    </div>
                    <select class="methods_services_id form-control" name="methods_services_id" id="methods_services_id_BOM_{{ $infoLine['id_line']  }}">
                      <option>Select Services</option>
                      @foreach ($BOMServicesSelect as $item)
                      <option value="{{ $item->id }}"  class="{{ $item->id }}" data-type-{{ $infoLine['id_line'] }}="{{ $item->type }}" data-txt-{{ $infoLine['id_line']  }}="{{ $item->label }}">{{ $item->code }}</option>
                      @endforeach
                    </select>
                    <!-- script or change label -->
                    <script>
                      $("#methods_services_id_BOM_" + {{ $infoLine['id_line']  }}).on('change',function(){
                        var val = $(this).val();
                        var txt = $(this).find('option:selected').data("txt-" + {{ $infoLine['id_line']  }});
                        var type = $(this).find('option:selected').data("type-" + {{ $infoLine['id_line']  }});
                        $("#LABEL_BOM_" + {{ $infoLine['id_line']  }}).val( txt );
                        $("#type_BOM_" + {{ $infoLine['id_line']  }}).val( type );
                    });
                    
                    $("#methods_services_id_BOM_" + {{ $infoLine['id_line']  }}).change(function () {
                        var modelObj = $(this).parent().next().children(".component_id_" + {{$infoLine['id_line']  }});
                        var selector = "option[class="+this.value.toLowerCase()+"]";
                        modelObj.children(":not("+selector+")").hide();
                        modelObj.children(selector).show();
                    });
                    </script>
                    <!-- end -->
                    <input type="hidden" class="form-control" name="type" id="type_BOM_{{ $infoLine['id_line']  }}">
                  </div>
              </div>
              <div class="col-3">
                <label for="component_id">Component</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                  </div>
                  <select class="component_id form-control" name="component_id" id="component_id_{{ $infoLine['id_line']  }}">
                    <option>Select Component</option>
                    @foreach ($ProductSelect as $item)
                    <option value="{{ $item->id }}" class="{{ $item->methods_services_id }}">{{ $item->code }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-3">
                  <label for="label">Label</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tags"></i></span>
                    </div>
                    <input type="text" class="form-control" name="label"  id="LABEL_BOM_{{ $infoLine['id_line']  }}" placeholder="Label">
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-3">
                <label for="qty">Quantity</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-times"></i></span>
                  </div>
                  <input type="number" class="form-control" name="qty"  id="qty" value="{{ $infoLine['qty_line']  }}" placeholder="Quantity" step=".001">
                </div>
              </div>
              <div class="col-3">
                <label for="unit_cost">Unit cost</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">{{ $Factory->curency }}</span>
                  </div>
                  <input type="number" class="form-control" name="unit_cost"  id="unit_cost" placeholder="Unit cost" value="0" step=".001">
                </div>
              </div>
              <div class="col-3">
                <label for="unit_price">Unit price</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">{{ $Factory->curency }}</span>
                  </div>
                  <input type="number" class="form-control" name="unit_price"  id="unit_price" placeholder="Unit time" value="0" step=".001">
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="Submit" class="btn btn-primary">Submit</button>
          </div>
      </form>

      <table  class="table">
        <thead>
          <tr>
              <th>Sort order</th>
              <th>Label</th>
              <th>Service</th>
              <th>Component</th>
              <th>Quantity</th>
              <th>Unit cost</th>
              <th>Unit price</th>
              <th>Statu</th>
              <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @forelse ($BOM as $BOMProduct)
            <tr>
              <td>{{ $BOMProduct->ordre }}</td>
              <td>{{ $BOMProduct->label }}</td>
              <td>{{ $BOMProduct->service['label'] }}</td>
              <td>{{ $BOMProduct->Component['code'] }}</td>
              <td>{{ $BOMProduct->qty }}</td>
              <td>{{ $BOMProduct->unit_cost }}</td>
              <td>{{ $BOMProduct->unit_price }}</td>
              <td>
                @if($BOMProduct->order_lines_id)
                {{ $BOMProduct->status['title'] }}
                @else
                  Not for quote
                @endif
              </td>
              <td class=" py-0 align-middle">
                <!-- Modal -->
                @include('include.modals.modal-BOM-update')
                <!-- End Modal -->
                <div class="btn-group btn-group-sm">
                  <a href="#" data-toggle="modal" data-target="#BOMUpdateModal{{ $BOMProduct->id }}" class="btn btn-info"><i class="fa fa-lg fa-fw  fa-edit"></i></a>
                </div>
                <div class="btn-group btn-group-sm">
                  <a href="{{ route('task.delete', ['id_type'=> $id_type, 'id_page'=> $id_page, 'id_task' => $BOMProduct->id])}}" class="btn btn-danger"><i class="fa fa-lg fa-fw fa-trash"></i></a>
                </div>
              </td>
            </tr>
            @empty
              <x-EmptyDataLine col="9" text="No line found ..."  />
            @endforelse
        </tbody>
        <tfoot>
          <tr>
              <th>Sort order</th>
              <th>Label</th>
              <th>Service</th>
              <th>Component</th>
              <th>Quantity</th>
              <th>Unit cost</th>
              <th>Unit price</th>
              <th>Statu</th>
              <th>Action</th>
          </tr>
        </tfoot>
      </table>
  </div>
  <!-- /.card-body -->
</div>