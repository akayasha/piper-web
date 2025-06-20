<script>
    "use strict";

    var branchName = @json($data->name);
    var branchId = @json($data->id);
    var refresh_template = $('#refresh-template');
    var KTUsersList = function() {
        var table = $('#kt_table_template');
        var datatable;
        var toolbarBase;
        var toolbarSelected;
        var selectedCount;

        var initUserTable = function() {
            datatable = table.DataTable({
                "info": false,
                "order": [],
                "pageLength": 5,
                "lengthChange": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ajax": {
                    "url": `/templates`,
                    "type": "GET",
                    data: function(d) {
                        d.branch = branchName;
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
                        data: 'branch',
                        defaultContent: '-'
                    },
                    {
                        data: 'name',
                        defaultContent: '-'
                    },
                    {
                        data: 'template',
                        name: 'template',
                        defaultContent: '-',
                        render: function(data, type, row) {
                            if (data) {
                                return `<img src="data:image/png;base64,${data}" alt="Template Image" class="img-thumbnail" style="max-width: 100px;">`;
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'count_photo',
                        defaultContent: '-'
                    },
                    {
                        data: 'created_at',
                        defaultContent: '-'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-sm btn-danger btn-delete p-3 m-1" data-id="${row.id}">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.74997 1C8.02062 1 7.32115 1.28973 6.80543 1.80546C6.2897 2.32118 5.99997 3.02065 5.99997 3.75V4.193C5.20497 4.27 4.41597 4.369 3.63497 4.491C3.53622 4.50445 3.44114 4.53745 3.35529 4.58807C3.26943 4.63869 3.19453 4.70591 3.13496 4.78581C3.07538 4.86571 3.03233 4.95668 3.00831 5.0534C2.98429 5.15013 2.97979 5.25067 2.99508 5.34916C3.01036 5.44764 3.04512 5.54209 3.09733 5.62699C3.14953 5.71189 3.21813 5.78553 3.29912 5.84361C3.38011 5.90169 3.47186 5.94305 3.56902 5.96526C3.66618 5.98748 3.76679 5.99011 3.86497 5.973L4.01397 5.951L4.85497 16.469C4.91003 17.1582 5.22267 17.8014 5.73063 18.2704C6.23859 18.7394 6.90458 18.9999 7.59597 19H12.403C13.0944 19.0002 13.7605 18.74 14.2686 18.2711C14.7768 17.8022 15.0897 17.1592 15.145 16.47L15.986 5.95L16.135 5.973C16.3297 5.99952 16.527 5.94858 16.6845 5.83111C16.8421 5.71365 16.9472 5.53906 16.9773 5.34488C17.0075 5.15071 16.9602 4.95246 16.8457 4.79278C16.7312 4.6331 16.5586 4.52474 16.365 4.491C15.5797 4.36878 14.791 4.26941 14 4.193V3.75C14 3.02065 13.7102 2.32118 13.1945 1.80546C12.6788 1.28973 11.9793 1 11.25 1H8.74997ZM9.99997 4C10.84 4 11.673 4.025 12.5 4.075V3.75C12.5 3.06 11.94 2.5 11.25 2.5H8.74997C8.05997 2.5 7.49997 3.06 7.49997 3.75V4.075C8.32697 4.025 9.15997 4 9.99997 4ZM8.57997 7.72C8.57201 7.52109 8.48536 7.33348 8.33909 7.19846C8.19281 7.06343 7.99888 6.99204 7.79997 7C7.60106 7.00796 7.41345 7.0946 7.27843 7.24088C7.1434 7.38716 7.07201 7.58109 7.07997 7.78L7.37997 15.28C7.38391 15.3785 7.40721 15.4752 7.44854 15.5647C7.48987 15.6542 7.54842 15.7347 7.62085 15.8015C7.69328 15.8684 7.77817 15.9203 7.87067 15.9544C7.96317 15.9884 8.06148 16.0039 8.15997 16C8.25846 15.9961 8.35521 15.9728 8.4447 15.9314C8.53418 15.8901 8.61465 15.8315 8.68151 15.7591C8.74837 15.6867 8.80031 15.6018 8.83436 15.5093C8.86841 15.4168 8.88391 15.3185 8.87997 15.22L8.57997 7.72ZM12.92 7.78C12.9239 7.68151 12.9084 7.58321 12.8744 7.4907C12.8403 7.3982 12.7884 7.31331 12.7215 7.24088C12.6547 7.16845 12.5742 7.1099 12.4847 7.06857C12.3952 7.02724 12.2985 7.00394 12.2 7C12.0011 6.99204 11.8071 7.06343 11.6609 7.19846C11.5146 7.33348 11.4279 7.52109 11.42 7.72L11.12 15.22C11.116 15.3185 11.1315 15.4168 11.1656 15.5093C11.1996 15.6018 11.2516 15.6867 11.3184 15.7591C11.3853 15.8315 11.4658 15.8901 11.5552 15.9314C11.6447 15.9728 11.7415 15.9961 11.84 16C11.9385 16.0039 12.0368 15.9884 12.1293 15.9544C12.2218 15.9203 12.3067 15.8684 12.3791 15.8015C12.4515 15.7347 12.5101 15.6542 12.5514 15.5647C12.5927 15.4752 12.616 15.3785 12.62 15.28L12.92 7.78Z" fill="white"/>
                                        </svg>
                                    </button>
                                </div>`;
                        },
                        orderable: false
                    }
                ]
            });

            var initToggleToolbar = function() {
                console.log('Toolbar initialized');
            }

            var handleDeleteRows = function() {
                table.on('click', '.btn-delete', function() {
                    var template_id = $(this).data('id');
                    var row = $(this).closest('tr');
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    Swal.fire({
                        text: "Are you sure you want to delete this Template?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/templates/${branchId}/delete/${template_id}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            text: response.message,
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function() {
                                            datatable.row(row).remove().draw();
                                        });
                                    } else {
                                        Swal.fire({
                                            text: response.message,
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        text: "Failed to delete the Template Branch.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            }

            var toggleToolbars = function() {
                console.log('Toggle toolbars');
            }

            datatable.on('draw', function() {
                initToggleToolbar();
                handleDeleteRows();
                toggleToolbars();
            });
        }

        var handleSearchDatatable = function() {
            const filterSearch = $('[data-kt-user-table-filter="search"]');
            filterSearch.on('keyup', function() {
                datatable.search(this.value).draw();
            });
        }

        var refreshTable = function() {
            datatable.ajax.reload();
        }

        return {
            init: function() {
                initUserTable();
                handleSearchDatatable();
                refresh_template.on('click', function() {
                    refreshTable();
                });
            }
        }
    }();
    $(document).ready(function() {
        KTUsersList.init();
    });
</script>
