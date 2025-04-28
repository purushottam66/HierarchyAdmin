  <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/buttons.dataTables.css'); ?>">
  <div class="app-main">
      <header class="main-heading shadow-2dp">
          <div class="dashhead bg-white">
              <div class="dashhead-titles">
                  <h3 class="dashhead-title">Geography Wise</h3>
              </div>
              <div class="dashhead-toolbar">
                  <div class="dashhead-toolbar-item"><a href="#">Report</a> / Geography Wise
                  </div>
              </div>
          </div>
      </header>
      <div class="main-content bg-clouds">
          <div class="container-fluid p-t-15">
              <div class="row">
                  <div class="col-md-12">
                      <div class="box shadow-2dp b-r-2">

                          <div class="box-body">
                              <?php if ($this->session->flashdata('success')): ?>
                                  <div class="alert alert-success">
                                      <?php echo $this->session->flashdata('success'); ?>
                                  </div>
                              <?php endif; ?>
                              <?php if ($this->session->flashdata('error')): ?>
                                  <div class="alert alert-danger">
                                      <?php echo $this->session->flashdata('error'); ?>
                                  </div>
                              <?php endif; ?>
                              <form action="" method="post">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-group p-b-10">
                                              <label for="sel1">Select Zone
                                              </label>
                                              <select class="selectpicker form-control" id="zoneSelect"
                                                  data-actions-box="true" multiple aria-label="Default select example"
                                                  title="Please Select" data-size="5" name="Sales_Code" data-live-search="true" multiple
                                                  data-selected-text-format="count"
                                                  data-count-selected-text=" ({0} items selected)">
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group p-b-10">
                                              <label for="sel1">Select State
                                              </label>
                                              <select class="selectpicker form-control" id="State_Code"
                                                  data-actions-box="true" multiple aria-label="Default select example"
                                                  title="Please Select" data-size="5" data-live-search="true" multiple
                                                  data-selected-text-format="count"
                                                  data-count-selected-text=" ({0} items selected)">


                                              </select>

                                          </div>


                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group p-b-10">
                                              <label for="sel1">Select City
                                              </label>
                                              <select class="selectpicker form-control" id="City" data-actions-box="true"
                                                  multiple aria-label="Default select example" title="Please Select"
                                                  data-size="5" data-live-search="true" multiple
                                                  data-selected-text-format="count"
                                                  data-count-selected-text=" ({0} items selected)">
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                              <div class="table-responsive">
                                  <table id="exampley" class="display nowrap table table-bordered table-hover text-center"
                                      style="width:100%">
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>



  <script src="<?php echo base_url('admin/assets/js/jquery-3.7.1.js'); ?>"></script>




  <script>
      function escapeHtml(unsafe) {
          if (typeof unsafe !== 'string') {
              return '';
          }
          return unsafe
              .replace(/&/g, "&amp;")
              .replace(/</g, "&lt;")
              .replace(/>/g, "&gt;")
              .replace(/"/g, "&quot;")
              .replace(/'/g, "&#039;");
      }

      // The DataTable initialization
      $(document).ready(function() {
          var table = $('#exampley').DataTable({
              paging: true,
              searching: true,
              info: true,
              autoWidth: false,
              pageLength: 10,
              lengthMenu: [10, 25, 50, 100],
              scrollY: "400px",
              scrollCollapse: true,
              fixedHeader: true,
              processing: true,
              serverSide: true,

              order: [
                  [0, 'asc']
              ],

              dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"f><"p-2 bd-highlight"B>>t<"bottom"ip><"clear">',
              buttons: [

                  {
                      text: '<i class="fa fa-database"></i> Export  Data',
                      titleAttr: 'Export Filtered Data',
                      action: function() {
                          var zoneSelect = $('#zoneSelect').val() || [];
                          var State_Code = $('#State_Code').val() || [];
                          var City = $('#City').val() || [];
                          var search = $('#dt-search-0').val();

                          var params = new URLSearchParams();
                          if (zoneSelect.length > 0) {
                              params.append('zoneSelect', JSON.stringify(zoneSelect));
                          }
                          if (State_Code.length > 0) {
                              params.append('State_Code', JSON.stringify(State_Code));
                          }
                          if (City.length > 0) {
                              params.append('City', JSON.stringify(City));
                          }
                          if (search.length > 0) {
                              params.append('dt-search-0', JSON.stringify(search));
                          }


                          var url = '<?php echo base_url("admin/export_distributors_csv"); ?>?' + params.toString();
                          window.location.href = url;
                      }
                  }

              ],
              ajax: {
                  url: "<?= site_url('admin/geographyajex') ?>",
                  type: "POST",
                  data: function(d) {
                      $.extend(d, getParams());
                      d.search = $('#dt-search-0').val(); // Include search term

                      return d;
                  },
                  dataSrc: function(json) {

                      if (json.filter) {
                          // updateSalesCodeDropdown(json.filter);
                      }
                      return json.data;
                  },
                  error: function(xhr, error, code) {
                      console.error("Ajax Error:", {
                          xhr: xhr,
                          error: error,
                          code: code
                      });

                  },
              },

              language: {
                  processing: '<img class="spin-image" src="<?php echo base_url('admin/assets/Bloom_2.gif'); ?>" alt="Loading...">', // Custom loading message
              },

              columnDefs: [

                  // {
                  //     targets: [31, 32, 33, 34, ...Array.from({
                  //         length: 45 - 34 + 1
                  //     }, (_, i) => 35 + i)],
                  //     orderable: false
                  // }, 
                  {
                      className: 'text-center',
                      targets: '_all'
                  }
              ],
              columns: [{
                      data: "id",
                      title: "ID",
                      visible: false
                  },

                  {
                      data: "Customer_Name",
                      title: "Customer Name"
                  },
                  {
                      data: "Customer_Code",
                      title: "Customer Code"
                  },
                  {
                      data: "Pin_Code",
                      title: "Pin Code"
                  },
                  {
                      data: "City",
                      title: "City"
                  },
                  {
                      data: "District",
                      title: "District"
                  },
                  {
                      data: "Contact_Number",
                      title: "Contact Number"
                  },
                  {
                      data: "Country",
                      title: "Country"
                  },
                  {
                      data: "Zone",
                      title: "Zone"
                  },
                  {
                      data: "State",
                      title: "State"
                  },
                  {
                      data: "Population_Strata_1",
                      title: "Population Strata 1"
                  },
                  {
                      data: "Population_Strata_2",
                      title: "Population Strata 2"
                  },
                  {
                      data: "Country_Group",
                      title: "Country Group"
                  },
                  {
                      data: "GTM_TYPE",
                      title: "GTM Type"
                  },
                  {
                      data: "SUPERSTOCKIST",
                      title: "Super Stockist"
                  },
                  {
                      data: "STATUS",
                      title: "Status"
                  },




                  {
                      data: "Sales_Code",
                      title: "Sales Code"
                  },

                  {
                      data: "Sales_Name",
                      title: "Sales Name"
                  },

                  {
                      data: "Distribution_Channel_Code",
                      title: "Distribution Channel Code"
                  },
                  {
                      data: "Distribution_Channel_Name",
                      title: "Distribution Channel Name"
                  },


                  {
                      data: "Division_Code",
                      title: "Division Code"
                  },
                  {
                      data: "Division_Name",
                      title: "Division Name"
                  },




                  {
                      data: "Customer_Type_Code",
                      title: "Customer Type Code"
                  },
                  {
                      data: "Customer_Type_Name",
                      title: "Customer Type Name"
                  },
                  {
                      data: "Customer_Group_Code",
                      title: "Customer Group Code"
                  },

                  {
                      data: "Customer_Group_Name",
                      title: "Customer Group Name"
                  },

                  {
                      data: "Customer_Creation_Date",
                      title: "Customer Creation Date"
                  },


                  {
                      data: "Sector_Name",
                      title: "Sector Name"
                  },
                  {
                      data: "Sector_Code",
                      title: "Sector Code"
                  },
                  {
                      data: "State_Code",
                      title: "State Code"
                  },
                  {
                      data: "Zone_Code",
                      title: "Zone Code"
                  },



                  {
                      data: "Level_1_Name",
                      title: "Level 1 Name",
                      orderable: false
                  },
                  {
                      data: "Level_1_Employer_Code",
                      title: "Level 1 Employer Code",
                      orderable: false
                  },
                  {
                      data: "Level_1_Designation_Name",
                      title: "Level 1 Designation Name",
                      orderable: false
                  },

                  {
                      data: "Level_2_Name",
                      title: "Level 2 Name",
                      orderable: false
                  },
                  {
                      data: "Level_2_Employer_Code",
                      title: "Level 2 Employer Code",
                      orderable: false
                  },
                  {
                      data: "Level_2_Designation_Name",
                      title: "Level 2 Designation Name",
                      orderable: false
                  },

                  {
                      data: "Level_3_Name",
                      title: "Level 3 Name",
                      orderable: false
                  },
                  {
                      data: "Level_3_Employer_Code",
                      title: "Level 3 Employer Code",
                      orderable: false
                  },
                  {
                      data: "Level_3_Designation_Name",
                      title: "Level 3 Designation Name",
                      orderable: false
                  },

                  {
                      data: "Level_4_Name",
                      title: "Level 4 Name",
                      orderable: false
                  },
                  {
                      data: "Level_4_Employer_Code",
                      title: "Level 4 Employer Code",
                      orderable: false
                  },
                  {
                      data: "Level_4_Designation_Name",
                      title: "Level 4 Designation Name",
                      orderable: false
                  },

                  {
                      data: "Level_5_Name",
                      title: "Level 5 Name",
                      orderable: false
                  },
                  {
                      data: "Level_5_Employer_Code",
                      title: "Level 5 Employer Code",
                      orderable: false
                  },
                  {
                      data: "Level_5_Designation_Name",
                      title: "Level 5 Designation Name",
                      orderable: false
                  },

                  {
                      data: "Level_6_Name",
                      title: "Level 6 Name",
                      orderable: false
                  },
                  {
                      data: "Level_6_Employer_Code",
                      title: "Level 6 Employer Code",
                      orderable: false
                  },
                  {
                      data: "Level_6_Designation_Name",
                      title: "Level 6 Designation Name",
                      orderable: false
                  },

                  {
                      data: "Level_7_Name",
                      title: "Level 7 Name",
                      orderable: false
                  },
                  {
                      data: "Level_7_Employer_Code",
                      title: "Level 7 Employer Code",
                      orderable: false
                  },
                  {
                      data: "Level_7_Designation_Name",
                      title: "Level 7 Designation Name",
                      orderable: false
                  },


                  {
                      data: null,
                      title: "Actions",
                      orderable: false,
                      render: function(data, type, row) {
                          var permissions = <?php echo json_encode($permissions); ?>;

                          // Check if the user has edit permission for "Hierarchy Data"
                          let hasEditPermission = permissions.some(p => p.module_name === "Report" && p.edit === "yes");

                          // Build the action buttons
                          let actionButtons = '<div class="d-flex">';

                          if (hasEditPermission) {
                              actionButtons += `
                <a href="<?= site_url('admin/hierarchyedit') ?>?id=${encodeURIComponent(row.id || 'N/A')}&customer_name=${encodeURIComponent(row.Customer_Name || 'N/A')}" class="btn btn-primary text-white setfont">
                    <i class="fa-solid fa-pencil fa-fw"></i>
                </a>
                <a href="javascript:void(0);" data-id="${row.id || 'N/A'}" class="delete-btn">
                    <button class="btn btn-danger text-white setfont">
                        <i class="fa-solid fa-trash fa-fw"></i>
                    </button>
                </a>`;
                          } else {
                              actionButtons += `<span class="text-danger fw-bold">No Permission</span>`;
                          }

                          actionButtons += `</div>`;
                          return actionButtons;
                      }
                  }

              ],
          });








          $('#dt-search-0').on('keyup', function() {

              table.ajax.reload();
          });

      });




      function getParams() {
          return {
              Zone: $('#zoneSelect').val() || null,
              State_Code: $('#State_Code').val() || null,
              City: $('#City').val() || null,

          };
      }



      function updateSalesCodeDropdown(mapingData) {
          var zoneCodeDropdown = $('#zoneSelect');
          var stateDropdown = $('#State_Code');
          var cityDropdown = $('#City');


          var uniqueSalesCodes = {};
          $.each(mapingData, function(index, item) {
              if (item.Zone_Code) {
                  uniqueSalesCodes[item.Zone_Code] = item.Zone;
              }
          });
          $.each(uniqueSalesCodes, function(code, name) {
              if (!zoneCodeDropdown.find('option[value="' + escapeHtml(
                          code) +
                      '"]').length) {
                  zoneCodeDropdown.append('<option value="' + escapeHtml(
                          code) +
                      '">' + escapeHtml(name) + '</option>');
              }
          });
          zoneCodeDropdown.selectpicker('refresh');

          // Collect unique distribution channels
          var uniqueChannels = {};
          $.each(mapingData, function(index, item) {
              if (item.State_Code) {
                  uniqueChannels[item.State_Code] = item.State;
              }
          });
          $.each(uniqueChannels, function(code, name) {
              if (!stateDropdown.find('option[value="' +
                      escapeHtml(
                          code) + '"]').length) {
                  stateDropdown.append('<option value="' +
                      escapeHtml(code) + '">' + escapeHtml(name) +
                      '</option>'
                  );
              }
          });


          stateDropdown.selectpicker('refresh');

          // Collect unique division codes
          var uniqueDivisions = {};
          $.each(mapingData, function(index, item) {
              if (item.City) {
                  uniqueDivisions[item.City] = item.City;
              }
          });
          $.each(uniqueDivisions, function(code, name) {
              if (!cityDropdown.find('option[value="' + escapeHtml(
                          code) +
                      '"]').length) {
                  cityDropdown.append('<option value="' + escapeHtml(
                      code) + '">' + escapeHtml(name) + '</option>');
              }
          });
          cityDropdown.selectpicker('refresh');


      }





      function fetchDataAndUpdate_(params) {

    

          $.ajax({
              url: "<?= site_url('admin/get-hierarchy-filter-options') ?>",
              type: "GET",
              data: params,
              success: function(response) {
                  updateSalesCodeDropdown(response);
           
                  $('#exampley').DataTable().ajax.reload();

              },
              error: function(error) {
                  console.error("AJAX Error:", error);
              }
          });
      }


      fetchDataAndUpdate_(getParams());



      $('#zoneSelect').change(function() {
          $('#State_Code').empty();
          $('#City').empty();
          fetchDataAndUpdate_(getParams());
          $('#exampley').DataTable().ajax.reload();

      });

      $('#State_Code').change(function() {
          $('#City').empty();
          fetchDataAndUpdate_(getParams());
          $('#exampley').DataTable().ajax.reload();
      });

      $('#City').change(function() {
          fetchDataAndUpdate_(getParams());
          $('#exampley').DataTable().ajax.reload();
      });
  </script>




  <script>
      document.addEventListener('DOMContentLoaded', function() {
          document.body.addEventListener('click', function(event) {
              if (event.target.closest('.delete-btn')) {
                  var id = event.target.closest('.delete-btn').getAttribute('data-id');

                  swal({
                          title: "Are you sure?",
                          text: "You won't be able to undo this action!",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: '#DD6B55',
                          confirmButtonText: 'Yes, delete it!',
                          cancelButtonText: "No, cancel!",
                          closeOnConfirm: false,
                          closeOnCancel: true
                      },
                      function(isConfirm) {
                          if (isConfirm) {
                              window.location.href = "<?php echo site_url('admin/hierarchydelete/'); ?>" +
                                  id;
                          } else {
                              swal("Cancelled", "Your item is safe :)", "error");
                          }
                      });
              }
          });
      });
  </script>