<script>
    "use strict";

    var KTUsersList = function() {
        // Define shared variables
        var table = $('#kt_table_transaction');
        var datatable;
        var toolbarBase;
        var toolbarSelected;
        var selectedCount;

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
                        data: 'redeem_code.branch.name' ?? '-'
                    },
                    {
                        data: 'invoice_number'
                    },
                    {
                        data: 'transaction_id'
                    },
                    {
                        data: 'price',
                        render: function(data, type, row) {
                            return data ?
                                new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 2
                                }).format(data).replace('IDR', '').trim() :
                                '-';
                        }
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'strip'
                    },
                    {
                        data: 'payment_method'
                    },
                    //   {
                    //     data: null,
                    //     render: function(data, type, row) {
                    //         return `
                    //             <div class="d-flex justify-content-between">
                    //                 <a href="/transactions/detail/${row.id}" class="btn btn-sm btn-primary p-3 m-1">
                    //                     <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    //                         <path d="M19.8785 9.42969C17.9965 5.29687 14.2674 2.5 10 2.5C5.73264 2.5 2.00347 5.29687 0.121528 9.42969C0.0421745 9.60654 0.000834465 9.80189 0.000834465 10C0.000834465 10.1981 0.0421745 10.3935 0.121528 10.5703C2.00347 14.7031 5.73264 17.5 10 17.5C14.2674 17.5 17.9965 14.7031 19.8785 10.5703C19.9578 10.3935 19.9992 10.1981 19.9992 10C19.9992 9.80189 19.9578 9.60654 19.8785 9.42969ZM10 15.625C9.01109 15.625 8.04439 15.2951 7.22215 14.677C6.3999 14.0589 5.75904 13.1804 5.3806 12.1526C5.00216 11.1248 4.90315 9.99376 5.09607 8.90262C5.289 7.81147 5.7652 6.80919 6.46447 6.02252C7.16373 5.23585 8.05464 4.70012 9.02455 4.48308C9.99445 4.26604 10.9998 4.37743 11.9134 4.80318C12.827 5.22892 13.6079 5.94989 14.1573 6.87492C14.7068 7.79994 15 8.88748 15 10C15.0005 10.7388 14.8714 11.4705 14.6203 12.1532C14.3692 12.8359 14.0009 13.4562 13.5366 13.9786C13.0722 14.5011 12.5208 14.9154 11.914 15.1979C11.3071 15.4804 10.6567 15.6255 10 15.625ZM10 6.25C9.70258 6.25484 9.40709 6.30476 9.12153 6.39844C9.35398 6.75887 9.46455 7.20075 9.43337 7.64467C9.40219 8.08859 9.23129 8.50545 8.9514 8.82033C8.67151 9.13521 8.30097 9.32746 7.90637 9.36254C7.51177 9.39762 7.11899 9.27323 6.79861 9.01172C6.61629 9.76723 6.64918 10.568 6.89263 11.3014C7.13609 12.0348 7.57786 12.6638 8.15576 13.0999C8.73365 13.536 9.41857 13.7573 10.1141 13.7325C10.8096 13.7077 11.4807 13.4382 12.0329 12.9618C12.5851 12.4854 12.9906 11.8262 13.1924 11.077C13.3941 10.3277 13.3819 9.52619 13.1574 8.78518C12.933 8.04416 12.5076 7.40099 11.9412 6.94621C11.3748 6.49142 10.6959 6.24793 10 6.25Z" fill="white"/>
                    //                     </svg>
                    //                 </a>
                    //                 <a href="/transactions/edit/${row.id}" class="btn btn-sm btn-success p-3 m-1">
                    //                     <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    //                         <path d="M5.43302 13.9171L6.69502 10.7621C6.89617 10.2594 7.19725 9.80289 7.58002 9.42006L14.5 2.50206C14.8978 2.10423 15.4374 1.88074 16 1.88074C16.5626 1.88074 17.1022 2.10423 17.5 2.50206C17.8978 2.89988 18.1213 3.43945 18.1213 4.00206C18.1213 4.56467 17.8978 5.10423 17.5 5.50206L10.58 12.4201C10.197 12.8031 9.74002 13.1051 9.23702 13.3061L6.08302 14.5681C5.99216 14.6044 5.89262 14.6133 5.79674 14.5937C5.70087 14.574 5.61287 14.5266 5.54366 14.4574C5.47446 14.3882 5.42708 14.3002 5.40742 14.2043C5.38775 14.1085 5.39665 14.0089 5.43302 13.9181V13.9171Z" fill="white"/>
                    //                         <path d="M3.5 5.75C3.5 5.06 4.06 4.5 4.75 4.5H10C10.1989 4.5 10.3897 4.42098 10.5303 4.28033C10.671 4.13968 10.75 3.94891 10.75 3.75C10.75 3.55109 10.671 3.36032 10.5303 3.21967C10.3897 3.07902 10.1989 3 10 3H4.75C4.02065 3 3.32118 3.28973 2.80546 3.80546C2.28973 4.32118 2 5.02065 2 5.75V15.25C2 15.9793 2.28973 16.6788 2.80546 17.1945C3.32118 17.7103 4.02065 18 4.75 18H14.25C14.9793 18 15.6788 17.7103 16.1945 17.1945C16.7103 16.6788 17 15.9793 17 15.25V10C17 9.80109 16.921 9.61032 16.7803 9.46967C16.6397 9.32902 16.4489 9.25 16.25 9.25C16.0511 9.25 15.8603 9.32902 15.7197 9.46967C15.579 9.61032 15.5 9.80109 15.5 10V15.25C15.5 15.94 14.94 16.5 14.25 16.5H4.75C4.06 16.5 3.5 15.94 3.5 15.25V5.75Z" fill="white"/>
                    //                     </svg>
                    //                 </a>
                    //                 <button class="btn btn-sm btn-danger btn-delete p-3 m-1" data-id="${row.id}">
                    //                     <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    //                         <path fill-rule="evenodd" clip-rule="evenodd" d="M8.74997 1C8.02062 1 7.32115 1.28973 6.80543 1.80546C6.2897 2.32118 5.99997 3.02065 5.99997 3.75V4.193C5.20497 4.27 4.41597 4.369 3.63497 4.491C3.53622 4.50445 3.44114 4.53745 3.35529 4.58807C3.26943 4.63869 3.19453 4.70591 3.13496 4.78581C3.07538 4.86571 3.03233 4.95668 3.00831 5.0534C2.98429 5.15013 2.97979 5.25067 2.99508 5.34916C3.01036 5.44764 3.04512 5.54209 3.09733 5.62699C3.14953 5.71189 3.21813 5.78553 3.29912 5.84361C3.38011 5.90169 3.47186 5.94305 3.56902 5.96526C3.66618 5.98748 3.76679 5.99011 3.86497 5.973L4.01397 5.951L4.85497 16.469C4.91003 17.1582 5.22267 17.8014 5.73063 18.2704C6.23859 18.7394 6.90458 18.9999 7.59597 19H12.403C13.0944 19.0002 13.7605 18.74 14.2686 18.2711C14.7768 17.8022 15.0897 17.1592 15.145 16.47L15.986 5.95L16.135 5.973C16.3297 5.99952 16.527 5.94858 16.6845 5.83111C16.8421 5.71365 16.9472 5.53906 16.9773 5.34488C17.0075 5.15071 16.9602 4.95246 16.8457 4.79278C16.7312 4.6331 16.5586 4.52474 16.365 4.491C15.5797 4.36878 14.791 4.26941 14 4.193V3.75C14 3.02065 13.7102 2.32118 13.1945 1.80546C12.6788 1.28973 11.9793 1 11.25 1H8.74997ZM9.99997 4C10.84 4 11.673 4.025 12.5 4.075V3.75C12.5 3.06 11.94 2.5 11.25 2.5H8.74997C8.05997 2.5 7.49997 3.06 7.49997 3.75V4.075C8.32697 4.025 9.15997 4 9.99997 4ZM8.57997 7.72C8.57201 7.52109 8.48536 7.33348 8.33909 7.19846C8.19281 7.06343 7.99888 6.99204 7.79997 7C7.60106 7.00796 7.41345 7.0946 7.27843 7.24088C7.1434 7.38716 7.07201 7.58109 7.07997 7.78L7.37997 15.28C7.38391 15.3785 7.40721 15.4752 7.44854 15.5647C7.48987 15.6542 7.54842 15.7347 7.62085 15.8015C7.69328 15.8684 7.77817 15.9203 7.87067 15.9544C7.96317 15.9884 8.06148 16.0039 8.15997 16C8.25846 15.9961 8.35521 15.9728 8.4447 15.9314C8.53418 15.8901 8.61465 15.8315 8.68151 15.7591C8.74837 15.6867 8.80031 15.6018 8.83436 15.5093C8.86841 15.4168 8.88391 15.3185 8.87997 15.22L8.57997 7.72ZM12.92 7.78C12.9239 7.68151 12.9084 7.58321 12.8744 7.4907C12.8403 7.3982 12.7884 7.31331 12.7215 7.24088C12.6547 7.16845 12.5742 7.1099 12.4847 7.06857C12.3952 7.02724 12.2985 7.00394 12.2 7C12.0011 6.99204 11.8071 7.06343 11.6609 7.19846C11.5146 7.33348 11.4279 7.52109 11.42 7.72L11.12 15.22C11.116 15.3185 11.1315 15.4168 11.1656 15.5093C11.1996 15.6018 11.2516 15.6867 11.3184 15.7591C11.3853 15.8315 11.4658 15.8901 11.5552 15.9314C11.6447 15.9728 11.7415 15.9961 11.84 16C11.9385 16.0039 12.0368 15.9884 12.1293 15.9544C12.2218 15.9203 12.3067 15.8684 12.3791 15.8015C12.4515 15.7347 12.5101 15.6542 12.5514 15.5647C12.5927 15.4752 12.616 15.3785 12.62 15.28L12.92 7.78Z" fill="white"/>
                    //                     </svg>
                    //                 </button>
                    //             </div>`;
                    //     },
                    //     orderable: false
                    // }
                ]
            });

            var initToggleToolbar = function() {
                console.log('Toolbar initialized');
            }

            var handleDeleteRows = function() {
                table.on('click', '.btn-delete', function() {
                    var userId = $(this).data('id');
                    var row = $(this).closest('tr');
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    Swal.fire({
                        text: "Are you sure you want to delete this user?",
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
                                url: `/transactions/delete/${userId}`,
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
                                            datatable.row(row).remove()
                                                .draw();
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
                                        text: "Failed to delete the user.",
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

        return {
            init: function() {
                initUserTable();
                handleSearchDatatable();
            }
        }
    }();

    $(document).ready(function() {
        KTUsersList.init();
    });
</script>
