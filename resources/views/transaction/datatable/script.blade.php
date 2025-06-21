<script>
    var KTUsersList = function() {
        var table = $('#kt_table_transaction');
        var datatable;

        var initUserTable = function() {
            datatable = table.DataTable({
                "info": false,
                "order": [],
                "pageLength": 10,
                "lengthChange": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ajax": {
                    "url": "/transactions",
                    "type": "GET",
                    "data": function(d) {
                        d.branch_id = $('#branch_id').val();
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    },
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
                'columns': [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false
                    },
                    {
                        data: function(row) {
                            return row.redeem_code?.branch?.name ?? '-';
                        }
                    },
                    {
                        data: 'invoice_number',
                        render: function(data) {
                            return data ?? '-';
                        }
                    },
                    {
                        data: 'transaction_id',
                        render: function(data) {
                            return data ?? '-';
                        }
                    },
                    {
                        data: 'price',
                        render: function(data, type, row) {
                            return data ? new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 2
                            }).format(data).replace('IDR', '').trim() : '-';
                        }
                    },
                    {
                        data: 'status',
                        render: function(data) {
                            if (data === 'success') {
                                return `
                                    <span class="badge" style="background-color: #28a745;">Success</span>
                                `;
                            } else if (data === 'pending') {
                                return `
                                    <span class="badge" style="background-color: #007bff;">Pending</span>
                                `;
                            } else if (data === 'expired') {
                                return `
                                    <span class="badge" style="background-color: #dc3545;">Expired</span>
                                `;
                            } else {
                                return `
                                    <span class="badge badge-secondary">${data ?? '-'}</span>
                                `;
                            }
                        },
                        orderable: false
                    },
                    {
                        data: 'strip',
                        render: function(data) {
                            return data ?? '-';
                        }
                    },
                    {
                        data: 'payment_method',
                        render: function(data) {
                            return data ?? '-';
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data) {
                            if (data) {
                                const date = new Date(data);
                                const options = {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true
                                };
                                const formattedDate = date.toLocaleString('id-ID',
                                options); 
                                return formattedDate.replace(/,/,
                                ' |'); 
                            } else {
                                return '-';
                            }
                        }
                    }
                ]
            });
        };

        var handleSearchDatatable = function() {
            const filterSearch = $('[data-kt-user-table-filter="search"]');
            filterSearch.on('keyup', function() {
                datatable.search(this.value).draw();
            });
        };

        var handleBranchFilter = function() {
            const branchFilter = $('#branch_id');
            branchFilter.on('change', function() {
                setTimeout(function() {
                    datatable.ajax.reload();
                }, 100);
            });
        };

        // Add these new functions to handle date filtering
        var handleDateFilter = function() {
            $('#apply_date_filter').on('click', function() {
                datatable.ajax.reload();
            });

            $('#reset_date_filter').on('click', function() {
                $('#start_date').val('');
                $('#end_date').val('');
                datatable.ajax.reload();
            });
        };

        return {
            init: function() {
                initUserTable();
                handleSearchDatatable();
                handleBranchFilter();
                handleDateFilter(); 
            }
        };
    }();

    $(document).ready(function() {
        KTUsersList.init();
    });
</script>
