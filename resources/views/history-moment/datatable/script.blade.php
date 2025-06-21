<script>
    var KTFeedback = function() {
        var table = $('#kt_table_history_moment');
        var datatable;

        var initFeedbackTable = function() {
            datatable = table.DataTable({
                "info": false,
                "order": [],
                "pageLength": 10,
                "lengthChange": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ajax": {
                    "url": "/history-moments",
                    "type": "GET",
                    "dataSrc": function(json) {
                        return json.data;
                    }
                },
                'columnDefs': [{
                        orderable: false,
                        targets: 0
                    },
                    {
                        orderable: false,
                        targets: 6
                    }
                ],
                'columns': [
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; 
                        },
                        orderable: false
                    },
                    {
                        data: 'image',
                        render: function(data, type, row) {
                            return `<img src="${data}" alt="Image" style="width: 50px; height: 50px; object-fit: cover;">`;
                        },
                        defaultContent: '-',
                        orderable: false
                    },
                    {
                        data: 'name',
                        defaultContent: '-'
                    },
                    {
                        data: 'description',
                        defaultContent: '-'
                    },
                    {
                        data: 'mimeType',
                        defaultContent: '-'
                    },
                    {
                        data: 'size',
                        defaultContent: '-'
                    },
                    {
                        data: 'action', 
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        };

        var handleSearchDatatable = function() {
            const filterSearch = $('[data-kt-feedback-table-filter="search"]');
            filterSearch.on('keyup', function() {
                datatable.search(this.value).draw();
            });
        };

        return {
            init: function() {
                initFeedbackTable();
                handleSearchDatatable();
            }
        };
    }();

    $(document).ready(function() {
        KTFeedback.init();
    });
</script>
