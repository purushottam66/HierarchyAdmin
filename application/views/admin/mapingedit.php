<style>
    input[readonly] {
        background-color: #f0f0f0 !important;
        color: #888888 !important;
        border: 1px solid #cccccc !important;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btnss {
        padding: 10px 20px;
        background-color: #0a6867;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-left: 20px;
    }

    .btnss:hover {
        background-color: #0a6867;
        color: #ffff;
    }
</style>



<div class="app-main">
    <header class="main-heading shadow-2dp">    
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Hierarchy Edit</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Geography Wise</a> / Hierarchy Edit</div>
            </div>
        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <div class="box-body">
                            <div class="form-container">
                                <form action="<?php echo site_url('admin/update_maping'); ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo  $mapping_db['id']; ?>">


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
                                    <div class="row">


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="distributors_code">
                                                    <?php echo htmlspecialchars($customer_name); ?> </label>


                                                <input type="text" class="form-control" name="DB_Code"
                                                    value="<?php echo $mapping_db['DB_Code']; ?>" readonly
                                                    id="dbCodeInput">
                                                <!-- <select data-live-search="true" class="form-select"
                                                    id="distributors_code" name="DB_Code" readonly="">
                                                    <?php foreach ($Customer_Code as $levels): ?>
                                                        <option value="<?php echo $levels['Customer_Code']; ?>"
                                                            <?php echo ($mapping_db['DB_Code'] == $levels['Customer_Code']) ? 'selected' : ''; ?>>
                                                            <?php echo $levels['Customer_Code']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select> -->
                                            </div>
                                        </div>
                                        <!-- Level 1 -->
                                        <!-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Sales_Code" >VKORG (Sales_Code) </label>
                                                <select class="selectpicker  form-control" id="Sales_Code" name="Sales_Code" disabled>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($Sales_Code as $levels): ?>

                                                    <option value="<?php echo $levels['Sales_Code']; ?>"
                                                        <?php echo ($mapping_db['Sales_Code'] == $levels['Sales_Code']) ? 'selected' : ''; ?>>
                                                        <?php echo $levels['Sales_Code']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Distribution_Channel_Code" >VTWEG
                                                    (Distribution_Channel_Code) </label>
                                                <select class="selectpicker  form-control" id="Distribution_Channel_Code"
                                                    name="Distribution_Channel_Code" disabled>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($Distribution_Channel_Code as $levels): ?>
                                                    <option value="<?php echo $levels['Distribution_Channel_Code']; ?>"
                                                        <?php echo ($mapping_db['Distribution_Channel_Code'] == $levels['Distribution_Channel_Code']) ? 'selected' : ''; ?>>
                                                        <?php echo $levels['Distribution_Channel_Code']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div> -->

                                        <!-- 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Division_Code" >SPART (Division_Code)
                                                </label>
                                                <select class="selectpicker  form-control" id="Division_Code" name="Division_Code"
                                                    disabled>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($Division_Code as $levels): ?>
                                                    <option value="<?php echo $levels['Division_Code']; ?>"
                                                        <?php echo ($mapping_db['Division_Code'] == $levels['Division_Code']) ? 'selected' : ''; ?>>
                                                        <?php echo $levels['Division_Code']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div> -->


                                        <!-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Customer_Type_Code" >KATR1
                                                    (Customer_Type_Code) </label>
                                                <select class="selectpicker  form-control" id="Customer_Type_Code"
                                                    name="Customer_Type_Code" disabled>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($Customer_Type_Code as $levels): ?>
                                                    <option value="<?php echo $levels['Customer_Type_Code']; ?>"
                                                        <?php echo ($mapping_db['Customer_Type_Code'] == $levels['Customer_Type_Code']) ? 'selected' : ''; ?>>
                                                        <?php echo $levels['Customer_Type_Code']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Customer_Group_Code" >KDGRP
                                                    (Customer_Group_Code) </label>
                                                <select class="selectpicker  form-control" id="Customer_Group_Code"
                                                    name="Customer_Group_Code" disabled>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($Customer_Group_Code as $levels): ?>
                                                    <option value="<?php echo $levels['Customer_Group_Code']; ?>"
                                                        <?php echo ($mapping_db['Customer_Group_Code'] == $levels['Customer_Group_Code']) ? 'selected' : ''; ?>>
                                                        <?php echo $levels['Customer_Group_Code']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div> -->





                                        <!-- Level 1 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="level1">Level 1</label>
                                                <select class="selectpicker  form-control" id="level1" name="level1">
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($employees as $levels): ?>
                                                        <?php if ($levels['level'] == '1'):
                                                        ?>



                                                            <option value="<?php echo $levels['pjp_code']; ?>"
                                                                <?php echo ($mapping_db['Level_1'] == $levels['pjp_code']) ? 'selected' : ''; ?>>
                                                                <?php echo $levels['name']; ?>- (
                                                                <?php echo $levels['designation_name']; ?> )
                                                            </option>

                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Level 2 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="level2">Level 2</label>
                                                <select class="selectpicker  form-control" id="level2" name="level2">
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($employees as $levels): ?>
                                                        <?php if ($levels['level'] == '2'):
                                                        ?>
                                                            <option value="<?php echo $levels['pjp_code']; ?>"
                                                                <?php echo ($mapping_db['Level_2'] == $levels['pjp_code']) ? 'selected' : ''; ?>>
                                                                <?php echo $levels['name']; ?>- (
                                                                <?php echo $levels['designation_name']; ?> )
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Repeat similar structure for Level 3, 4, etc. -->


                                        <!-- Level 3 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="level3">Level 3</label>
                                                <select class="selectpicker  form-control" id="level3" name="level3">
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($employees as $levels): ?>
                                                        <?php if ($levels['level'] == '3'):
                                                        ?> <option value="<?php echo $levels['pjp_code']; ?>"
                                                                <?php echo ($mapping_db['Level_3'] == $levels['pjp_code']) ? 'selected' : ''; ?>>
                                                                <?php echo $levels['name']; ?>- (
                                                                <?php echo $levels['designation_name']; ?> )
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Level 4 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="level4">Level 4</label>
                                                <select class="selectpicker  form-control" id="level4" name="level4">
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($employees as $levels): ?>
                                                        <?php if ($levels['level'] == '4'):
                                                        ?>
                                                            <!-- Check if the current employee's pjp_code matches the Level_1 from the mapping -->
                                                            <option value="<?php echo $levels['pjp_code']; ?>"
                                                                <?php echo ($mapping_db['Level_4'] == $levels['pjp_code']) ? 'selected' : ''; ?>>
                                                                <?php echo $levels['name']; ?>- (
                                                                <?php echo $levels['designation_name']; ?> )
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Level 5 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="level5">Level 5</label>
                                                <select class="selectpicker  form-control" id="level5" name="level5">
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($employees as $levels): ?>
                                                        <?php if ($levels['level'] == '5'):
                                                        ?>
                                                            <!-- Check if the current employee's pjp_code matches the Level_1 from the mapping -->
                                                            <option value="<?php echo $levels['pjp_code']; ?>"
                                                                <?php echo ($mapping_db['Level_5'] == $levels['pjp_code']) ? 'selected' : ''; ?>>
                                                                <?php echo $levels['name']; ?>- (
                                                                <?php echo $levels['designation_name']; ?> )
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Level 6 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="level6">Level 6</label>
                                                <select class="selectpicker  form-control" id="level6" name="level6">
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($employees as $levels): ?>
                                                        <?php if ($levels['level'] == '6'):
                                                        ?>
                                                            <!-- Check if the current employee's pjp_code matches the Level_1 from the mapping -->
                                                            <option value="<?php echo $levels['pjp_code']; ?>"
                                                                <?php echo ($mapping_db['Level_6'] == $levels['pjp_code']) ? 'selected' : ''; ?>>
                                                                <?php echo $levels['name']; ?>- (
                                                                <?php echo $levels['designation_name']; ?> )
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Level 7 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="level7">Level 7</label>
                                                <select class="selectpicker  form-control" id="level7" name="level7">
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($employees as $levels): ?>
                                                        <?php if ($levels['level'] == '7'):
                                                        ?>
                                                            <!-- Check if the current employee's pjp_code matches the Level_1 from the mapping -->
                                                            <option value="<?php echo $levels['pjp_code']; ?>"
                                                                <?php echo ($mapping_db['Level_7'] == $levels['pjp_code']) ? 'selected' : ''; ?>>
                                                                <?php echo $levels['name']; ?>- (
                                                                <?php echo $levels['designation_name']; ?> )
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>











                                    </div>

                                    <button type="submit" class="btn btnss ">Submit</button> &#8202;
                                    <a href="#" class="href" onclick="history.back(); return false;">
    <button type="button" class="btn btnss bg-danger">Back</button>
</a>


                                    <br><br>
                                </form>


                            </div>






                        </div>
                    </div>
                </div>







            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>