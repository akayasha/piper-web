<script>
    var KTFeedback = function() {
        var table = $('#kt_table_feedback');
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
                    "url": "/feedbacks",
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
                        targets: 3
                    }
                ],
                'columns': [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false
                    },
                    {
                        data: 'message',
                        defaultContent: '-'
                    },
                    {
                        data: 'created_at',
                        defaultContent: '-'
                    },
                    {
                        data: 'updated_at',
                        defaultContent: '-'
                    },
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
