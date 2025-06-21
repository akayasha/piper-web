<script>
    "use strict";

    var KTBranchPic = function() {
        var table_pic = $('#kt_table_users');
        var datatable_pic;
        var branch_id = @json($data->id);

        var initUserTable = function() {
            datatable_pic = table_pic.DataTable({
                "info": false,
                "order": [],
                "pageLength": 10,
                "lengthChange": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ajax": {
                    "url": `/branchs/branch-pic/${branch_id}`,
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
                        targets: 5
                    },
                ],
                'columns': [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false
                    },
                    {
                        data: 'name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'phone',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'email',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'updated_at',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                ]
            });

            var initToggleToolbar = function() {
                console.log('Toolbar initialized');
            }

            var toggleToolbars = function() {
                console.log('Toggle toolbars');
            }

            datatable_pic.on('draw', function() {
                initToggleToolbar();
                toggleToolbars();
            });
        }

        var handleSearchDatatablePIC = function() {
            const filterSearchPic = $('[data-kt-pic-table-filter="search"]');
            filterSearchPic.on('keyup', function() {
                datatable.search(this.value).draw();
            });
        }

        return {
            init: function() {
                initUserTable();
                handleSearchDatatablePIC();
            }
        }
    }();

    $(document).ready(function() {
        KTBranchPic.init();
    });
</script>
