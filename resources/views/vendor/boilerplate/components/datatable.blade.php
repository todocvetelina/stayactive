@if(empty($name))
    <code>
        &lt;x-boilerplate::datatable>
        The name attribute has not been set
    </code>
@elseif(! $permission)
    <code>
        &lt;x-boilerplate::datatable>
        You don't have permission to access the table "{{ $name }}"
    </code>
@else
    <div class="table-responsive">
        <table class="table table-striped table-hover va-middle w-100" id="{{ $id }}">
            <thead>
            <tr>
                @foreach($datatable->getColumns() as $column)
                    <th>{!! $column->title !!}</th>
                @endforeach
            </tr>
            @if(in_array('filters', $datatable->buttons))
            <tr class="filters" style="display:none">
                @foreach($datatable->getColumns() as $k => $column)
                    <th>
                        @if($column->searchable === false)
                            @continue
                        @endif
                        @switch($column->filterType)
                            @case('select')
                                @component('boilerplate::select2', ['name' => "filter[$k]", 'groupClass' => 'mb-0', 'class' => 'form-control-sm dt-filter-select', 'options' => $column->filterOptions, 'data-field' => "$k", 'allowClear' => true])@endcomponent
                            @break
                            @case('select-multiple')
                                @component('boilerplate::select2', ['name' => "filter[$k]", 'groupClass' => 'mb-0', 'class' => 'form-control-sm dt-filter-select', 'options' => $column->filterOptions, 'data-field' => "$k", 'multiple' => true])@endcomponent
                            @break
                            @case('daterangepicker')
                                @component('boilerplate::daterangepicker', ['name' => "filter[$k]", 'groupClass' => 'mb-0', 'class' => 'dt-filter-daterange', 'controlClass' => 'form-control-sm', 'data-field' => "$k", 'alignment' => 'center'])@endcomponent
                            @break
                            @default
                                @component('boilerplate::input', ['name' => "filter[$k]", 'groupClass' => 'mb-0', 'class' => 'dt-filter-text form-control-sm', 'data-field' => "$k"])@endcomponent
                            @break
                        @endswitch
                    </th>
                @endforeach
            </tr>
            @endif
            </thead>
            <tbody></tbody>
        </table>
    </div>
    @include('boilerplate::load.async.datatables', ['buttons' => true])
    @component('boilerplate::minify')
    <script>
        whenAssetIsLoaded('datatables', function() {
            window.{{ \Str::camel($id) }} = $('#{{ $id }}')
                .data('inst', '{{ \Str::camel($id) }}' )
                .on('processing.dt', $.fn.dataTable.customProcessing).DataTable({
                processing: false,
                serverSide: true,
                autoWidth: false,
                orderCellsTop: true,
                buttons: { buttons: [{!! $datatable->getButtons() !!}]},
                info: {{ (int) $datatable->info }},
                searching: {{ (int) $datatable->searching }},
                ordering: {{ (int) $datatable->ordering }},
                @if($datatable->ordering)
                    order: {!! $datatable->order !!},
                @endif
                paging: {{ (int) $datatable->paging }},
                @if($datatable->paging)
                    pageLength: {{ $datatable->pageLength }},
                    pagingType: '{{ $datatable->pagingType }}',
                    lengthChange: {{ (int) $datatable->lengthChange }},
                    lengthMenu: {!! $datatable->lengthMenu !!},
                @endif
                @if($datatable->stateSave)
                    stateSave: true,
                    stateSaveParams: $.fn.dataTable.saveFiltersState,
                    stateLoadParams: $.fn.dataTable.loadFiltersState,
                @endif
                ajax: {
                    url: '{!! route('boilerplate.datatables', $datatable->slug, false) !!}',
                    type: 'post',
                    data: $.fn.dataTable.parseDatatableFilters,
                    complete: () => { $('#{{ $id }} [name=dt-check-all]').prop('checked', false) }
                },
                columns: [
                    @foreach($datatable->getColumns() as $column)
                        {!! $column->get() !!},
                    @endforeach
                ],
                initComplete: $.fn.dataTable.init,
            });

            window.{{ \Str::camel($id) }}.locale = {!! $datatable->getLocale() !!}
        });
    </script>
    @endcomponent
@endif