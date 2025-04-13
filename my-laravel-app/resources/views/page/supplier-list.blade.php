@extends('layouts.app')
<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default" 
    data-assets-path="../../assets/" data-template="vertical-menu-template" data-bs-theme="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Supplier List | Imajica Booking System</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset(path:'logo/logo.png') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <script src="../../assets/js/config.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('components.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 text-black">Supplier List</h5>
                                        <a href="{{ route('page.new-supplier') }}" class="btn btn-primary">
                                            <i class="ti tabler-plus"></i> Add New Supplier
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="text-center">Supplier Name</th>
                                                        <th class="text-center">Contact Number</th>
                                                        <th class="text-center">Address</th>
                                                        <th class="text-center">Email</th>
                                                        <th class="text-center">Supplier Type</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($suppliers as $supplier)
                                                    <tr>
                                                        <td class="text-center">{{ $supplier->supplier_name }}</td>
                                                        <td class="text-center">{{ $supplier->contactNumber }}</td>
                                                        <td class="text-center">{{ $supplier->address }}</td>
                                                        <td class="text-center">{{ $supplier->email }}</td>
                                                        <td class="text-center">{{ $supplier->supplier_type }}</td>
                                                        <td class="text-center">
                                                            <div class="d-inline-block">
                                                                <button type="button" class="btn btn-sm btn-info edit-supplier" 
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editSupplierModal"
                                                                    data-id="{{ $supplier->suppler_id }}"
                                                                    data-name="{{ $supplier->supplier_name }}"
                                                                    data-email="{{ $supplier->email }}"
                                                                    data-contact="{{ $supplier->contactNumber }}"
                                                                    data-phone="{{ $supplier->phone }}"
                                                                    data-address="{{ $supplier->address }}"
                                                                    data-supplier-products="{{ $supplier->product_offered }}"
                                                                    data-type="{{ $supplier->supplier_type }}"
                                                                    >
                                                                    <i class="ti tabler-edit me-1"></i> Edit
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-danger delete-supplier" 
                                                                    data-id="{{ $supplier->supplier_id }}">
                                                                    <i class="ti tabler-trash me-1"></i> Delete
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Supplier Modal -->
    <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #0a3622">
            <h5 class="modal-title text-white">Edit Supplier</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editSupplierForm" method="POST">
              @csrf
              @method('PUT')
              <input type="hidden" id="edit_supplier_id" name="suppler_id">
              <div class="mb-3">
                <label class="form-label" for="edit_supplier_name">Supplier Name</label>
                <input type="text" id="edit_supplier_name" name="supplier_name" class="form-control" required>
                <div class="invalid-feedback" id="edit_supplier_name_error"></div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="edit_supplier_type">Supplier Type</label>
                <input type="text" id="edit_supplier_type" name="supplier_type" class="form-control" required>
                <div class="invalid-feedback" id="edit_supplier_type_error"></div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="edit_contact_number">Contact Number</label>
                <input type="text" id="edit_contact_number" name="contactNumber" class="form-control" required>
                <div class="invalid-feedback" id="edit_contact_number_error"></div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="edit_email">Email</label>
                <input type="email" id="edit_email" name="email" class="form-control" required>
                <div class="invalid-feedback" id="edit_email_error"></div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="edit_address">Address</label>
                <textarea id="edit_address" name="address" class="form-control" rows="3" required></textarea>
                <div class="invalid-feedback" id="edit_address_error"></div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="edit_product_offered">Products/Services Offered</label>
                <textarea id="edit_product_offered" name="product_offered" class="form-control" rows="3"></textarea>
                <div class="invalid-feedback" id="edit_product_offered_error"></div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Supplier</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Supplier Form (Hidden) -->
    <form id="deleteSupplierForm" method="POST" action="/supplier/delete" style="display: none;">
      @csrf
      @method('DELETE')
      <input type="hidden" id="delete_supplier_id" name="suppler_id">
    </form>

    <!-- Core JS -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Define supplier routes -->
    <script>
        const supplierRoutes = {
            add: "{{ route('add.supplier') }}",
            getAll: "{{ route('get.suppliers') }}",
            get: "{{ route('get.supplier', ['id' => '__ID__']) }}",
            update: "{{ route('update.supplier', ['id' => '__ID__']) }}",
            delete: "{{ route('delete.supplier', ['id' => '__ID__']) }}"
        };
    </script>

    <script src="../../assets/js/supplier-management.js"></script>

    <script>
      $(document).ready(function() {
        // SweetAlert default configuration
        const swalConfig = {
          customClass: {
            container: 'swal-container-class',
            popup: 'swal-popup-class'
          },
          backdrop: true,
          allowOutsideClick: false
        };
        
        // Add custom CSS for z-index
        $('<style>')
          .prop('type', 'text/css')
          .html(`
            .swal-container-class {
              z-index: 2000 !important;
            }
            .swal-popup-class {
              z-index: 2001 !important;
            }
            .swal2-backdrop-show {
              z-index: 1999 !important;
            }
          `)
          .appendTo('head');

        // Handle edit supplier button clicks
        $('.edit-supplier').on('click', function() {
          try {
            const supplierId = $(this).data('id');
            const supplierName = $(this).data('name');
            const supplierType = $(this).data('type');
            const contactNumber = $(this).data('contact');
            const email = $(this).data('email');
            const address = $(this).data('address');
            const productOffered = $(this).data('supplier-products');
            
            // Pre-fill form fields
            $('#edit_supplier_id').val(supplierId);
            $('#edit_supplier_name').val(supplierName);
            $('#edit_supplier_type').val(supplierType);
            $('#edit_contact_number').val(contactNumber);
            $('#edit_email').val(email);
            $('#edit_address').val(address);
            $('#edit_product_offered').val(productOffered);
            
            // Show the modal
            $('#editSupplierModal').modal('show');
            
          } catch (e) {
            console.error("Error in edit button click handler:", e);
            Swal.fire({
              ...swalConfig,
              icon: 'error',
              title: 'Error',
              html: 'An error occurred while loading supplier data:<br>' + e.message,
              showConfirmButton: true
            });
          }
        });

        // Handle form submission with confirmation
        $('#editSupplierForm').on('submit', function(e) {
          e.preventDefault();
          
          const supplierId = $('#edit_supplier_id').val();
          const form = $(this);
          const formData = form.serialize();
          const action = supplierRoutes.update.replace('__ID__', supplierId);

          // Hide the modal before showing SweetAlert
          $('#editSupplierModal').modal('hide');
          
          setTimeout(() => {
            Swal.fire({
              ...swalConfig,
              title: 'Confirm Update',
              text: 'Are you sure you want to update this supplier?',
              icon: 'question',
              showCancelButton: true,
              confirmButtonText: 'Yes, update itttt!', 
              cancelButtonText: 'Cancel',
              confirmButtonColor: '#0a3622',
              cancelButtonColor: '#d33'
            }).then((result) => {
              if (result.isConfirmed) {
                // Make AJAX request
                $.ajax({
                  url: action,
                  type: 'POST',
                  data: formData,
                  success: function(response) {
                    if(response.status) {
                      Swal.fire({
                        ...swalConfig,
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                      }).then(() => {
                        window.location.reload();
                      });
                    } else {
                      showErrorAlert(response.message);
                    }
                  },
                  error: function(xhr) {
                    let errorMessage = 'An error occurred while updating the supplier.';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                      errorMessage = xhr.responseJSON.message;
                    }
                    showErrorAlert(errorMessage);
                  }
                });
              } else {
                $('#editSupplierModal').modal('show');
              }
            });
          }, 200);
        });

        function showErrorAlert(message) {
          Swal.fire({
            ...swalConfig,
            icon: 'error',
            title: 'Error',
            text: message,
            confirmButtonColor: '#d33'
          });
        }

        // Handle delete supplier button clicks
        $('.delete-supplier').on('click', function() {
          const supplierId = $(this).data('id');
          const supplierName = $(this).closest('tr').find('td:first').text();
          
          $('#delete_supplier_id').val(supplierId);
          
          Swal.fire({
            ...swalConfig,
            title: 'Confirm Delete',
            html: `Are you sure you want to delete supplier <strong>${supplierName}</strong>?<br>This action cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d'
          }).then((result) => {
            if (result.isConfirmed) {
              $('#deleteSupplierForm').submit();
            }
          });
        });

      });
    </script>

</body>
</html>

